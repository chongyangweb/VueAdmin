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
    public function getSign(Request $req,TeacherSignLog $teacher_sign_log){
        $time = date('Y-m-d');
        $userInfo = JWTAuth::parseToken()->touser();
        $data['today'] = $teacher_sign_log->where(['user_id'=>$userInfo['id'],'format_time'=>$time])->exists();
        $data['count'] = count($teacher_sign_log->select('id','format_time')->where(['user_id'=>$userInfo['id']])->groupBy('format_time')->get());
        return $this->successMsg('ok',$data);
    }
    
}
