<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_PENDING = 'pending';
    const STATUS_REJECTED = 'rejected';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function universityApplicants()
    {
        return $this->belongsToMany(University::class, 'internship_applications', 'internship_id', 'university_id')
            ->withPivot('id', 'status', 'company_id', 'internship_letter')
            ->withTimestamps();
    }
}
