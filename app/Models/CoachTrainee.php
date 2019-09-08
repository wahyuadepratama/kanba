<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachTrainee extends Model
{
    protected $table = 'coach_trainees';
    protected $fillable = [
        'id','coach_nik', 'trainee_nik', 'month', 'year', 'created_at','updated_at'
    ];

    public function trainee(){
      return $this->belongsTo('App\Models\User','trainee_nik');
    }

    public function coach(){
      return $this->belongsTo('App\Models\User','coach_nik');
    }

    public function schedule(){
      return $this->hasMany('App\Models\Schedule');
    }
}
