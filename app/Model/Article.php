<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article"; //指定表
    protected $primaryKey = "id"; //指定id字段
    public $timestamps = false;

    // 获取父栏目名字
    public function get_parent_name(){
    	return $this->hasOne('App\Model\Columns','id','cid');
    }
}
