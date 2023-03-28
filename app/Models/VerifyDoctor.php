<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyDoctor extends Model
{
    use HasFactory;

    public $table = "verify_doctors";
    
    protected $fillable = [
        'doctor_id',
        'token',
    ];


    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
