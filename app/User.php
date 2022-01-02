<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class User extends Model
{
    use HasSoftDelete;

    protected $table = 'users';
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'avatar', 'status', 'is_active', 'user_type', 'verify_token', 'remember_token', 'remember_token_expire'];

    protected $deletedAt = 'deleted_at';
}
