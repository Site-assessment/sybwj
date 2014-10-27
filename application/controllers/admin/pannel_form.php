<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pannel_form extends CI_Controller {




	function __construct(){
		parent::__construct();
		$this->load->helper('url');

	}

	/**
	 * Index Page for this controller.
	 *  @abstract 初始化页面
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
	 */
	public function add(){

		if (isset($_POST['user_id'])) {
			# code...
			echo "post request";
		}else{
			// for ($i=1; $i<1000 ; $i++) { 
			// 	# code...
			// 	echo "get request";
			// }
			// echo "get request";
			$this->load->view('admin/header');
			$this->load->view('admin/form_add');
		    // $this->load->view('admin/footer');
			

		}


	}

    /**
     *@abstract 表单列表页面
     *
     */

	public function form_list(){

        // echo "form list!";
        $this->load->view('admin/header');
        $this->load->view('admin/form_list');
		// $this->load->view('admin/footer');
	}

    /**
     *@abstract 编辑表单页面  操作--更新表单
     */
	public function edit($form_id){

		if (isset($_POST['user_id'])) {
			# code...

		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/edit');
		    // $this->load->view('admin/footer');

		}

	}

    /**
     *@abstract 操作 --删除表单
     */
	public function delete($form_id){

	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */