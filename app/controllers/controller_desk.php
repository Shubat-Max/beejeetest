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

                //Image upload processing
                if(!empty($_FILES["inImage"]["name"])){
                    //Generate unique name for the file
                    $temp = explode(".", $_FILES["inImage"]["name"]);
                    $newfilename = round(microtime(true)) . '.' . end($temp);
                    $save = "img/upload/".$newfilename;

                    //Check if actually an image
                    $check = getimagesize($_FILES["inImage"]["tmp_name"]);
                    if($check === false) {
                        $img_error = "Not an image.";
                    }

                    //Check if size of the image larger than 500Kb - should be enough
                    if ($_FILES["inImage"]["size"] > 5000000) {
                        $img_error = "File is too large";
                    }

                    //Extension check
                    $imageFileType = pathinfo($_FILES["inImage"]["name"], PATHINFO_EXTENSION);
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
                        $img_error = "Only JPG, PNG & GIF files are allowed.";
                    }

                    if (true) {
                        $fn = $_FILES['inImage']['tmp_name'];
                        $size = getimagesize($fn);
                        $ratio = $size[0]/$size[1]; // width/height
                        if( $ratio > 1) {
                            $width = 320;
                            $height = 240/$ratio;
                        }
                        else {
                            $width = 320*$ratio;
                            $height = 240;
                        }
                        $src = imagecreatefromstring(file_get_contents($fn));
                        $dst = imagecreatetruecolor($width,$height);
                        imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
                        imagedestroy($src);
                        imagepng($dst, $save); // adjust format as needed
                        imagedestroy($dst);
                    }
                }else{
                    $img_error = NULL;
                }

                $path = explode('/', $_SERVER['REQUEST_URI']);
                if(empty($path[1])){
                    $path[1] = "Desk";
                }

                if(!isset($name_error) && !isset($email_error) && !isset($text_error)){
                    if(!empty($_FILES["inImage"]["name"])){
                        if(!isset($img_error)){
                            $this->model->transmit($_POST['inName'],$_POST['inEmail'],$_POST['inReview'],$save);
                            $this->view->flag = true;
                            unset($_POST);
                        }
                    }else{
                        $this->model->transmit($_POST['inName'],$_POST['inEmail'],$_POST['inReview']);
                        $this->view->flag = true;
                        unset($_POST);
                    }
                }else{
                    $this->view->flag = false;
                }
                header("Location:".URL."/".$path[1]);
            }
        }
    }

