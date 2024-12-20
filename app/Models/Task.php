<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{protected $fillable = ['Creator','Project_ID','name','description'];
public function Project()
{
    return $this->belongsTo(Project::class , 'Project_ID');
}
public function UserTasks()
{
return $this->hasMany(WorkOn::class ,'task_id');
}
}
