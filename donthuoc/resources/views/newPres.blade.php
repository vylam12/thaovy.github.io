<?php
    use App\Models\DetailPrescription;  
    use App\Models\Drug;           
            $DetailPres = new DetailPrescription();
            $id_patient = request()->segment(2);   
            $prescriptionId = request()->segment(4);    
            $drugs = $DetailPres->getDrug($prescriptionId);                                          
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">    
    <title>CHI TIẾT ĐƠN THUỐC</title>
    <style>
       input[type="text"],
        input[type="date"],
        input[type="number"],input[type="password"] ,input[type="email"] {
            width: 50px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px; 
        }
    </style>
</head>
<body>
    <div class="nen">
        <img src="http://localhost/donthuoc/public/frontend/img/prescribe%20medicine.jpg" alt="Hình nền">
    </div>
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ route('patients.index')}}">TRANG CHỦ</a>
            </li>
            <li>
                <a href="{{route('patient.info', $id_patient)}}">THÔNG TIN BỆNH NHÂN</a>
            </li>
            <li>
                <a href="{{ route('medicine', $id_patient) }}">ĐƠN THUỐC MỚI</a>
            </li>    
        </ul>
    </div> 
    <h3>CHI TIẾT ĐƠN THUỐC</h3>
    <div class="noidung">                    
   
    </div>
    <div class="danhsach">
        <table>
            <thead>
                <tr>
                    <th scope="col">Tên thuốc</th>
                    <th scope="col">Tần suất</th>
                    <th scope="col">Liều dùng</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody> 
                <form action="{{route('new.prescription.check',['id' => $id_patient, 'prescriptionIdnew' =>  $prescriptionId])}}" method="POST">
                    
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
                            <input type="number" name="frequency[{{ $drug->id_drug }}]" value="{{ $drug->frequency }}">
                        </td>
                        <td>
                            <input type="number" name="quantity[{{ $drug->id_drug }}]" value="{{ $drug->quantity_Ofmedicine }}">        {{$drug->name_unitDr}}                   
                        </td>
                        <td>
                            {{ $drug->note }}
                        </td>                                                                    
                    </tr>                   
                    @endforeach                   
                    <button  class="add-btn"  type="submit">Lưu đơn mới</button>
                </form>                      
            </tbody>
        </table>
    </div>
    {{-- <button class="add-btn" onclick="window.location.href='{{ route('prescription.current', $id_patient) }}'">Quay lại</button> --}}
    
</body>
</html>