<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Table name in database
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_url',
        'biography',
        'role',
        'provider_id',
        'provider_name',
        'payer_email'
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

    /**
     * Set password hashing algorithm attributes.
     *
     * @param mixed $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Check if the user has admin role.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->attributes['role'] === UserRole::ADMIN;
    }

    /**
     * Check if the user has moderator role.
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->attributes['role'] === UserRole::MODERATOR;
    }

    /**
     * Check if the user has instructor role.
     *
     * @return bool
     */
    public function isInstructor()
    {
        return $this->attributes['role'] === UserRole::INSTRUCTOR;
    }

    /**
     * Check if the user has learner role.
     *
     * @return bool
     */
    public function isLearner()
    {
        return $this->attributes['role'] === UserRole::LEARNER;
    }
}
