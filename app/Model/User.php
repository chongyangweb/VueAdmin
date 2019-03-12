<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;
}
