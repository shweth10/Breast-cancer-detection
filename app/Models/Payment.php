<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'client_fname',
        'client_email',
        'payment_method',
        'premium_amount',
        'payment_period',
        'policy_type',
        'payment_date',
        'next_payment_date'
    ];
    public function calculatePremiumDueDate(): string
    {
        $period = $this->payment_period;
        $start = Carbon::parse($this->payment_date);
        
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
