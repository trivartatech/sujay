<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'patient_name',
        'content',
        'rating',
        'image',
        'consent_file',
        'is_approved',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_approved' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @param  Builder<Testimonial>  $query
     */
    public function scopeApproved(Builder $query): void
    {
        $query->where('is_approved', true);
    }
}
