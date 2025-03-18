<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupschat extends Model
{
    use HasFactory;
    protected $table = 'groupschat';
    protected $fillable = ['sender_id', 'groups_id','body'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }
}