<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cat;

class IndexController extends Controller
{
    public function index(Request $req,Cat $cat){
        $data['cat'] = getTree($cat->orderBy('sort','asc')->get());
        return $data;
    }
}
