<?php
    class Model_Moderator extends Model {
        public function __construct(){
            parent::__construct();
        }


        public function get_data($order = "ORDER BY isApproved, rvwDate DESC, rvwTime DESC", $desc = 0){
            include_once "/../tools/connection.php";

            $link = connect_db();

            $sql = "SELECT *
                    FROM reviews
                    $order";

            $result = $link->query($sql);
            disconnect_db($link);
            return $result;
        }
    }
