<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function insurer()
    {
        return $this->belongsTo('App\Models\User', 'insurer_id');
    }
    
    protected $table = 'clients';

    protected $fillable = [
        'Insurer_id',
        'client_fname',
        'Age',
        'driving_license_number',
        'client_email',
        'phone_number',
        'vehicle_model',
        'vehicle_registration',
        'premium_amount',
        'payment_period',
        'policy_type',
        'policy_id',
        'policy_duration',
        'coverage_amount',
        'policy_start_date',
    ];
}
