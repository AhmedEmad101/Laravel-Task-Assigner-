<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.ZZZZZZZZZZZZ
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
    }//////////////////////////////////////////////////////////////////////////////////////////////////////////
    //relations
    public function UserProjects()
    {
       return $this->hasMany(Project::class ,'Creator');//->withDefault();
    }
    public function IsAdmin()
    {
       return $this->role === 2;
    }
    public function Subscription()
    {
        return $this->hasOne(Subscription::class ,'user_Id');//->withDefault();//to prevent attempt to read a property on null
    }
    public function WorkOnTask()
    {
        return $this->hasMany(WorkOn::class ,'user_Id' );//->withDefault();;
    }

























    public function IsLeader(User $user)
    {
        if($user->role == 2)
        {
            return true;
        }
    }
}
