<?php
    class Controller_Moderator extends Controller {
        function __construct(){
            parent::__construct();
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









        function action_index(){
            $data = $this->model->get_data();
            $this->view->render("moderator_view.php", "template_view.php", $data);
        }

        function action_orderByName(){

            //static $desc = 0; //BACK AND FOURTH?

            $data = $this->model->get_data("ORDER BY rvwName, isApproved, rvwDate DESC, rvwTime DESC");
            $this->view->render("moderator_view.php", 'template_view.php', $data);
        }

        function action_orderByEmail(){
            $data = $this->model->get_data("ORDER BY rvwEmail, isApproved, rvwDate DESC, rvwTime DESC");
            $this->view->render("moderator_view.php", 'template_view.php', $data);
        }

        function action_orderByDate(){
            $data = $this->model->get_data("ORDER BY rvwDate, rvwTime, isApproved");
            $this->view->render("moderator_view.php", 'template_view.php', $data);
        }

        function action_orderByStatus(){
            $data = $this->model->get_data();
            $this->view->render("moderator_view.php", 'template_view.php', $data);
        }
    }