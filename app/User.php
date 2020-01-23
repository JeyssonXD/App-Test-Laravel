<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    //table name
    protected $table = 'users';
    //attributes
    protected $primaryKey = 'id';
    
    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relationship's
    public function roles(){
        return $this->belongsToMany('App\role',"userRole","idUser","idRole");
    }

    

    /**
     * methods 
     * 
     */
    // public function hasRole($role)
    // {
    //     return null !== $this->roles()->where('name', $role)->first();
    // }

    public function hasAnyRole($roles)
    {
        $roles = explode("|",$roles);
        $HasRoles = $this->roles()->whereIn('name', $roles)->count();
        if($HasRoles>0) return true;
        else return false;
    }

    // public function authorizeRoles($roles)
    // {
    //     if (is_array($roles)) {
    //         return $this->hasAnyRole($roles) || 
    //                 abort(401, 'This action is unauthorized.');
    //     }
    //     return $this->hasRole($roles) || 
    //             abort(401, 'This action is unauthorized.');
    // }
}
