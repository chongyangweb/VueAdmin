<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Model\Cat;

class IndexController extends BaseController
{
    public function index(Request $req,Cat $cat){
        $data['cat'] = getTree($cat->orderBy('sort','asc')->get());
        $data['user'] = JWTAuth::parseToken()->touser();
        return $data;
    }
}
