<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $guarded = [];

    public function courses(){
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function groups(){
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }
}
