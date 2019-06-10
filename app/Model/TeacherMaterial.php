<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherMaterial extends Model
{
    protected $table = "teacher_material"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;

}
