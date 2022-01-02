<?php

namespace App;

use System\Database\ORM\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id', 'price' , 'authority' , 'ref_id'];

}