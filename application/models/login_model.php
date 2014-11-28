<?php

class login_model extends CI_Model{


     
	function __construct(){
		parent::__construct();
		$this->load->database();
	} 




	/**
	 * @abstract 注册
	 * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/register
	 */

    // function register($post){

    //      $res = $this->db->insert('user',$post);

    //      return true;

    // }


   /**
	 * @abstract 用户名监测是否重用
	 */

   // function check_user_name($username){
       
   //      $res = $this->db->get_where('user',array('username'=>$username))->row_array();

   //      if ($res) {
   //      	# code...
   //      	return true;
   //      }else{
   //      	return false;
   //      }

   // }


   /**
	 * @abstract 学生修改密码
	 *
	 */

	function edit_user($post){
        //取出user_id
		$user_id = $post['user_id'];
		unset($post['user_id']);

		if ($user_id) {
			# code...
			$where = array(
			'user_id'=>$user_id,
			);
			$this->db->where($where)->update('user',$post);
			return true;
		}else{
			return false;
		}

		
	}





	/**
	 * @abstract 教师/学生登陆
	 */

	function boss_login($post){

         $state = $post['state'];
         unset($post['state']);
         if ($state) {
         	# code...
	         $res  = $this->db->get_where('user',$post)->row_array();

			 if ($res) {

			 	 if ( $res['state'] == $state) {
			 	 	# code...
			 	 	# 注册用户信息
			 	    $_SESSION['user'] = $res;
			 	    return "ok";
			 	 }else{
			 	 	//用户存在，但是身份选择错误
			 	    // unset($_SESSION['user']);
			 	    return "state_error";
			     }

			 }else{

				 	//不存在该用户
			 	    // unset($_SESSION['user']);
				 	return "unexists";

			 }
         }
		 // $post = array_merge($post,array('state'=>1));
		 
	     
	}



	/**
	 * @abstract 学生登陆(移动端)
	 */

	function stu_login($post){
		//控制学生登录
		// $post = array_merge($post,array('state'=>0));
		$res  = $this->db->get_where('user',$post)->row_array();

		 if ($res) {
		 	# 注册用户信息
		 	$_SESSION['user'] = $res;
		 	return $res;
		 }else{
		 	return false;
		 }
		
	}


}
