<?php

class form_model extends CI_Model{


     
	function __construct(){
		parent::__construct();
		$this->load->database();
	} 

    /**
	 *  @return boolean()
	 *  @abstract 保存问卷表单处理方法
	 */
    
	function insert($post){

        // $post = json_decode($post);
		//构造表单,todo   每层做操作验证是否成功
        if (isset($post['user_id']) && isset($post['username']) && isset($post['form']['form_name'])) {

        
            if (isset($post['form_id'])) {
              # code...
              unset($post['form_id']);
            }
            $form_name =  $post['form']['form_name'];
            $user_id = $post['user_id'];
            $username = $post['username'];

            $data_form = array(
               'form_name'  => $form_name,
                  'user_id' => $user_id,
                    //'type' => $post['type'],
                 'username' => $username,

           	);

           //保存问卷，得到form_id
           $this->db->insert('form',$data_form);
           $form_id = $this->db->insert_id();

           if ($form_id) {
                 # code...
                foreach ($post['form']['ques'] as $ques_data) {
                # 构造问题
                    $data_ques = array(
                           'form_id'=>$form_id,
                         'ques_name'=>$ques_data['ques_name'],
                      );
                    //保存问题，得到ques_id
                    $this->db->insert('ques',$data_ques);
                    $ques_id = $this->db->insert_id();

                        if ($ques_id) {
                            # code...
                                foreach ($ques_data['opt'] as $key=>$opt_data) {
                                # 构造选项
                                 $data_opt = array(

                                  'ques_id'  =>$ques_id,
                                  'content'  =>$opt_data['content'],
                                  'is_answer'=>$opt_data['is_answer'],
                                  'location' =>$key,
                                  );

                                 //保存选项
                                 $this->db->insert('opt',$data_opt);
                              }
                              
                        }


                   }

                return $form_id;

                   
           }else{
                return false;
           }

      }else{
        return false;
      }




       


       
  }

 //    /**
	//  *  @return boolean
	//  *  @abstract 更新问卷表单处理方法
	//  */
	// function update_form($form_id,$data){


 //         //删除原有表单，保存更新的表单
	// }


    /**
	 *  @return array();
	 *  @abstract 获取测试表单详情处理方法  todo:封装数据
	 */
	function get_form_info($form_id){
        
        //获取测试表单,构造前端所需数据格式
        $form_ob = $this->db->get_where('form',array('form_id'=>$form_id))->row_array();
       
        
        //获取该测试所有问题
        $ques_list = $this->db->get_where('ques',array('form_id'=>$form_id))->result_array();

        //构造问题数据
        foreach ($ques_list as $key => $ques_ob) {
            # code...
            $ques_id = $ques_ob['ques_id'];
            //获取该问题的所有选项
            $opt_list = $this->db->get_where('opt',array('ques_id'=>$ques_id))->result_array();
            
            //构造选项数据
            $ques_list[$key]['opt'] = $opt_list;
        }

        //构造测试表单数据,完整的数据
        $form_ob['form']['form_name'] = $form_ob['form_name'];
        $form_ob['form']['ques']      = $ques_list;


        //返回测试表单详情
        return $form_ob;






	}


    /**
	 *  @return array();
	 *  @abstract 获取问卷表单列表处理方法
	 */
    function get_form_list($status,$user_id){

        //封装条件
        $where = array(
            'user_id'=>$user_id,
            'status !='=>3,
            );
        if ($status != '') {
            
            $where['status'] = $status;
        }

        //查询测试列表
        $form_list = $this->db->get_where('form',$where)->result_array();
        //返回结果
        return $form_list;


    	
    }

    /**
	 *  @return boolean
	 *  @abstract 删除问卷表单处理方法 
	 */
	function delete_form($form_id){

       $where = array('form_id'=>$form_id);
       $data = array('status'=>3);

       $this->db->where($where)->update('form',$data);
		
        //删除form表
        // $this->db->delete('form',array('form_id'=>$form_id));
        
        // //取出该form表的所有问题
        // $ques_list = $this->db->get_where('ques',array('form_id'=>$form_id))->result_array();

        // //删除opt表
        // foreach ($ques_list as $key => $ques_ob) {
        //     # code...

        //     $ques_id = $ques_ob['ques_id'];
        //     //删除这个问题的所有选项内容
        //     $this->db->delete('opt',array('ques_id'=>$ques_id));
              

        // }

        // //删除ques表
        //  $this->db->delete('ques',array('form_id'=>$form_id));


         return true;



	}

    /**
     *  @return boolean
     *  @abstract 改变问卷表单状态处理方法 
     */
    function form_display($form_id,$display){

        $where = array('form_id'=>$form_id);
        $form_ob = $this->db->get_where('form',$where)->row_array();

        $status = 0;

        if ($display == 'start') {
            # code...
            $status = 1;
        }elseif($display == 'stop'){
            $status = 0;
        }

        //更新测试启用状态
        $this->db->where($where)->update('form',array('status'=>$status));

        return true;

    }




}
