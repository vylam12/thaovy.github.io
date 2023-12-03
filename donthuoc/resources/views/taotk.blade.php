<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <title>Document</title>
</head>
<body>
  <h3>ĐĂNG KÝ TÀI KHOẢN KÊ THUỐC CỦA BÁC SĨ</h3>
  <div class="diennd">
    <form action="{{route('show.submit')}}" method="POST">
      @csrf       
      Họ và tên: 
      <input type="text" name="txtNameDoctor" id="txtNameDoctor">
      <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="txtEmail" id="txtEmail" aria-describedby="emailHelpId" placeholder="">      
      </div>
      <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="">
      </div>
      <label for="">Số điện thoại</label>
      <input type="text" name="phone">
      <label for="">Địa chỉ</label> 
      <input type="text" name="txtAdress" >
      <button class="add-btn"  type="submit">Tạo tài khoản</button>
    </form>
  </div>  
</body>
</html>