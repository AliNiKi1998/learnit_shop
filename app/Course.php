<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Course extends Model
{
    use HasSoftDelete;

    protected $table = 'courses';
    protected $casts = ['image' => 'array'];
    protected $fillable = ['name', 'time', 'image', 'description', 'price', 'tags', 'user_id', 'cat_id', 'professor_id', 'status'];

    protected $deletedAt = 'deleted_at';

    public function category()
    {
        return $this->belongsTo('\App\Category', 'cat_id', 'id');
    }

    public function professor(){
        return $this->belongsTo('\App\Professor', 'professor_id', 'id');
    }

    public function students(){
        return $this->hasMany('\App\UserCourse' , 'course_id' , 'id');
    }

    public function score(){
        return $this->hasMany('\App\Comment' , 'course_id' , 'id');
    }
}
