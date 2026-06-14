<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'reason',
        'status',
        'notes',
        'consent',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
            'status' => AppointmentStatus::class,
            'consent' => 'boolean',
        ];
    }
}
