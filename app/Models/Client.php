<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'premium_due_date',
    ];
    public function calculatePremiumDueDate(): string
    {
        $period = $this->payment_period;
        $start = Carbon::parse($this->policy_start_date);
        
        switch ($period) {
            case 'monthly':
                return $start->addMonth()->format('Y-m-d');
                break;
            case 'quarterly':
                return $start->addMonths(3)->format('Y-m-d');
                break;
            case 'annually':
                return $start->addMonths(12)->format('Y-m-d');
                break;
            default:
                return '';
        }
    }

}
