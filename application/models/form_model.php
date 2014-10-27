<?php

class form_model extends CI_Model{


     
	function __construct(){
		parent::__construct()；
		$this->load->database();
	} 

    /**
	 *  @return arrays()
	 *  @abstract 保存问卷表单处理方法
	 */
    
	function save_form($data){
       $data_form = array(
           'name' => $data['name'],
           'user_id'=> $data['user_id'],
           'state'=>$data['state'],

       	);
       //保存问卷，得到form_id
       foreach ($data['ques'] as $ques_data) {
       	# code...
       	$data_ques = array();
       	//保存问题，得到ques_id
       	  foreach ($ques_data['opt'] as $opt_data) {
       	  	# code...
       	  	 $data_opt = array();
       	  }
       }

	}

    /**
	 *  @return boolean
	 *  @abstract 更新问卷表单处理方法
	 */
	function update_form($form_id,$data){


         //删除原有表单，保存更新的表单
	}


    /**
	 *  @return array()
	 *  @abstract 获取问卷表单处理方法
	 */
	function get_form($form_id){

	}


    /**
	 *  @return boolean
	 *  @abstract 删除问卷表单处理方法
	 */
	function delete_form($form_id){
		
	}





}