<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
	 * @abstract 注册
	 * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/register
	 */

	// function register(){
	// 	if (isset($_POST['username'])) {
	// 		# 获取注册数据
	// 		$post = $this->input->post(NULL,TRUE);
	// 		//var_dump($post);
	// 		$res = $this->login->register($post);
	// 		if ($res) {
	// 			 //返回注册成功页面
	// 		}
	// 	}else{
	// 		//加载注册页面
	// 	}
	// }
     
	/**
	 * @abstract 教师/学生端登陆(PC)
	 * @link http://www.flappyant.com/sybwj/admin/welcome/boss_login
	 */
	function boss_login(){
		//提交表单（post）
		if (isset($_SESSION['user']['user_id'])) {

			if ($_SESSION['user']['state'] == 0) {
			//学生
				         $data = array(
					         	'userinfo'=>$_SESSION['user'],
					         	);

						// 加载首页
				        $this->load->view('pages/indexheader',$data);
						$this->load->view('pages/studentmenu');
				        $this->load->view('pages/indexfooter');



			}else{
			//老师

				$this->index();

			}


			# code...
		}else{



	        //获取angularJS中的数据流
			$post = json_decode(file_get_contents('php://input'),true);
			if ($post) {

				$res = $this->login->boss_login($post);
				//若用户名存在
				if ($res == 'ok') {
	                 //返回成功
					$data = array(
						'errorcode' => 0,
						'message'   => 'ok',
						'userinfo'  =>  $_SESSION['user'],
						);
					echo json_encode($data);

				}elseif ($res == 'state_error') {
					# code...
					$data = array(
						'errorcode' => 1,
						'message'   => 'state_error',
						// 'userinfo'  =>  $_SESSION['user'],
						);
					echo json_encode($data);
				}elseif ($res == 'unexists'){
	                //重新输入密码
	                $data = array(
						'errorcode' => 2,
						'message'   => 'user unexists',
						// 'userinfo'  =>  $_SESSION['user'],
						);
					echo json_encode($data);


				}
			}else{//登陆页面（get）




	                $this->load->view('pages/indexheader');
	                $this->load->view('pages/login');
	                $this->load->view('pages/indexfooter');
			}
	    }

	}

	/**
	 * @abstract 学生端登陆（移动端）
	 * @link http://www.flappyant.com/sybwj/admin/welcome/stu_login_mobile
	 */
	function stu_login_mobile(){
        //提交表单（post）
        $post = $this->input->post(NULL,TRUE);
		if ($post) {
			

			$res = $this->login->stu_login($post);
			//若用户名存在
			if ($res) {
                 //返回成功（json格式）
				$data = array(
					'errorcode' => 0,
					'message'   => 'ok',
					'userinfo'  =>  $res,
					);
				echo json_encode($data);
			}else{
                //返回失败（json格式）
                $data = array(
					'errorcode' => 2,
					'message'   => 'user unexists',
					// 'userinfo
					);
                echo json_encode($data);
			}
		}

	}



	/**
	 * @abstract 学生/教师修改密码（PC）
	 * @link http://www.flappyant.com/sybwj/admin/welcome/edit_user
	 */

	function edit_user(){
        
        $post = json_decode(file_get_contents('php://input'),true);

        if ($post) {

        	//更新密码/真实姓名

        	$res = $this->login->edit_user($post);

        	if ($res) {

        		//修改密码和真实姓名成功,返回主页
        		$data = array(
					'errorcode' => 0,
					'message'   => 'ok',
					);
				echo json_encode($data);


        	}else{
        		        		
        		//返回操作失败页面
        		$data = array(
					'errorcode' => 1,
					'message'   => 'fail',
					);
				echo json_encode($data);


        	}

        }else{

        //加载修改密码界面


        }

	}

	/**
	 * @abstract 学生修改密码（安卓端）【post】
	 * @link http://www.flappyant.com/sybwj/admin/welcome/edit_user_mobile
	 */

	function edit_user_mobile(){




		  $post = $this->input->post(NULL,TRUE);
        
        if ($post) {


        	//更新密码/真实姓名


        	$res = $this->login->edit_user($post);

        	if ($res) {

        		//返回成功（json格式）
				$data = array(
					'errorcode' => '0',
					'message'   => 'ok',
					);
				echo json_encode($data);

        	}else{
        		
        		//返回失败（json格式）
                $data = array(
					'errorcode' => '1',
					'message'   => 'failure',
					// 'userinfo
					);
                echo json_encode($data);
        	}

        }else{
        	 $data = array(
					'errorcode' => '1',
					'message'   => 'failure',
					// 'userinfo
					);
                echo json_encode($data);
        	// echo "安卓端";
        }

	}



   /**
	 * @abstract 学生端登陆（网页端）
	 * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/stu_login
	 */
	// function stu_login(){
 //        //提交表单（post）
	// 	if (isset($_POST['username'])) {
	// 		# code...
	// 		$_post  = $this->input->post(NULL,TRUE);
	// 		//判断state = 0;
	// 		$res = $this->login->stu_login($_post);
	// 		//若用户名存在
	// 		if ($res) {//进入主界面
                 
	// 		}else{//返回失败

	// 		}
	// 	}else{//学生端登陆界面

	// 	}

	// }


	 /**
     * @abstract 用户名名监测
     * @param $username
     * @link http://www.flappyant.com/sybwj/index.php/admin/welcome/check_user_name
     * 例如  http://ijiayuan.com.cn/dashboard/hl_panel_users/check_shop_name/Debug%E6%95%99%E5%AD%A6%E8%A7%86%E9%A2%91
     */
    // public function check_user_name($username){
    //     $username = urldecode($username);

    //     $return = array(
    //         'errorCode' => 0,
    //         'isExists' => $this->login->check_user_name($username)?TRUE:FALSE,
    //     );

    //     echo json_encode($return);
    // }

     /**
      * @abstract 教师端首页（PC）
      * @link http://www.flappyant.com/sybwj/admin/welcome/index
      */
	public function index()
	{

         $data = array(
         	'userinfo'=>$_SESSION['user'],
         	);

         // echo json_encode($data);

		// 加载首页
		$this->load->view('pages/indexheader',$data);
		$this->load->view('pages/teachermenu');
        $this->load->view('pages/indexfooter');
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */