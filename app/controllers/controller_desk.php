<?php
    class Controller_Desk extends Controller {
        function __construct(){
            parent::__construct();
        }

        public function index($data = NULL){
            //$this->view->data = "Данные из Контроллер_Деск";
            if($data === NULL){
                $data = $this->model->get_data();
            }
            $content = array(
                'form_view.php',
                'sorter_view.php',
                'desk_view.php'
            );
            $this->view->render($content, true, true, $data);
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
            Controller_Desk::index($data);
        }

        function transmission(){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if( !isset($_POST['inName']) ){
                    $name_error = "Field is required!";
                }else{
                    $name_post = $this->model->test_input($_POST['inName']);
                    if( empty($name_post) || is_null($name_post) || strlen($name_post) < 4 ){
                        $name_error = "Name is too short. 4 characters or more. Spaces are allowed";
                    }
                }

                if( !isset($_POST['inEmail']) ){
                    $email_error = "Field is required!";
                }else{
                    $email_post = $this->model->test_input($_POST['inEmail']);
                    if(empty($email_post) || is_null($email_post) || !filter_var($email_post, FILTER_VALIDATE_EMAIL)){
                        $email_error = "Incorrect email";
                    }
                }

                if( !isset($_POST['inReview']) ){
                    $text_error = "Field is required!";
                }else{
                    $text_post = $this->model->test_input($_POST['inReview']);
                    if(empty($text_post) || is_null($text_post)){
                        $text_error = "Incorrect text";
                    }
                }

                //ADD IMAGE CHECKING HERE!!!

                if(!isset($name_error) && !isset($email_error) && !isset($text_error)){
                    echo $this->model->transmit($_POST['inName'],$_POST['inEmail'],$_POST['inReview']);
                    unset($_POST);
                    header("Location:".URL."/");
                }
            }
        }
    }

