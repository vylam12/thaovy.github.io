<?php
    use App\Models\Prescription;     
    use App\Models\DetailPrescription;    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <title>ĐƠN THUỐC HIỆN TẠI </title>
    
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
            <a href="{{route('patient.info', $patient->id)}}">THÔNG TIN BỆNH NHÂN</a>
            </li>
            <li>
            <a href="{{ route('medicine', $patient->id) }}">ĐƠN THUỐC MỚI</a>
            </li>
        </ul>
    </div>  
      <h3>ĐƠN THUỐC</h3>         
    <div class="danhsach">
        <table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Bệnh nhân</th>
                    <th scope="col">Chẩn đoán</th>                    
                    <th scope="col">Bs Kê đơn</th>      
                    <th scope="col">Ngày kê</th>
                    <th scope="col"></th>                                 
                </tr>
            </thead>
            <tbody>       
                <?php 
                $id_patient = $patient->id;     
                $prescription = new Prescription();
                $id_pres = $prescription->getPrescription($id_patient);               
                               
            ?> 
                @foreach ($id_pres as $ip)                                                
                <tr>
                    <tr>
                        <td scope="row">
                            {{ $ip->id_prescription }}
                        </td>
                        <td>
                            {{ $patient->name_patient }}
                        </td>
                        <td>
                            {{ $ip->diagnose }}
                        </td>
                        <td>
                            <?php 
                                $idDoctor = $ip -> id_doctor;
                                $nameDoctor = DB::table('Doctor')->select('name_doctor')->where('id_doctor', $idDoctor)->first();
                                echo $nameDoctor->name_doctor;
                            ?>
                        </td>
                        <td>
                            {{ $ip->updated_at }}
                        </td>                     
                        <td>
                            <button class="add-btn-xct" onclick="window.location.href='{{ route('prescription.detail', ['id' => $id_patient, 'prescriptionId' => $ip->id_prescription]) }}'">Xem chi tiết</button>
                        </td>
                    </tr>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>

</body>
</html>