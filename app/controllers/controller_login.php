<?php
    class Controller_Login extends Controller{
        function __construct(){
            parent::__construct();
        }

        public function index(){
            $this->view->render('login_view.php');
        }

        public function run(){
            //$this->model->run();
        }
    }