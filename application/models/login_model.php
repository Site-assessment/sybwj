<?php

class login_model extends CI_Model{


     
	function __construct(){
		parent::__construct()；
		$this->load->database();
	} 


/**
 * @abstract 教师登陆
 */

function boss_login($post){
	//控制教师登录
	 $post = array_merge($post,array('state'=>1));
	 $res  = $this->db->get_where('user',$post)->row_array();

	 if ($res) {
	 	# 注册用户信息
	 	$_SESSION['user'] = $res;
	 	return true;
	 }else{
	 	return false;
	 }
     
}



/**
 * @abstract 学生登陆
 */

function stu_login($post){
	//控制学生登录
	$post = array_merge($post,array('state'=>0));
	$res  = $this->db->get_where('user',$post)->row_array();

	 if ($res) {
	 	# 注册用户信息
	 	$_SESSION['user'] = $res;
	 	return true;
	 }else{
	 	return false;
	 }
	
}

