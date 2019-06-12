<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherStudentStage extends Model
{
    protected $table = "teacher_student_stage"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;

}
