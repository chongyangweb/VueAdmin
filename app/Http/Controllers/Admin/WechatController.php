<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use App\Model\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class WechatController extends Controller
{
    public function index(Request $req){
    	
    	$config = $this->getConfig();
		$app = Factory::officialAccount($config);
		$response = $app->server->serve();
		return $response;
    }

    public function getQrcode(Request $req){
    	$config = $this->getConfig();
		$app = Factory::officialAccount($config);
		$response = $app->oauth->scopes(['snsapi_login'])
                          ->redirect();
                          dd($response);
		return $response;
    }


    // 获取配置信息
    public function getConfig(){
    	$config = new Config;
    	$configInfo = $config->where('user_id',0)->where('is_type','wechat')->get();
    	foreach($configInfo as $v){
    		$configArr[$v['name']] = $v;
    	}

    	$configs = [
		    'app_id' => $configArr['app_id']['val'],
		    'secret' => $configArr['app_secret']['val'],
		    'secret' => $configArr['token']['val'],

		    // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		    'response_type' => 'array',

		    //...
		];

		return $configs;
    }

    
}
