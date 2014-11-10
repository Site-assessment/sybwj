<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model','login');
	}

	/**
	 * @abstract 教师端后台登陆
	 * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/boss_login
	 */
	function boss_login(){
		//提交表单（post）
		if (isset($_POST['username'])) {
			# code...
			$_post  = $this->input->post(NULL,TRUE);
			//判断state = 1
			$res = $this->login->boss_login($_post);
			//若用户名存在
			if ($res) {
                 //跳转到后台首页
			}else{
                //重新输入密码
			}
		}else{//登陆页面（get）


		}

	}

	/**
	 * @abstract 学生端登陆（移动端）
	 * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/stu_login
	 */
	function stu_login(){
        //提交表单（post）
		if (isset($_POST['username'])) {
			# code...
			$_post  = $this->input->post(NULL,TRUE);
			//判断state = 0;
			$res = $this->login->stu_login($_post);
			//若用户名存在
			if ($res) {
                 //返回成功（json格式）
			}else{
                //返回失败（json格式）
			}
		}

	}

     /**
      * @abstract 教师端后台PC
      */
	public function index()
	{

         // $data = array(
         // 	'userinfo'=>$_SESSION['user'],
         // 	);

		// 加载首页
		 $this->load->view('admin/header');
		 $this->load->view('admin/index');
		 $this->load->view('admin/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */