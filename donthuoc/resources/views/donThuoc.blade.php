<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">

    <title>ĐƠN THUỐC</title>
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
                <a href="{{ route('patient.info', $patient->id) }}">HỒ SƠ BỆNH NHÂN</a>
            </li>
            <li>
                <a href="{{route('prescription.current', $patient->id)}}">ĐƠN THUỐC HIỆN TẠI</a>
            </li>

        </ul>
    </div>
    <h3>CHẨN ĐOÁN</h3>
    <div class="info">
        <p>Mã bệnh nhân:   {{ $patient->id}}</p>
        <p>Tên bệnh nhân: {{ $patient->name_patient }}</p>
        <p>Giới tính: {{$patient -> gender }}</p>
        <form action="{{ route('diagnose',$patient->id)}}" method="POST">
            @csrf 
            Chẩn đoán 
            <input type="text" name="diagnose" id="diagnose" style="width: 40%">
            <button class="add-btn" style="padding: 7px 20px;" type="submit">Nộp</button>
        </form>        
    </div>
   
</body>
</html>
