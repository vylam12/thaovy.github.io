<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DrugController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// tạo tài khoản bác sĩ
Route::get('/dk', [DoctorController::class, 'show'])->name('show');
Route::post('/dk/submit', [DoctorController::class, 'store'])->name('show.submit');
// đăng nhập
Route::get('/', [DoctorController::class, 'showLoginForm'])->name('doctor.login');
Route::post('doctor/login', [DoctorController::class, 'login'])->name('doctor.login.submit');
// đăng xuất
Route::post('doctor/logout', [DoctorController::class, 'logout'])->name('doctor.logout');

// trang chủ
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
// thêm bệnh nhân
Route::get('/patients/create', [PatientController::class, 'showAddPatientForm'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');

//bệnh nhân
Route::get('/patients/{id}', [PatientController::class, 'showPatientInfo'])->name('patient.info');  

// tới form kê 1 liều thuốc
Route::get('/medicine/{id}', [MedicineController::class, 'donThuoc'])->name('medicine');
Route::post('/medicine/{id}/diagnose', [MedicineController::class, 'diagnose'])->name('diagnose');
Route::get('/medicine/{id}/diagnose/{prescriptionId}', [MedicineController::class, 'diagnose_prescriptionId'])->name('diagnose.prescriptionId');
Route::get('/medicine/{id}/dose/{prescriptionId}', [MedicineController::class,'showKeDonForm'])->name('dose');
Route::post('/medicine/{id}/doseCheck/{prescriptionId}', [MedicineController::class,'doseCheck'])->name('dose.check');
Route::post('/medicine/delete/{prescriptionId}/{iddrug}', [MedicineController::class,'deleteDrug'])->name('delete.drug');

//đơn thuốc hiện tại 
Route::get('/medicine/prescription.current/{id}', [MedicineController::class, 'prescriptionCurrent'])->name('prescription.current');
//chi tiết đơn thuốc
Route::get('/medicine/{id}/DetailPres/{prescriptionId}', [MedicineController::class, 'prescriptionDetail'])->name('prescription.detail');
//đơn thuốc mới dựa trên đơn hiện tại
//Route::get('/medicine/prescription.New/{id}/{prescriptionId}', [MedicineController::class, 'prescriptionNew'])->name('new.prescription');
//Route::post('/medicine/prescription.New.ke/{id}/{prescriptionIdnew}', [MedicineController::class, 'checkprescriptionNew'])->name('new.prescription.check');