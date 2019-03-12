<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
	public $limit = 30;
	public $page = 1;
	public $where = [];
	public $order = ['id','desc'];
	public $select = [];
	public $join = '';
	public $with = [];
	private $modelSpace = 'App\Model\\'; 

    // 获取数据
    public function getData($tableObj){
    	$this->limit = Input::get('limit')??$this->limit;
        $this->page = Input::get('page')??$this->page;

    	// 条件查询
    	if(!empty($this->where)){
    		foreach($this->where as $v){
    			if(count($v)>2){
    				$tableObj = $tableObj->where($v[0],$v[1],$v[2]);
    			}else{
    				$tableObj = $tableObj->where($v[0],$v[1]);
    			}
    		}
    	}

    	// 字段筛选
    	if(!empty($this->select)){
    		$tableObj = $tableObj->select('id');
    		foreach($this->select as $v){
    			$tableObj = $tableObj->addSelect($v);
    		}
    	}

    	$skip = ($this->page-1)*$this->limit;
    	$tableObj = $tableObj->offset($skip)->limit($this->limit);

    	// 排序
    	$tableObj = $tableObj->orderBy($this->order[0],$this->order[1]);

    	$data = $tableObj->get();

    	return $data;
    }


    // 获取分页数据
    public function getPage($table){
    	$modelPath = $this->modelSpace.$table;
    	$tableObj = new $modelPath();

    	// 条件查询
    	if(!empty($this->where)){
    		foreach($this->where as $v){
    			if(count($v)>2){
    				$tableObj = $tableObj->where($v[0],$v[1],$v[2]);
    			}else{
    				$tableObj = $tableObj->where($v[0],$v[1]);
    			}
    		}
    	}

    	file_put_contents(getcwd().'/huanggao.txt', $tableObj);
    	$data['count'] = $tableObj->count();
    	$data['page'] = (int)$this->page;
    	$data['limit'] = (int)$this->limit;
    	$data['pageCount'] = empty($data['count'])?1:ceil($data['count']/$data['limit']);

    	return $data;
    }

    // 公用状态码返回
    public function returnData($rs,$code=401,$msg=''){
    	if($rs){
    		return response('success',200);
    	}else{
    		return response($msg.' fail',$code);
    	}
    }

    
}
