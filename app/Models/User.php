<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
         
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $fillable = [
        'nik','password','role_id','name','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function coachTrainee(){
      return $this->hasMany('App\Models\CoachTrainee');
    }
}
