<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_user extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'user_id'];
}