<?php
    class Controller_Editor extends Controller{
        public function __construct(){
            parent::__construct();
            if($_SESSION['loggedIn'] == false){
                Session::destroy();
                header("Location: ".URL."/Login");
                exit();
            }
        }

        public function edit($rvwID){
            $result = $this->model->getRvwText($rvwID);
            if($result !== -1){
                $this->view->rvwID = $rvwID;
                $this->view->data = $result;
                $this->view->render("editor_view.php", false, false);
            }else{
                header('Location: '.URL.'/Moderator');
            }
        }

        public function confirm($rvwID){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST['editedText'])){
                    if($this->model->getRvwText($rvwID) !== $_POST['editedText']){
                        $this->model->setRvwText($rvwID, $_POST['editedText']);
                    }
                }
            }
            header("Location: ".URL."/Moderator");
        }
    }