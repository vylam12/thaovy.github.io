<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>      
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Familjen+Grotesk&family=Nunito:wght@800&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Barlow+Condensed&family=Chakra+Petch:wght@300&family=Familjen+Grotesk&family=Nunito:wght@800&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <title>THÔNG TIN BỆNH NHÂN</title>
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
        <a href="{{route('prescription.current', $patient->id)}}">ĐƠN THUỐC HIỆN TẠI</a>
      </li>
      <li>
        <a href="{{ route('medicine', $patient->id) }}">ĐƠN THUỐC MỚI</a>
      </li>

    </ul>
  </div>  
  
  <h3>THÔNG TIN BỆNH NHÂN</h3>
  <div class="info">    
    
    <p>Mã bệnh nhân:   {{ $patient->id}}</p>
    <p>Tên bệnh nhân: {{ $patient->name_patient }}</p>
    Ngày sinh: {{$patient->birthday}}    
    <p> Giới tính: {{$patient->gender}} </p>
    <p>Số điện thoại: {{ $patient->phone }}</p>
    <p>Thông tin thêm:</p>
    <p>Cân nặng: {{$patient->weight}} kg</p>
    <p>Nhóm máu: {{$patient->blood_group}}</p>
  </div>   
 
</body>
</html>