<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    protected $table = "teacher_class"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;
}
