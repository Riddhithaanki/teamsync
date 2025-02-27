<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    use HasFactory;
    protected $fillable = ['id', 'created_by_id', 'project_name', 'Project_desc','project_tech','project_start_date','project_end_date','created_at','updated_at'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
