<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\User;
use App\Model\Role;
use App\Tools\Uploads;

class UserController extends BaseController
{
    public function index(Request $req,User $user){
        $this->where = empty($req->username)?'':[['username','like','%'.$req->username.'%']];
        $data['data'] = $this->getData($user);
        $data['page'] = $this->getPage('User');
        return $data;
    }

    public function add(Request $req,User $user,Role $role){
    	if($req->isMethod('get')){
    		$data['roleList'] = $role->get();
    		return $data;
    	}

        if(empty($req->username) || empty($req->password) || empty($req->role)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['username'] = $req->username;
        $data['password'] = $req->password;
        $data['email'] = $req->email;
        $data['nickname'] = $req->nickname;
        $data['role'] = $req->role;
        $data['add_time'] = time();

        if(!empty($req->avatar)){
            $data['avatar'] = $req->avatar;
        }

        $rs = $user->insert($data);
        return $this->returnData($rs);

    }

    public function edit(Request $req,User $user,Role $role,$id){
        if($req->isMethod('get')){
            $data['info'] = $user->find($id);
            $data['roleList'] = $role->get();
            return $data;
        }

        if(empty($req->username) || empty($req->password) || empty($req->role)){
            return $this->returnData(false,401,'请认真填写！');
        }

        $data['username'] = $req->username;
        $data['password'] = $req->password;
        $data['email'] = $req->email;
        $data['nickname'] = $req->nickname;
        $data['role'] = $req->role;
        $data['add_time'] = time();

        if(!empty($req->avatar)){
            $data['avatar'] = $req->avatar;
        }

        $rs = $user->where('id',$id)->update($data);
        return $this->returnData($rs);

    }

    public function del(Request $req,User $user){
        $ids = explode(',',$req->id);
    	$rs = $user->whereIn('id',$ids)->delete();
    	return $this->returnData($rs);
    }

    public function avatar(Request $req,Uploads $uploads){

    	$fileInfo = $uploads->uploads();
    	var_dump($fileInfo);
    	var_dump(Input::hasFile('file'));
    }
}
