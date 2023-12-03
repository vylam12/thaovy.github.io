<?php
    use App\Models\DetailPrescription;   
    use App\Models\Drug;  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <title>Document</title>   
    <style>
        .alert {
            padding: 10px;
            width: 740px;       
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;       
        }

        .alert.alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        @media (min-width: 300px) and (max-width: 767px) {
            .alert {
                padding: 10px;
                width: 86%;       
                border: 1px solid #ccc;
                background-color: #f0f0f0;
                color: #333;
                font-size: 16px;
                margin-bottom: 10px;       
            }
        }
    </style>
</head>
<body> 
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="nen">
        <img src="http://localhost/donthuoc/public/frontend/img/prescribe%20medicine.jpg" alt="Hình nền">
    </div>
    <div class="navigation">
        <ul>
          <li>
            <a href="{{ route('patients.index')}}">TRANG CHỦ</a>
          </li>
          <li>
            <a href="{{route('prescription.current', $patient->id)}}">ĐƠN THUỐC HIỆN TẠI</a>
          </li>          
    
        </ul>
    </div>   
    <h3>THÔNG TIN BỆNH NHÂN</h3>
    <p>Mã bệnh nhân:   {{ $patient->id}}</p>
    <p>Tên bệnh nhân: {{ $patient->name_patient }}</p>
    <?php $diagnose = DB::table('prescription')
        ->select('diagnose')
        ->where('id_prescription', $prescriptionId)
        ->first();
        $diagnoseValue = $diagnose->diagnose;         
    ?>

    <p>Chẩn đoán: <?php echo $diagnoseValue?></p>        
    <?php 
        $drugs = DetailPrescription::getDrug($prescriptionId);          

    ?>  
       <div class="danhsach">
        <table>
            <thead>
                <tr>
                    <th scope="col">Tên thuốc</th>
                    <th scope="col">Tần suất</th>
                    <th scope="col">Liều dùng</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col"></th>             
                </tr>
            </thead>
            <tbody>        
                @foreach ($drugs as $drug)                                                
                <tr>
                    <td scope="row">
                        <?php 
                            $idDrug = $drug->id_drug;
                            $nameDrug = Drug::getNameDrug($idDrug);                    
                        ?>
                        {{ $nameDrug }}
                    </td>                
                    <td>                                              
                        {{ $drug->frequency }}                        
                    </td>
                    <td>
                        {{$drug->quantity_Ofmedicine}}  {{ $drug->name_unitDr }}
                    </td>
                    <td>
                        {{ $drug->note }}
                    </td>
                    <td>
                        <form action="{{ route('delete.drug', ['prescriptionId' => $prescriptionId, 'iddrug' => $drug->id_drug]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="add-btn-xct">Xoá</button>
                        </form>
                    </td>                 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p> THÊM THUỐC </p>
    <button  class="add-btn" onclick="window.location.href='{{ route('dose', ['id' => $patient->id, 'prescriptionId' => $prescriptionId])}}'">Thêm</button>
</body>
</html>