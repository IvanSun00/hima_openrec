<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dept_id',
        'major_id',
        'line',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at',
    ];


      /**
     * Get the attributes that should be cast.
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

    /**
     * Rules that applied in this model
     *
     * @var array
     */

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'dept_id' => 'required|uuid|exists:departments,id',
            'major_id' => 'required|uuid|exists:majors,id',
            'line' => 'required|string|max:20',
        ];
    }

    /**
     * Messages that applied in this model
     * 
     * @var array
     */
    public static function validationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 100 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email has been taken',
            'dept_id.required' => 'Department is required',
            'dept_id.uuid' => 'Department must be a valid UUID',
            'dept_id.exists' => 'Department not found',
            'major_id.required' => 'Major is required',
            'major_id.uuid' => 'Major must be a valid UUID',
            'major_id.exists' => 'Major not found',
            'line.required' => 'Line is required',
            'line.string' => 'Line must be a string',
            'line.max' => 'Line must not exceed 20 characters',
        ];
    }
}
