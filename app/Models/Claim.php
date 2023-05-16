<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'policy_type',
        'incident_details',
        'client_id',
        'proof',
        'claim_amount',
        'approval_status',
    ];

    // Define any relationships or additional methods related to the Claim model here
}