<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @abstract 学生端答题处理类 ;移动端访问接口是必须带的参数（user_id）
 *  
 */
class answer extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('answer_model','answer');
		$this->load->model('form_model','form');


	}

    /**
     * @abstract 学生端首页(PC)
     * @link http://www.flappyant.com/sybwj/user/answer/index
     */
	function index(){

         $data = array(
         	'userinfo'=>json_encode($_SESSION['user']),
         	);

         // echo json_encode($data);

		// 加载首页
		 $this->load->view('admin/header',$data);
		 $this->load->view('user/index');
		 $this->load->view('admin/footer');


	}

    /**
     * @abstract 老师启用的测试列表(PC)
     * @link http://www.flappyant.com/sybwj/user/answer/test_list
     */
	function test_list(){
         //获取测试列表,列表显示字段：测试名，出题人，出题时间。隐藏字段：form_id
         $test_list = $this->answer->get_test_list();

         $data = array(

         	// 'title'     => '测试列表',
         	'test_list' => json_encode($test_list),

         	);

         //加载页面
         // echo json_encode($data);



	}


    /**
     * @abstract 老师启用的测试列表(mobile)--移动端接口
     * @link http://www.flappyant.com/sybwj/user/answer/test_list_mobile/(?user_id)[GET]
     */
	function test_list_mobile($user_id = 0){
         //获取测试列表,列表显示字段：测试名，出题人，出题时间。隐藏字段：form_id
         $test_list = $this->answer->get_test_list();

         $data = array(
            'errorcode' => 0,
            'message'   => 'ok',
            'count'     => count($test_list),
          	// 'title'     => '测试列表',
         	'test_list' => $test_list,

         	);

         //返回移动端json数据
         echo json_encode($data);




	}


	/**
	 * @abstract 答题页面/保存答案(PC)---API 
	 * @link http://www.flappyant.com/sybwj/user/answer/answer_in/(?form_id[GET])
	 */
	function answer_in($form_id = 0){

		$post = json_decode(file_get_contents('php://input','r'));


		if ($post) {

			//保存答案
			$res = $this->answer->answer_in($post);

			if ($res) {

				//返回成功（json）
				$data = array(
                     'errorcode' => 0,
                     'message'   => 'ok',

					);
				echo json_encode($data);

			}else{

				//返回失败(json)
				$data = array(
                     'errorcode' => 1,
                     'message'   => 'failure',
                     
					);
				echo json_encode($data);
			}



		}else{

			//获取测试内容 array()
			$test_content = $this->answer->get_test_content($form_id);
            
			$data = array(
				// 'title'       =>'答题',
				'test_content'=>json_encode($test_content),
				'userinfo'    =>json_encode($_SESSION['user']),
				);

			//加载页面

			// echo json_encode($data);

		}

        

	}



	/**
	 * @abstract 答题页面/保存答案(mobile)--移动端接口--webView显示PC端的页面
	 * @link http://www.flappyant.com/sybwj/user/answer/answer_in_mobile/(?form_id[GET])
	 */
	function answer_in_mobile($form_id = 0){

          $post = $this->input->post(NULL,TRUE);

		if ($post) {

			// $post = $this->input->post(NULL,TRUE);
            //保存答案
			$res = $this->answer->answer_in($post);

			if ($res) {

				//返回成功（json）
				$data = array(
                     'errorcode' => 0,
                     'message'   => 'ok',

					);
				echo json_encode($data);

			}else{

				//返回失败(json)
				$data = array(
                     'errorcode' => 1,
                     'message'   => 'failure',
                     
					);
				echo json_encode($data);
			}
			
		}else{
			//返回测试问卷数据
			$test_content = $this->answer->get_test_content($form_id);

			$data = array(
				'errorcode'    => 0,
	            'message'      => 'ok',

	         	'test_content' => $test_content,
            );
            
            //返回json数据
            echo json_encode($data);
		}

        

	}

	/**
	 * @abstract 已答过测试列表(PC)[显示得分] --API
	 * @link http://www.flappyant.com/sybwj/user/answer/answered_list
	 */
	function answered_list(){

        //获取该学生已答过的列表
		$answered_list = $this->answer->get_answered_list($_SESSION['user']['user_id']);

		$data = array(
			// 'title'        => '已答过',
			'answered_list'=> json_encode($answered_list),
			'userinfo'     => json_encode($_SESSION['user']),
			);

		//加载页面

		// echo json_encode($data);



	}


	/**
	 * @abstract 已答过测试列表(mobile)--移动端接口[显示得分]
	 * @link http://www.flappyant.com/sybwj/user/answer/answered_list_mobile/(?user_id[GET])
	 */
	function answered_list_mobile($user_id = 0){

        //获取该学生已答过的列表
		$answerd_list = $this->answer->get_answered_list($user_id);

		$data = array(
			// 'title'=>'已答过',
			'errorcode'    => 0,
			'message'      => 'ok',
			'count'        => count($answered_list),
			'answered_list'=> $answered_list,
			// 'userinfo'=>$_SESSION['user'],
			);

		//返回数据
		echo json_encode($data);
		
	}


	/**
	 * @abstract 已答过测试详情(PC)[包括显示答案]--API
	 * @link http://www.flappyant.com/sybwj/user/answer/answered_info/(?form_id&&?user_id[GET])
	 */
	function answered_info($answer_group_id = 0,$form_id= 0,$user_id = 0){
        //获取测试内容
		$test_content  = $this->answer->get_test_content($form_id);
		//获取该学生测试所做的内容
		$answered_info = $this->answer->get_answered_info($answer_group_id,$user_id);

		$data = array(
			// 'title'=>'已答过详情',
			'test_content' =>json_encode($test_content),
			'answered_info'=>json_encode($answered_info),
			);

		// echo json_encode($data);

	}


	/**
	 * @abstract 已答过测试详情(mobile)--移动端接口[包括显示答案]--webView显示PC端的页面
	 * @link http://www.flappyant.com/sybwj/user/answer/answered_info_mobile/(?form_id&&?user_id[GET])
	 */
	function answered_info_mobile($form_id = 0,$user_id = 0){

		//获取测试内容
		$test_content  = $this->answer->get_test_content($form_id);
		//获取该学生测试所做的内容
		$answered_info = $this->answer->get_answered_info($form_id,$user_id);

		$data = array(
			// 'title'=>'已答过详情',
			'errorcode'    => 0,
			'message'      => 'ok',
			'test_content' => $test_content,
			'answered_info'=> $answered_info,
			);

		echo json_encode($data);
		
	}














}
