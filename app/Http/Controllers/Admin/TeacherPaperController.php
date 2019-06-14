<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherPaper;
use App\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeacherPaperController extends BaseController
{
    public function index(Request $req,TeacherPaper $teacher_paper){
        $data['data'] = $this->getData($teacher_paper);
        $data['page'] = $this->getPage('TeacherPaper');
        return $data;
    }

    public function add(Request $req,TeacherPaper $teacher_paper){
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

        $rs = $teacher_paper->insert($data);
        return $this->returnData($rs);

    }

    public function edit(Request $req,TeacherPaper $teacher_paper,$id){
        if($req->isMethod('get')){
            $data['info'] = $teacher_paper->find($id);
            return $data;
        }

        if(empty($req->name)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['name'] = $req->name;

        $rs = $teacher_paper->where('id',$id)->update($data);
        return $this->returnData($rs);

    }

    public function del(Request $req,TeacherPaper $teacher_paper){
        $ids = explode(',',$req->id);
    	$rs = $teacher_paper->whereIn('id',$ids)->delete();
    	return $this->returnData($rs);
    }



}
