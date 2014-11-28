<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @todo 已经重写控制器，is_auth_teacher()权限验证
 */
class pannel_form extends MY_Controller {


    

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//加载表单处理类
		$this->load->model('form_model','form');


	}

	/**
	 * Index Page for this controller.
	 *  @abstract 后台初始化页面
	 */
	// public function index()
	// {
		
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/info');
	// 	// $this->load->view('admin/footer');
	// 	// $this->load->view('welcome_message');
	// }

	/**
	 * @abstract 新建表单页面   操作--提交表单数据
	 * @link http://www.flappyant.com/sybwj/admin/pannel_form/form_add
	 */
	public function form_add(){

        $_post = $this->input->post(NULL,TRUE);
		if ($_post) {//(js)
			# 插入表单数据，json数据格式


			//todo  model
			$res = $this->form->insert($_post);

			if ($res) {
				# code...
				    //操作成功返回成功
					$data = array(

						'errorcode' => 0,
						'message'   => 'ok',

							);
			}else{
				    //若操作失败，则返回失败
					$data = array(

						'errorcode' => 1,
						'message'   => 'error',

							);
			}

            //返回结果（前端JS）
			echo json_encode($data);

		}
		// else{


  //           //get请求，加载新增测试页面
		// 	$data = array(
		// 		'userinfo'=>$_SESSION['user'],
		// 		  'title' => '新建测试',
		// 		);
		// 	//加载新建测试页面
		// 	$this->load->view('admin/header',$data);
		// 	$this->load->view('admin/form_add');
		//     // $this->load->view('admin/footer');
			

		// }


	}

    /**
     *@abstract 表单列表页面
     *@link http://www.flappyant.com/sybwj/admin/pannel_form/form_list
     */

	public function form_list($status = ''){
        
        //获取测试列表,status = 0 未启用， 1 启用 ，‘’ 全部;
        $formlist = $this->form->get_form_list($status,$_SESSION['user_id']);

        $data = array(
        	'title'=>'测试列表',
         'formlist'=>$formlist,
        	);

        // echo "form list!";
        //加载测试列表页面
        $this->load->view('admin/header',$data);
        $this->load->view('admin/form_list');
		// $this->load->view('admin/footer');
	}


    /**
     *@abstract 表单详情页面  
     *@link http://www.flappyant.com/sybwj/admin/pannel_form/form_info/(form_id)
     */

    public function form_info($form_id){

        //获取该测试表单信息,
    	$form_info = $this->form->get_form_info($form_id);

    	if ($form_info) {
    		# code...
    		$data = array(
    			'title'=>'测试详情',
    	   '$form_info'=>$form_info,
    			);

    		$this->load->view('admin/header',$data);
			$this->load->view('admin/form_info');
    	}
  


    } 

    /**
     *@abstract 编辑表单页面  操作--更新表单(先插入，成功后，再删除)
     *@link http://www.flappyant.com/sybwj/admin/pannel_form/form_edit
     */
	public function form_edit($form_id){

		$_post = $this->input->post(NULL,TRUE);

		if ($_post) {//(js)

			//插入编辑过的表单,unset form_id;
			$res = $this->form->insert($_post);
			if ($res) {
				# 删除原表单
				$this->form_delete($form_id);
				//操作成功，返回成功，跳转到测试列表（js跳转）
					$data = array(

						'errorcode' => 0,
						'message'   => 'ok',

							);				

		        }else{
				    //操作失败
					$data = array(

						'errorcode' => 0,
						'message'   => 'ok',

							);
			    }


		        echo json_encode($data);
			




		}
		// else{//get，加载编辑页面

  //           //获取要编辑的测试内容;todo model(返回array（）格式forminfo)
  //           $form_info =  $this->form->get_form_info($form_id);
  //           //forminfo 转换成json格式
  //           $data = array(
  //           	'title'=>'编辑测试',
  //            'form_info'=>json_encode($form_info),
  //           	);
		// 	$this->load->view('admin/header',$data);
		// 	$this->load->view('admin/edit');
		//     // $this->load->view('admin/footer');

		// }

	}

    /**
     * @link http://www.flappyant.com/sybwj/admin/pannel_form/form_delete
     * @abstract 操作 --删除表单(js)
     */
	public function form_delete($form_id){
        //删除测试问卷  todo model
		$res = $this->form->form_delete($form_id);

		if ($res) {
			# 操作成功
			$data = array(
					'errorcode' => 0,
					'message'   => 'ok',
					// 'userinfo'  =>  $_SESSION['user'],
					);
				
		}else{

				$data = array(
					'errorcode' => 1,
					'message'   => 'error',
					// 'userinfo'  =>  $_SESSION['user'],
					);

		}

        //返回结果（json）
		echo json_encode($data);

	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */