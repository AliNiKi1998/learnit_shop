<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Professor extends Model
{
    use HasSoftDelete;

    protected $table = 'professors';
    protected $casts = ['image' => 'array'];
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'image', 'status', 'is_active', 'description', 'facebook', 'instagram', 'telegram', 'verify_token', 'remember_token', 'remember_token_expire'];

    protected $deletedAt = 'deleted_at';

    public function courses(){
        return $this->hasMany('\App\Course' , 'professor_id' , 'id');
    }
}
