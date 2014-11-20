<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @abstract 学生端答题处理类  
 */
class answer extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');

	}
}
