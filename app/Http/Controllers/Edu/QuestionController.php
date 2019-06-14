<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\TeacherExtend;
use App\Model\TeacherQuestion;
use App\Model\TeacherGrade;
use App\Model\TeacherSubject;
use App\Model\TeacherSignLog;
use App\Model\TeacherStudentStage;
use Tymon\JWTAuth\Facades\JWTAuth;

class QuestionController extends BaseController
{
    // 获取正常题目
    public function getQuestion(Request $req,TeacherExtend $teacher_extend,TeacherQuestion $teacher_question){
    	$sort_now = $req->sort_now;
    	$error_num = $req->error_num;
    	$userInfo = $userInfo = JWTAuth::parseToken()->touser();
    	$extend = $teacher_extend->where('user_id',$userInfo['id'])->first();

    	$where = [
    		'grade_id'		=>	$extend['grade_id'],
    		'subject_id'	=>	$extend['subject_id'],
    		'is_public'		=>	1
    	];

    	$count = $teacher_question->where($where)->count(); // 这个类别下的所有题目

    	// 如果已经做完了
    	if($extend['question_num'] <= $sort_now){
    		$this->addSignLog($extend,$error_num);
    		return $this->autoMsg('202','每日首练完成！');
    	}

    	// 如果设置的数量大于 类别数量
    	if($count<$extend['question_num']){
    		var_dump($where,$count,$extend['question_num']);
    		return $this->errorMsg('该类目下的题目不够，请设置学习范围！');
    	}

    	// 如果这个人已经把该类目的题目全部做完,则返回给他信息让他初始化 并生成一阶段的日志
    	if($count<=$extend['all_make_num']){
    		$this->addLog($extend); // 加入阶段日志
    		return $this->autoMsg('201','恭喜您，刷完所有题目，获得新的成就！');
    	}

    	// 如果取题目已经开始不够了 少的题目再随机从题库取
    	if(($count-$extend['all_make_num']) < $extend['question_num']){
    		// 如果开始超出就开始随机取
    		if(($count-$extend['all_make_num']+sort_now) > $extend['question_num']){
    			$questionData = $teacher_question->where($where)->with('get_answer')->inRandomOrder()->first(); // 随机取
    		}else{
    			$questionData = $teacher_question->where($where)->with(['get_answer'])->skip($sort_now+$extend['all_make_num'])->take(1)->first(); // 正常取 
    		}
    	}else{
    		$questionData = $teacher_question->where($where)->with(['get_answer'])->skip($sort_now+$extend['all_make_num'])->take(1)->first(); // 正常取
    	}

    	// 插入设置范围数量
    	$questionData['question_num'] = $extend['question_num'];

    	return $this->successMsg('ok',$questionData);

    }

    // 加入错题本
    public function add_error_question(Request $req){
        $teacher_extend = new TeacherExtend;
        $question_id = $req->question_id;
        $userInfo = $userInfo = JWTAuth::parseToken()->touser();
        $extend = $teacher_extend->where('user_id',$userInfo['id'])->first();
        if(empty($extend['error_question'])){
            $error_question_arr = [];
        }else{
            $error_question_arr = explode(',',$extend['error_question']);
        }

        if(!in_array($question_id,$error_question_arr)){
            $error_question_arr[] = $question_id;
            $error_question_str = implode(',',$error_question_arr);
            $teacher_extend->where('user_id',$userInfo['id'])->update(['error_question'=>$error_question_str]);
        }

        return $this->successMsg();
    }

    // 添加一条成就日志然后清空所有extend内的总数据
    public function addLog($extend){
    	$teacher_extend = new TeacherExtend;
    	$teacher_student_stage = new TeacherStudentStage;
    	$data['user_id'] = $extend['user_id'];
    	$data['grade_id'] = $extend['grade_id'];
    	$data['subject_id'] = $extend['subject_id'];
    	$data['all_make_num'] = $extend['all_make_num'];
    	$data['all_make_error_num'] = $extend['all_make_error_num'];
    	$data['add_time'] = time();
    	$teacher_student_stage->insert($data);
    	$teacher_extend->where('user_id',$extend['user_id'])->update(['all_make_num'=>0,'all_make_error_num'=>0,'money'=>$extend['money']+0.02]);
    }

    // 增加每日做题日志
    public function addSignLog($extend,$error_num){
        $teacher_extend = new TeacherExtend;

        $teacher_extend->where('user_id',$extend['user_id'])->update(['all_make_num'=>($extend['all_make_num']+$extend['question_num']),'all_make_error_num'=>($extend['all_make_error_num']+$error_num),'money'=>$extend['money']+0.01]);

    	$teacher_sign_log = new TeacherSignLog;
    	$data['user_id'] = $extend['user_id'];
    	$data['grade_id'] = $extend['grade_id'];
    	$data['subject_id'] = $extend['subject_id'];
    	$data['make_num'] = $extend['question_num'];
    	$data['error_num'] = $error_num;
    	$data['format_time'] = date('Y-m-d');
    	$data['add_time'] = time();
    	return $teacher_sign_log->insert($data);
    }

    
}
