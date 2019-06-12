<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserWechat;
use App\Model\User;
use App\Model\TeacherExtend;
use App\Model\TeacherGrade;
use App\Model\TeacherSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends BaseController
{
    // 获取用户信息
    public function get_user_info(Request $req,TeacherExtend $teacher_extend){
        $userInfo = JWTAuth::parseToken()->touser();
        $extend = $teacher_extend->where('user_id',$userInfo['id'])->first();
        $userInfo['extend'] = $extend;
        return $this->successMsg('ok',$userInfo);
    }

    // 获取年级班级
    public function get_grade_subject(Request $req,TeacherGrade $teacher_grade,TeacherSubject $teacher_subject,TeacherExtend $teacher_extend){
        $userInfo = JWTAuth::parseToken()->touser();
        $data['grade'] = $teacher_grade->get();
        $data['subject'] = $teacher_subject->get();
        $data['extend'] = $teacher_extend->where('user_id',$userInfo['id'])->first();
        return $this->successMsg('ok',$data);
    }

    // 修改学习范围
    public function edit_learning_scope(Request $req,TeacherExtend $teacher_extend){
        $userInfo = JWTAuth::parseToken()->touser();
        $data['grade_id'] = $req->grade_id;
        $data['subject_id'] = $req->subject_id;
        $data['question_num'] = $req->question_num;
        $teacher_extend->where('user_id',$userInfo['id'])->update($data);
        return $this->successMsg();
    }
    
}
