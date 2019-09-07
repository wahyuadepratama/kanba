<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'id','datetime', 'actual', 'relationship_id', 'status', 'photo'
  ];

  public function relationship(){
    return $this->belongsTo('App\Models\CoachTrainee','relationship_id');
  }
}
