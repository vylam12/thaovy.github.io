<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{('public/frontend/css/home.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">    
    <link rel="stylesheet" href="http://localhost/donthuoc/public/frontend/css/chung.css">
    <title>QUẢN LÝ HỒ SƠ</title>
    <style>
        .alert {
            padding: 10px;
            width: 740px;       
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
            margin-right: 150px;
        }

        .alert.alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
    </style>
</head>
<body>
    <div class="container">        
        <div class="nen">
            <img src="{{('public/frontend/img/prescribe medicine.jpg')}}" alt="Hình nền">
        </div>               
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="tieude">
            <h3>QUẢN LÝ HỒ SƠ BỆNH NHÂN</h3>
        </div>        
        {{-- <form action="{{ route('doctor.logout') }}" method="POST">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form> --}}
        <div class="danhsach">
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Giới tính</th>     
                        <th scope="col"></th>           
                    </tr>
                </thead>
                <tbody>        
                    @foreach ($patients as $patient)                                                
                    <tr>
                        <td scope="row">
                            {{ $patient->id }}
                        </td>                
                        <td>                         
                            <a href="{{ route('patient.info',$patient->id) }}">
                                {{ $patient->name_patient }}
                            </a>        
                        </td>
                        <td>
                            {{ $patient->gender }}
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="add-btn" onclick="window.location.href='{{ route('patients.create') }}'">Thêm bệnh nhân</button>        
    </div>  
</body>
</html>