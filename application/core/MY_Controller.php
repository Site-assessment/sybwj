<?php
    class MY_Controller extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->helper('url');
            /*开启Session*/
            @session_start();
            // 图片基础参数设置
            // define('DIR_STATIC',base_url().'static/');
            // define('DIR_IMG', base_url().'static/image/');
            // define('DIR_IMGHL', base_url().'static/imagehl/');
            // define('DIR_BT', base_url().'static/bootstrap/');
            // define('DIR_AdminLTE', base_url().'static/AdminLTE/');
            // define('DIR_VALID', base_url().'static/validator-0.7.3/');
            // define('DIR_PLUGIN', base_url().'static/plugins/');
            // define('DIR_CSS', base_url().'static/css/');
            // define('DIR_JS', base_url().'static/js/');

            // 字符编码
            header ( 'Content-Type: text/html; charset=UTF-8' );


        }



        /**
         * @return boolean
         * @abstract 教师端权限验证/控制
         */
        function is_auth_teacher(){

            //如果用户登陆过且是教师身份，返回true
            if (isset($_SSESSION['user']) && $_SSESSION['user']['state'] == 1) {
                # code...
                return true;
            }else{
                return false;
            }


        }


        /**
         * @return boolean
         * @abstract 学生端权限验证/控制
         */
        function is_auth_student(){

            //如果用户登陆过且是学生身份，返回true
            if (isset($_SSESSION['user']) && $_SSESSION['user']['state'] == 0) {
                # code...
                return true;
            }else{
                return false;
            }

        }







}
