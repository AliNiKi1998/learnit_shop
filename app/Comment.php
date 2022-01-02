<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Comment extends Model
{
    use HasSoftDelete;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'professor_id', 'course_id', 'score', 'comment', 'parent_id', 'status', 'approved'];
    protected $deletedAt = 'deleted_at';

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

    public function professor()
    {
        return $this->belongsTo('\App\Professor', 'professor_id', 'id');
    }

    public function child()
    {
        return $this->hasMany('\App\Comment', 'parent_id', 'id');
    }
}
