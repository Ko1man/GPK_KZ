<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function attentions(){
        return $this->hasMany(Attention::class, 'group_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Departments::class, 'department_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
