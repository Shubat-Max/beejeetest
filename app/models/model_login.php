<?php
    class Model_Login extends Model {
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['userLogin'])){
                    $userLogin = $_POST['userLogin'];
                }else{
                    return 0;
                }

                if(isset($_POST['userPass'])){
                    $userPass = $_POST['userPas'];
                }else{
                   return 0;
                }

                $sql = "SELECT userID
                        FROM admins
                        WHERE (userName = '$userLogin') AND (userPass = MD5('$userPass'))";
                $result = $this->db->query($sql) or die("Error:".$this->db->error);

                if(!empty($result)){
                    Session::set('loggedIn', true);
                    header('Location: '.URL.'/Moderator');
                }else{
                    header('Location: '.URL.'/Login');
                }
            }else{
                header('Location: '.URL.'/Login');
            }
        }

        public function logout(){
            Session::destroy();
            header('Location: '.URL.'/Login');
        }
    }