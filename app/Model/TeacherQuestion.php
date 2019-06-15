<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherQuestion extends Model
{
    protected $table = "teacher_question"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;

    public function get_grade(){
    	return $this->hasOne('App\Model\TeacherGrade','id','grade_id');
    }

    public function get_subject(){
    	return $this->hasOne('App\Model\TeacherSubject','id','subject_id');
    }

    public function get_answer(){
    	return $this->hasMany('App\Model\TeacherAnswer','question_id','id');
    }

    public function get_material(){
        return $this->hasOne('App\Model\TeacherMaterial','id','material_id');
    }

}
