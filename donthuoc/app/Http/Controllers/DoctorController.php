<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class DoctorController extends Controller
{
    public function show()
    {
        return view('taotk');
    }
    public function store(Request $request)
    {
        $name = $request->input('txtNameDoctor');
        $phone = $request->input('phone');
        $address = $request->input('txtAdress');
        $email = $request->input('txtEmail');
        $password = $request->input('password');
    
        $hashedPassword = Hash::make($password);
    
        $query = "INSERT INTO doctor (`name_doctor`, `email`, `phone`, `address`, `password`) 
        VALUES (?, ?, ?, ?, ?)";
    
        DB::insert($query, [$name, $email, $phone, $address, $hashedPassword]);
    
        // Thực hiện các hành động khác sau khi tạo bác sĩ thành công
    
        return redirect()->route('show')->with('success', 'Bác sĩ đã được thêm thành công.');
    }
    public function showLoginForm()
    {
        return view('login');
    }
    

    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('doctor')->attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/patients');
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->withErrors(['message' => 'Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin đăng nhập.']);
        }    
    }

  
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
