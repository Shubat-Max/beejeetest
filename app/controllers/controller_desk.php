<?php
    class Controller_Desk extends Controller {
        function __construct(){
            parent::__construct();
        }

        public function index(){
            //$this->view->data = "Данные из Контроллер_Деск";
            $data = $this->model->get_data();
            $this->view->render('desk_view.php',false, $data);
        }

        function orderBy($order){
            switch($order){
                case 'name':
                    $data = $this->model->get_data("ORDER BY rvwName, rvwDate DESC, rvwTime DESC");
                    break;
                case 'email':
                    $data = $this->model->get_data("ORDER BY rvwEmail, rvwDate DESC, rvwTime DESC");
                    break;
                default:
                    $data = $this->model->get_data();
            }
            $this->view->render('desk_view.php',false, $data);
        }
    }

