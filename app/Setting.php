<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Setting extends Model
{
    use HasSoftDelete;

    protected $table = 'settings';
    protected $fillable = ['email', 'phone', 'description', 'location', 'telegram', 'instagram', 'facebook'];

    protected $deletedAt = 'deleted_at';
}