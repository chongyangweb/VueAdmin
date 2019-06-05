<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "config"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;
}
