<?php

class answer_model extends CI_Model{


     
	function __construct(){
		parent::__construct();
		$this->load->database();
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




	}

	/**
	 * @abstract 获取学生已答过测试列表
	 */
	function get_answered_list($user_id){

	}


    /**
	 * @abstract 获取学生已答过测试详情
	 */
	function get_answered_info($form_id,$user_id){
		
	}





}











