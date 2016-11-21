<?php
    class Model_Desk extends Model{
        public function __construct(){
            parent::__construct();
        }


        public function get_data($order = "ORDER BY rvwDate DESC, rvwTime DESC"){
            require_once "/../tools/connection.php";

            $link = connect_db();

            $sql = "SELECT rvwName, rvwEmail, rvwText, rvwImgSrc, rvwDate, rvwTime, isMaintained
                    FROM reviews
                    WHERE isApproved = 2
                    $order";

            /*
             *
             * ORDER BY rvwName DESC";
             * ORDER BY rvwEmail DESC";
             * ORDER BY rvwDate DESC";
             *
             */

            $result = $link->query($sql);

            disconnect_db($link);

            return $result;
        }


    }