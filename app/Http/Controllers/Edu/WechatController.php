<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use App\Model\Config;
use App\Model\UserWechat;
use App\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class WechatController extends Controller
{
    

    // 掉起微信的授权
    public function getWechat(Request $req){
    	$config = $this->getConfig();
        $config['oauth']['callback'] = '/api/Edu/wechat/callback';
        $config['oauth']['scopes'] = ['snsapi_userinfo'];
		$app = Factory::officialAccount($config);
		$response = $app->oauth->redirect();
		return $response;
    }

    // 授权成功就得回调
    public function callback(Request $req){
        $config = $this->getConfig();
        $app = Factory::officialAccount($config);
        $oauth = $app->oauth;
        $user = $oauth->user();
        $userWechat = $user->original;
        $openid = $this->wechatLogin($userWechat);
        header('location:'. 'http://edu.qingwuit.com/user/wechat/login/'.$openid); // 跳转到 user/profile
    }

    // 微信登录  userWechat 为微信网页授权获取的信息
    public function wechatLogin($userWechat){
        $user_wechat = new UserWechat;
        $user = new User;
        $wechatInfo = $user_wechat->where('user_id','>',0)->where('openid',$userWechat['openid'])->first();
        if(empty($wechatInfo)){
            // 新建账号
            $userData['username'] = substr($userWechat['openid'],0,15);
            $userData['nickname'] = $userWechat['nickname'];
            $userData['password'] = Hash::make($userWechat['openid']);
            $userData['gender'] = $userWechat['sex'];
            $userData['avatar'] = $userWechat['headimgurl'];
            $userData['add_time'] = time();
            $user_id = $user->insertGetId($userData);

            // 插入微信信息
            $wechatData['openid'] = $userWechat['openid'];
            $wechatData['nickname'] = $userWechat['nickname'];
            $wechatData['sex'] = $userWechat['sex'];
            $wechatData['avatar'] = $userWechat['headimgurl'];
            $wechatData['user_id'] = $user_id;
            $wechatData['add_time'] = time();
            $user_wechat->insert($wechatData);
        }

        return $userWechat['openid'];

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
            'token' => $configArr['token']['val'],

		    // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		    'response_type' => 'array',

		    //...
		];

		return $configs;
    }

    // 微信登陆
    public function getLogin(Request $req,User $user){
        $credentials = $req->only('username','password');
        // var_dump($credentials);
        if (! $token = JWTAuth::attempt($credentials)) {
            return ['code'=>500,'message'=>'登陆失败！'];
        }

        $user_wechat = new UserWechat;
        $wechatInfo = $user_wechat->where('openid',$credentials['password'])->first();
        $rs = $user->where(['id'=>$wechatInfo['user_id']])->update(['token'=>$token]); // 登陆成功
        return response()->json([
            'token' => $token,
            'code' => 200,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }


    
}
