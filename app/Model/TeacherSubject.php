<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $table = "teacher_subject"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;
}
