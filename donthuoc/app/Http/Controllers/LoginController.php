<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $redirectTo = '/patients';
    protected function redirectTo()
    {
        if (Auth::guard('doctor')->check()) {
            return $this->redirectTo;
        } else {
            // Xử lý đường dẫn mong muốn cho các vai trò khác
            // Ví dụ:
            return '/';
        }
    }
}
