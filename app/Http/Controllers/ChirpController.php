<?php


namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{

    public function index()
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
        #TODO: ใช้ช้คำสั่ง with() เพื่อดึงข้อมูลจาก user ที่เกี่ยวข้องกับแต่ละ Chirp ใช้ get() ดึงมาทั้งหมดและ latest() เรียงจากล่าสุดก่อน
        #TODO://Inertia::render ส่งข้อมูลจาก Laravel ไปยัง Vue.js/React ผ่าน Inertia.js โดยไม่ต้องสร้าง API แยก
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            #TODO://ตรวจสอบว่า message ต้องมีค่า(required) | type : string | max:255
        ]);

        $request->user()->chirps()->create($validated);
        #TODO://ถ้าเงื่อนไขครบ สร้าง Chirp โดยใหม่เชื่อมโยง chirp กับ user เข้าด้วยกันในโมเดล

        return redirect(route('chirps.index'));
        #TODO://หลังจากสร้าง chirp เสร็จให้ render หน้า index
    }


    public function show(Chirp $chirp)
    {
        //
    }


    public function edit(Chirp $chirp)
    {
        //
    }


    public function update(Request $request, Chirp $chirp)
    {
        Gate::authorize('update', $chirp);
        #TODO:ใช้ Gate เพื่อตรวจสอบสิทธ์ของผู้ใช้ว่ามีสิทธิ์แก้ไขโพสต์หรือป่าว
        #TODO:[Gate::authorize เพื่อความปลอดภัย ป้องกันไม่ให้ผู้ใช้คนอื่นแก้ไข/ลบโพสต์ที่ไม่ใช่ของตัวเอง]

        $validated = $request->validate([
            'message' => 'required|string|max:255',
            #TODO: ตรวจสอบค่า
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }


    public function destroy(Chirp $chirp)
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
