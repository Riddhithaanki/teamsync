<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


    class Task extends Model
{
    protected $fillable = ['task_id', 'task_name', 'task_desc', 'task_status','task_priority','task_created_by','Task_project_id','created_at','updated_at'];

    public function user() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}


