<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOn extends Model
{
  protected $fillable = ['user_Id','project_id','task_id'];
}
