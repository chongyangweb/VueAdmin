<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherSignLog extends Model
{
    protected $table = 'teacher_sign_log'; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;

}
