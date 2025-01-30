<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'news';
    protected $guarded = [];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id');
    }
}
