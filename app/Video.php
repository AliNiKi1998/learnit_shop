<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Video extends Model
{
    use HasSoftDelete;

    protected $table = 'videos';
    protected $fillable = ['name', 'time', 'video', 'professor_id', 'course_id', 'status'];

    protected $deletedAt = 'deleted_at';

    public function professor()
    {
        return $this->belongsTo('\App\Professor', 'professor_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo('\App\Course', 'course_id', 'id');
    }
}
