<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        return $chirp->user()->is($user);
        #TODO:ใช้ตรวจสอบว่าผู้ใช้ที่ล็อกอินอยู่ ($user) เป็นเจ้าของ chirp นี้หรือไม่
        #is($user): เปรียบเทียบว่า user ในระบบกับ user ที่สัมพันธ์ในโมเดล Chirp เป็นคนเดียวกันหรือไม่
    }
    #TODO:ใช้เพื่อให้ Gate ตรวจสอบสิทธิ์

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        return $this->update($user, $chirp);
        #TODO: ใช้ให้ Gate ตรวจสอบสิทธิ์ในการลบโดย this นี้อ้างอิงถึงฟังก์ชันอื่นๆ ในกรณีนี้ func delete อ้างถึง func update
        #เพื่อที่ update จะตรวจสอบว่า ผู้ใช้ $user เป็นเจ้าของ chirp หรือไม่ โดยส่ง parameter ไปสองตัวคือ user และ chirp
        #ถ้าเราไม่ใช้ อินสแตนซ์ ($this) จะต้องเขียน script ซ้ำเหมือนกับ func update
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false;
    }
}
