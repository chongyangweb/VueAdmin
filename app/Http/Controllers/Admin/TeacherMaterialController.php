<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherMaterial;

class TeacherMaterialController extends BaseController
{
    public function index(Request $req,TeacherMaterial $teacher_material){
        $data['data'] = $this->getData($teacher_material);
        $data['page'] = $this->getPage('TeacherMaterial');
        return $data;
    }

    public function add(Request $req,TeacherMaterial $teacher_material){
    	if($req->isMethod('get')){
    		return;
    	}

        if(empty($req->name)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['name'] = $req->name;

        $rs = $teacher_material->insert($data);
        return $this->returnData($rs);

    }

    public function edit(Request $req,TeacherMaterial $teacher_material,$id){
        if($req->isMethod('get')){
            $data['info'] = $teacher_material->find($id);
            return $data;
        }

        if(empty($req->name)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['name'] = $req->name;

        $rs = $teacher_material->where('id',$id)->update($data);
        return $this->returnData($rs);

    }

    public function del(Request $req,TeacherMaterial $teacher_material){
        $ids = explode(',',$req->id);
    	$rs = $teacher_material->whereIn('id',$ids)->delete();
    	return $this->returnData($rs);
    }



}
