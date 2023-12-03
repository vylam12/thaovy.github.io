<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function store(Request $request)
    {
        // Lấy ID người đăng nhập
        $id_doctor = Auth::id();        

        return redirect()->back()->with('success', 'Đơn thuốc đã được kê thành công.');
    }
}
