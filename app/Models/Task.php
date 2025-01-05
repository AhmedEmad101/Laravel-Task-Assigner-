<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{protected $fillable = ['Creator','Project_ID','name','Description'];
public function User()
{
    return $this->BelongsTo(User::class , 'Creator');
}
public function Project()
{
    return $this->belongsTo(Project::class , 'Project_ID');
}
public function Users_Work_On_Tasks()
{
return $this->hasMany(WorkOn::class ,'task_id');
}
}
