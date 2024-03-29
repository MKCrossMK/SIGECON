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
        'lastname', 
        'user',
        'email',
        'password',
        'rol_id',
        'branch_office_id',
        'status',
        'cash_id', 
        'unique_code'
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



    public function role()
    {
        return $this->belongsTo(Role::class, 'rol_id', 'id');
    }

    public function branch_office() {
        return $this->belongsTo(Branch_Office::class, 'branch_office_id', 'id');
    }

    public function fullname(){
        return $this->name . " " . $this->lastname;
    }

    public function cash(){
        return $this->belongsTo(Cash::class, 'cash_id', 'id');
    }

}
