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

    function register($post){

         $res = $this->db->insert('user',$post);

         return true;

    }


   /**
	 * @abstract 用户名监测是否重用
	 */

   function check_user_name($username){
       
        $res = $this->db->get_where('user',array('username'=>$username))->row_array();

        if ($res) {
        	# code...
        	return true;
        }else{
        	return false;
        }

   }




	/**
	 * @abstract 教师登陆
	 */

	function boss_login($post){

         $state = $post['state'];
         unset($post['state']);
		 // $post = array_merge($post,array('state'=>1));
		 $res  = $this->db->get_where('user',$post)->row_array();

		 if ($res) {

		 	 if ( $res['state'] == $state) {
		 	 	# code...
		 	 	# 注册用户信息
		 	    $_SESSION['user'] = $res;
		 	    return true;
		 	 }else{
		 	 	//用户存在，但是身份选择错误
		 	    return "state_error";
		     }

		 }else{

			 	//不存在该用户
			 	return "unexists";

		 }
	     
	}



	/**
	 * @abstract 学生登陆
	 */

	function stu_login($post){
		//控制学生登录
		// $post = array_merge($post,array('state'=>0));
		$res  = $this->db->get_where('user',$post)->row_array();

		 if ($res) {
		 	# 注册用户信息
		 	$_SESSION['user'] = $res;
		 	return true;
		 }else{
		 	return false;
		 }
		
	}


}
