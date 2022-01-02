<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class UserCourse extends Model
{
    use HasSoftDelete;

    protected $table = 'users_courses';
    protected $fillable = ['user_id', 'course_id', 'price' , 'payment_code'];

    protected $deletedAt = 'deleted_at';

    public function course()
    {
        return $this->belongsTo('\App\Course', 'course_id', 'id');
    }

}
