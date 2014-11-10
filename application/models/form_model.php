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
    
	function insert($post){
		//构造表单
       $data_form = array(
           'form_name' => $post['form_name'],
              'user_id'=> $post['user_id'],
                'state'=>$post['state'],
             'username'=>$post['username'],

       	);
       //保存问卷，得到form_id
       $this->db->insert('form',$data_form);
       $form_id = $this->db->insert_id();


       foreach ($post['ques'] as $ques_data) {
       	# 构造问题
       	$data_ques = array(
               'form_id'=>$form_id,
             'ques_name'=>$ques_data['ques_name'],
       		);
       	//保存问题，得到ques_id
        $this->db->insert('ques',$data_ques);
        $ques_id = $this->db->insert_id();

       	  foreach ($ques_data['opt'] as $key=>$opt_data) {
       	  	# 构造选项
       	  	 $data_opt = array(

       	  	 	'ques_id'=>$ques_id,
       	  	 	'content'=>$opt_data['content'],
       	  	 	'is_answer'=>$opt_data['is_answer'],
       	  	 	'location'=>$key,
       	  	 	);
       	  	 //保存选项
       	  	 $this->db->insert('opt',$data_opt);
       	  }
       }


       return true;

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