<?php
    class Controller_Moderator extends Controller {
        function __construct(){
            parent::__construct();
            if($_SESSION['loggedIn'] == false){
                Session::destroy();
                header("Location: ".URL."/Login");
                exit();
            }
        }

        public function index(){
            $data = $this->model->get_data();
            $this->view->render('moderator_view.php',false, $data);

        }

        function orderBy($order){
            switch($order){
                case 'name':
                    $data = $this->model->get_data("ORDER BY rvwName, isApproved, rvwDate DESC, rvwTime DESC");
                    break;
                case 'email':
                    $data = $this->model->get_data("ORDER BY rvwEmail, isApproved, rvwDate DESC, rvwTime DESC");
                    break;
                case 'status':
                    $data = $this->model->get_data("ORDER BY rvwDate, rvwTime, isApproved");
                    break;
                default:
                    $data = $this->model->get_data();
            }
            $this->view->render('moderator_view.php',false, $data);
        }

        public function approve($rvwID){
            switch($this->model->approve($rvwID)){
                case '1':
                case '0':
                    header('Location: '.URL.'/Moderator');
                    break;
                case '-1':
                    header('Location: '.URL.'/Login');
                    break;
                default:
                    header('Location: '.URL.'/Moderator');
            }
        }

        public function dismiss($rvwID){
            switch($this->model->dismiss($rvwID)){
                case '1':
                case '0':
                    header('Location: '.URL.'/Moderator');
                    break;
                case '-1':
                    header('Location: '.URL.'/Login');
                    break;
                default:
                    header('Location: '.URL.'/Moderator');
            }
        }

        public function edit($rvwID){

        }
    }