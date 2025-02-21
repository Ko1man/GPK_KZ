<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    protected $table ='users';


    public function comment(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
    public function group(){
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }
    public function attentions(){
        return $this->hasMany(Attention::class, 'user_id', 'id');
    }
}
