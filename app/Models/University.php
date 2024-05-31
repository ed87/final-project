<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'email',
        'description',
    ];
    
    public function internshipApplications()
    {
        return $this->belongsToMany(Internship::class, 'internship_applications', 'university_id', 'internship_id')
        ->withPivot('id', 'status', 'company_id')
        ->withTimestamps();
    }
}
