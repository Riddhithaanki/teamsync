<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendences extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_name', 'time_in', 'time_out','status','location'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
