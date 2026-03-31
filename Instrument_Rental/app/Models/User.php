<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;


    /**
     * Attributes that can be filled by the user.
     * These fields can be filled using create() or fill() methods.
     * Prevents mass assignment vulnerabilities by whitelisting safe fields.
     *
     * @var array<string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * Attributes that should be hidden for serialization.
     * These fields will not be visible in JSON responses.
     * Protects sensitive data from being exposed to the frontend.
     *
     * @var array<string>
     */

    protected $hidden = [
        'is_admin',
        'password',
        'remember_token',
    ];

    /**
     * Cast model attributes to specific types.
     * Defines how certain fields are automatically converted when accessed.
     * Ensures type safety and automatic transformation of stored values.
     *
     * - email_verified_at: converted to a datetime object
     * - password: automatically hashed when set
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
