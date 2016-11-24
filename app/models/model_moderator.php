<?php
    class Model_Moderator extends Model {
        public function __construct(){
            parent::__construct();
        }


        public function get_data($order = "ORDER BY isApproved, rvwDate DESC, rvwTime DESC", $desc = 0){
            $sql = "SELECT *
                    FROM reviews
                    $order";

            return $this->db->query($sql);
        }


        //Moderator/Approve/2
        public function approve($rvwID){
            if($_SESSION['loggedIn'] == true){
                $sql = "SELECT rvwID
                          FROM reviews
                          WHERE rvwID = '$rvwID'";
                $result = $this->db->query($sql);
                if(!empty($result)){
                    $sql = "UPDATE reviews
                    SET isApproved = '2'
                    WHERE rvwID = '$rvwID'";
                    $this->db->query($sql);
                    return 1;
                }else{
                    return 0; //Passed wrong rvwID
                }
            }else{
                return -1; //Unauthorized access denied
            }
        }

        //Moderator/dismiss/3
        public function dismiss($rvwID){
            if($_SESSION['loggedIn'] == true){
                $sql = "SELECT rvwID
                          FROM reviews
                          WHERE rvwID = '$rvwID'";
                $result = $this->db->query($sql);
                if(!empty($result)){
                    $sql = "UPDATE reviews
                    SET isApproved = '1'
                    WHERE rvwID = '$rvwID'";
                    $this->db->query($sql);
                    return 1;
                }else{
                    return 0; //Passed wrong rvwID
                }
            }else{
                return -1; //Unauthorized access denied
            }
        }
    }
