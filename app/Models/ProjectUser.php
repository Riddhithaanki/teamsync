<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{   
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'project_id', 'created_at','updated_at'];

    
}