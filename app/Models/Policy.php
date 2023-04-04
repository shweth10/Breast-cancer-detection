<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    public function insurer()
    {
        return $this->belongsTo('App\Models\User', 'insurer_id');
    }
    
    protected $table = 'policies';

    protected $fillable = [
        'Insurer_id',
        'policy_type',
        'coverage_information',
        'coverage_amount',
        'premium_amount',
        'payment_period',
        'policy_duration',
    ];

}
