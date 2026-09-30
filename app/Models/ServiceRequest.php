<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'service_type',
        'system_size',
        'notes',
        'status',
    ];
}
