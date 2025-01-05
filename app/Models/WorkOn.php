<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOn extends Model
{
  protected $fillable = ['user_Id','project_id','task_id'];





  //////////////////////////////////// R E L A T I O N S //////////////////////////////////////
  public function User(){
  return $this->belongsTo(User::class,'user_Id','id');
  }
  public function Task()
  {
    return $this->belongsTo(Task::class,'task_id','id');
  }
}
