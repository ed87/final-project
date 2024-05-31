<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    const TYPE_ADMIN = 'admin';
    const TYPE_COMPANY = 'company';
    const TYPE_APPLICANT = 'applicant';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jobApplications()
    {
        return $this->belongsToMany(Job::class, 'job_applications', 'applicant_id', 'job_id')
        ->withPivot('id', 'status', 'company_id')
        ->withTimestamps();;
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function university()
    {
        return $this->hasOne(University::class);
    }
}
