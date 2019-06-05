<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderGoods;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends BaseController
{
    public function index(Request $req,Order $order,OrderGoods $order_goods){
    	$userInfo = JWTAuth::parseToken()->touser();
    	array_push($this->where,['order_no','like',"%".$req->order_no."%"]);
    	array_push($this->where,['dealer_id',$userInfo['id']]);
        $data['order_list'] = $this->getData($order);
        $data['page'] = $this->getPage('Order');
        return $data;
    }


    public function getOrderInfo(Request $req,Order $order){
    	$orderId = $req->id;
    	$data['data'] = $order->with('get_order_goods')->where('id',$orderId)->first();
    	return $data;
    }
}
