<?php
    class MY_Controller extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->helper('url');
            /*开启Session*/
            @session_start();
            // 图片基础参数设置
            define('DIR_ASSETS',site_url().'assets/');
            define('DIR_IMG', site_url().'assets/img/');
            define('DIR_FONTS', site_url().'assets/fonts/');
            define('DIR_CSS', site_url().'assets/css/');
            define('DIR_JS', site_url().'assets/js/');
            define('DIR_AdminLTE', site_url().'assets/AdminLTE/');

            //控制层路由参数定义
            define('DIR_ADMIN',site_url().'admin/');
            define('DIR_USER',site_url().'user/');
            // define('DIR_PANEL_FORM',site_url().'admin/pannel_form');
            // define('DIR_WELCOME',site_url().'admin/welcome');
            // define('DIR_ANSWER',site_url().'user/answer');
            // define('DIR_USER',site_url().'user/');

            // 字符编码
            header ( 'Content-Type: text/html; charset=UTF-8' );
            header ('Access-Control-Allow-Origin:*');



        }



        /**
         * @return boolean
         * @abstract 教师端权限验证/控制
         */
        function is_auth_teacher(){

            //如果用户登陆过且是教师身份，返回true
            if (isset($_SSESSION['user'])) {
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
            if (isset($_SSESSION['user'])) {
                # code...
                return true;
            }else{
                return false;
            }

        }







}
