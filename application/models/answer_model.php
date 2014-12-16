<?php

class answer_model extends CI_Model{


     
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @abstract 获取用户信息
	 */
	function get_userinfo($user_id){

		$userinfo = $this->db->get_where('user',array('user_id'=>$user_id))->row_array();
		return $userinfo;

	}

	/**
	 * @abstract 学生端获取测试列表
	 */
	function get_test_list(){

		$where = array(
			'status'=>1,
			);
        //取出测试列表
		$test_list = $this->db->get_where('form',$where)->result_array();

		return $test_list;

	}

	/**
	 * @abstract 学生端获取测试内容  todo:在form_model中有一样的处理方法
	 */
	function get_test_content($form_id){

		$where = array(
			'form_id'=>$form_id,
			);
         //获取测试对象
		 $form_ob = $this->db->get_where('form',$where)->row_array();

		 //获取问题列表
		 $ques_list = $this->db->get_where('ques',$where)->result_array();

		 foreach ($ques_list as $key_ques => $value_ques) {
		 	    
		 	//获取ques_id
		 	$ques_id = $value_ques['ques_id'];

		 	$opt_list = $this->db->get_where('opt',array('ques_id'=>$ques_id))->result_array();

            //重构问题,加入选项
		 	$ques_list[$key_ques]['opt'] = $opt_list; 

		 }

		 //重构测试对象，加入问题
		 $form_ob['form']['form_name'] = $form_ob['form_name'];
		 $form_ob['form']['ques']      = $ques_list;

   
         //返回测试内容
		 return $form_ob;


	}

	/**
	 * @abstract 保存回答内容; todo：写好API接口
	 */
	function answer_in($post){

		$answer_data = array(
			'user_id' =>$post['user_id'],
		   'username' =>$post['username'],
			'form_id' =>$post['form_id'],
			  'grade' =>$post['grade'],
			);
		//插入回答测试的成绩及答题人信息
		$this->db->insert('answer',$answer_data);
		$answer_group_id = $this->db->insert_id();

		//插入回答内容
		foreach ($post['answer'] as $key => $value) {

			$answer_detail_data = array(
			   'group_id'=>$answer_group_id,
				'ques_id'=>$value['ques_id'],
				'opt_id' =>$value['opt_id'],
			'opt_content'=>$value['opt_content'],
				);
			//插入数据
			$this->db->insert('answer_detail',$answer_detail_data);
		}

		return true;

	}

	/**
	 * @abstract 获取学生已答过测试列表
	 */
	function get_answered_list($user_id){

        $where = array('user_id'=>$user_id);
        //获取答过测试列表
		$answered_list = $this->db->order_by('cTime','desc')->get_where('answer',$where)->result_array();

		foreach ($answered_list as $key => $value) {

			$where =array('form_id'=>$value['form_id']);
			$form_ob = $this->db->get_where('form',$where)->row_array();
			if($form_ob){
				$answered_list[$key]['form_name'] = $form_ob['form_name'];
				$answered_list[$key]['form_realname'] = $form_ob['username'];
			
			}else{
				$answered_list[$key]['form_name'] ='该测试已删除!';
				$answered_list[$key]['form_realname'] ='';


			}
		}

		return $answered_list;

	}
	/**
	 * @abstract 获取学生已答过测试列表
	 */
	function get_answered_list_all(){

        //获取答过测试列表
		$answered_list = $this->db->get('answer')->result_array();

		foreach ($answered_list as $key => $value) {

			$where =array('form_id'=>$value['form_id']);
			// $where_user = array('user_id'=>$value['user_id']);

			$form_ob = $this->db->get_where('form',$where)->row_array();
			$userinfo = $this->get_userinfo($value['user_id']);
			if($form_ob){
				$answered_list[$key]['form_name'] = $form_ob['form_name'];
				$answered_list[$key]['realname'] = $userinfo['realname'];
			
			}else{
				$answered_list[$key]['form_name'] ='该测试已删除!';
				$answered_list[$key]['realname'] = $userinfo['realname'];

			}
		}

		return $answered_list;

	}


    /**
	 * @abstract 获取学生已答过测试详情
	 */
	function get_answered_info($answer_group_id,$user_id){


		//获取所做的答案
		$where = array(

			'user_id'=>$user_id,
			'answer_group_id'=>$answer_group_id,

			);

		$answer_ob = $this->db->get_where('answer',$where)->row_array();
		//获取group_id
		$group_id = $answer_ob['answer_group_id'];
		//获取所做的选择列表
		$answer = $this->db->get_where('answer_detail',array('group_id'=>$group_id))->result_array();

		//重构选择列表
		$answer_list = array();
		foreach ($answer as $key => $value) {

              $answer_list[$value['ques_id']]['opt_id'] = $value['opt_id'];
              $answer_list[$value['ques_id']]['opt_content'] = $value['opt_content'];

		}

		//封装数组
		$answer_ob['answer'] = $answer_list;

		return $answer_ob;

		
	}





}











