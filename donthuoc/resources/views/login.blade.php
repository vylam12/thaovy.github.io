<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Familjen+Grotesk&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Familjen+Grotesk&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{('public/frontend/css/login.css')}}">    
    <title>ĐƠN THUỐC</title>
</head>
<body>
    
        <form class="layout" action="{{ route('doctor.login.submit') }}" method="POST"> 
            @csrf       
            <div class="tieudeform">
                ĐĂNG NHẬP  
            </div>
            <div class="tenDN">
                <span class="input-icon"><i class="fa-solid fa-user-doctor"></i></span>               
                <input type="text" name="email" id="email" placeholder="Tên đăng nhập">      
            </div>                        
            <div class="matkhau">           
                <span class="input-icon"><i class="fa-solid fa-lock"></i></span>               
                <input type="password" name="password" id="password" placeholder="Mật khẩu">      
            </div>         
            <div class="submit">                
                <button type="submit" class="dangnhap">Đăng nhập</button>
            </div>                                
        </form>
    
</body>
</html>