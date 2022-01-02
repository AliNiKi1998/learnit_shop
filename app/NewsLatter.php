<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class NewsLatter extends Model
{
    use HasSoftDelete;

    protected $table = 'news_letter_email';
    protected $fillable = ['email'];
    protected $deletedAt = 'deleted_at';
}
