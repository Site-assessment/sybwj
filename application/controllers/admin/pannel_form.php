<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @todo 重写控制器，is_auth()权限验证
 */
class pannel_form extends CI_Controller {


    

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//加载表单处理类
		$this->load->model('form_model','form');


	}

	/**
	 * Index Page for this controller.
	 *  @abstract 欢迎页面
	 */
	public function index()
	{
		
		$this->load->view('admin/header');
		$this->load->view('admin/info');
		// $this->load->view('admin/footer');
		// $this->load->view('welcome_message');
	}

	/**
	 * @abstract 新建表单页面   操作--提交表单数据
	 * @link http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_add
	 */
	public function form_add(){

		if (isset($_POST['user_id'])) {
			# 插入表单数据，json数据格式
			$_post = $this->input->post(NULL,TRUE);
			//todo  model
			$res = $this->form->insert($_post);

			//操作成功跳转页面
			echo "post request";
		}else{

			$data = array(
				'userinfo'=>$_SESSION['user'],
				  'title' => '新建测试',
				);
			//加载新建测试页面
			$this->load->view('admin/header',$data);
			$this->load->view('admin/form_add');
		    // $this->load->view('admin/footer');
			

		}


	}

    /**
     *@abstract 表单列表页面
     *@link http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_list
     */

	public function form_list($state = ''){
        
        //获取测试列表,state = 0 未启用， 1 启用 ，‘’ 全部;todo model
        $formlist = $this->form->get_form_list($state,$_SESSION['user_id']);

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
     *@abstract 编辑表单页面  操作--更新表单(先插入，成功后，再删除)
     *@link http://www.flappyant.com/sybwj/index.php/admin/pannel_form/form_edit
     */
	public function form_edit($form_id){

		if (isset($_POST['user_id'])) {

			$_post = $this->input->post(NULL,TRUE);
			//插入编辑过的表单,unset form_id;
			$res = $this->form->insert($_post);
			if ($res) {
				# 删除原表单
				$this->form_delete($form_id);
				//操作成功，跳转到测试列表

			}




		}else{
            //获取要编辑的测试内容;todo model
            $forminfo =  $this->form->get_form_info($form_id);
            //todo 转换成json格式
            $data = array(
            	'title'=>'编辑测试',
             'forminfo'=>$forminfo,
            	);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/edit');
		    // $this->load->view('admin/footer');

		}

	}

    /**
     *@abstract 操作 --删除表单
     */
	public function form_delete($form_id){
        //删除测试问卷  todo model
		$res = $this->form->form_delete($form_id);

		if ($res) {
			# 操作成功
		}

	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */