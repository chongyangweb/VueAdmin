<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\TeacherExtend;
use App\Model\TeacherGrade;
use App\Model\TeacherSubject;
use App\Model\TeacherSignLog;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends BaseController
{
    // 查看日志
    public function getSign(Request $req,TeacherSignLog $teacher_sign_log,TeacherExtend $teacher_extend,TeacherGrade $teacher_grade,TeacherSubject $teacher_subject){
        $time = date('Y-m-d');
        $userInfo = JWTAuth::parseToken()->touser();
        $data['today'] = $teacher_sign_log->where(['user_id'=>$userInfo['id'],'format_time'=>$time])->exists();
        $data['count'] = count($teacher_sign_log->select('id','format_time')->where(['user_id'=>$userInfo['id']])->groupBy('format_time')->get());
        $extend = $teacher_extend->where('user_id',$userInfo['id'])->first();
        $grade = $teacher_grade->find($extend['grade_id']);
        $subject = $teacher_subject->find($extend['subject_id']);
        $data['grade'] = empty($grade)?'其他':$grade['name'];
        $data['subject'] = empty($subject)?'其他':$subject['name'];
        return $this->successMsg('ok',$data);
    }
    
}
