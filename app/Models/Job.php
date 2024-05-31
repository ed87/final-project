<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
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

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'job_applications', 'job_id', 'applicant_id')
            ->withPivot('id', 'status', 'cv_file', 'company_id')
            ->withTimestamps();
    }
}
