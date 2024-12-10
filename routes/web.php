<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
#TODO: render หน้า dashboard โดยต้องผ่าน middleware 2 กรณี 1.loginแล้ว(auth) 2.ยืนยันแล้ว(verified)
#ใช้ Indertia render หน้าไฟล์ react -> route name 'dashboard'

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
#TODO: จะเข้าหน้า profile ผู้ใช้ต้อง auth (ล็อคอินก่อนอยู่แล้วแน่นอน)
#ถ้าผู้ใช้เข้า request หน้า route ปกติจะ send GET request โดยเรียกใช้ Method edit ของ ProfileController
#ถ้าผู้ใช้เข้า request PATCH  request โดยเรียกใช้ Method update  ของ ProfileController
#ถ้าผู้ใช้เข้า request DELETE request โดยเรียกใช้ Method destroy  ของ ProfileController

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

#TODO: เรียกใช้ ChirpController เพื่อจัดการทรัพยากรต่างๆใน chirps route โดยไม่เรียกมาทั้งหมดใช้แค่ระบุเฉพาะ (->only([]))
#TODO: Route::resource ช่วยสร้าง Route หลายตัวสำหรับการจัดการทรัพยากร (Resource) เช่น การสร้าง แสดง แก้ไข และลบ
require __DIR__ . '/auth.php';
