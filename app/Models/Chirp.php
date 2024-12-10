<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];
    //TODO: เพื่อป้องกันการโจมตีแบบ Mass Assighnment กำหนดให้ เฉพาะฟิลด์ message เท่านั้นที่สามารถเพิ่มข้อมูลได้

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    } #TODO: กำหนดความสัมพันธ์ว่า Chirp แต่ละรายการเป็นของผู้ใช้งานเพียงคนเดียว (BelongsTo)
}
