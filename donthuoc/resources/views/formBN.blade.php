<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">    
    <title>THÊM BỆNH NHÂN</title>
    <style>
       
        label {
            font-weight: bold;     
        }
        /* CSS cho cột */
        .col {
            flex: 2;
            margin-right: 10px;
        }
        .kieuchu{
            font-size: 15px;
            font-weight: 300;
        }
        .diennd{
            width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>THÔNG TIN BỆNH NHÂN</h2>
        <div class="navigation">
            <div class="tieude">
                Nhập thông tin bệnh nhân
            </div>  
        </div>    
        <div class="diennd">
            <form action="{{ route('patients.store') }}"  method="POST">
                @csrf 
                <div class="row">
                    <div class="col">
                        <label for="">Họ và tên</label>
                        <input type="text" name="txtFullname" id="txtFullname" placeholder="Nguyễn Văn A">
                    </div>
                    <div class="col">
                        <label for="">Giới tính</label>
                        <input type="text" name="gender" id="gender" placeholder="Nữ">
                    </div>
                </div>    
                <div class="row">
                    <div class="col">
                        <label for="">Ngày sinh</label>
                        <input type="date" name="birthday" id="birthday">
                    </div>
                    <div class="col">
                        <label for="">Số CCCD</label>
                        <input type="text" name="CCCD" id="CCCD" placeholder="3245423223">
                    </div>
                </div>        
                <div class="row">
                    <div class="col">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="txtAddress" id="txtAddress" placeholder="Hải Châu - Đà Nẵng">
                    </div>
                    <div class="col">
                        <label for="phone">SĐT</label>
                        <input type="text" name="phone" id="phone" placeholder="0582341134">
                    </div>
                </div>                   
                <p class="kieuchu">Thông tin thêm:</p>                         
                <div class="row">
                    <div class="col">
                        <label for="">Cân nặng</label>
                        <input type="number" name="txtWeigh" id="txtWeigh">
                    </div>
                    <div class="col">
                        <label for="">Nhóm máu</label>
                        <input type="text" name="bloodGroup" id="bloodGroup">
                    </div>
                </div>                                                               
                <button class="add-btn" type="submit">Thêm bệnh nhân</button>
            </form>
            <button class="add-btn"  onclick="window.location.href='{{ route('patients.index') }}'">Quay lại</button>
        </div>        
    </div>
   

</body>
</html>