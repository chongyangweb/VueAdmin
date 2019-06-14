<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherClass;
use App\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeacherClassController extends BaseController
{
    public function index(Request $req,TeacherClass $teacher_class){
        $data['data'] = $this->getData($teacher_class);
        $data['page'] = $this->getPage('TeacherClass');
        return $data;
    }

    public function add(Request $req,TeacherClass $teacher_class){
    	if($req->isMethod('get')){
    		return;
    	}

        if(empty($req->name)){
            return $this->returnData(false,401,'请认真填写！');
        }
        $userInfo = $userInfo = JWTAuth::parseToken()->touser();
        $data['name'] = $req->name;
        $data['teacher_id'] = $userInfo['id'];
        $data['add_time'] = time();

        $rs = $teacher_class->insert($data);
        return $this->returnData($rs);

    }

    public function edit(Request $req,TeacherClass $teacher_class,$id){
        if($req->isMethod('get')){
            $data['info'] = $teacher_class->find($id);
            return $data;
        }

        if(empty($req->name)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['name'] = $req->name;

        $rs = $teacher_class->where('id',$id)->update($data);
        return $this->returnData($rs);

    }

    public function del(Request $req,TeacherClass $teacher_class){
        $ids = explode(',',$req->id);
    	$rs = $teacher_class->whereIn('id',$ids)->delete();
    	return $this->returnData($rs);
    }



}
