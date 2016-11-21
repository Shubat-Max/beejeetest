<?php
    class Controller_404 extends Controller{
        public function __construct(){
            parent::__construct();
        }

        public function index(){
            $this->view->render('404_view.php');
        }
    }