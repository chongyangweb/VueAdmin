<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use App\Model\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class WechatController extends Controller
{
    public function index(Request $req,Config $config){
    	$configInfo = $config->where('user_id',$userInfo['id'])->where('is_type','wechat')->get();
    	foreach($configInfo as $v){
    		$configArr[$v['name']] = $v;
    	}
    	$configs = [
		    'app_id' => $configArr['app_id']['val'],
		    'secret' => $configArr['app_secret']['val'],

		    // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		    'response_type' => 'array',

		    //...
		];

		$app = Factory::officialAccount($configs);

		$response = $app->server->serve();

		return $response;
    }

    
}
