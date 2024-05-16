<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'payment_status',
        'date_paid',
        'profile',
        'notification_content',
    ];
}
