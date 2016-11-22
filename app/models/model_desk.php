<?php
    class Model_Desk extends Model{
        public function __construct(){
            parent::__construct();
        }


        public function get_data($order = "ORDER BY rvwDate DESC, rvwTime DESC"){
            $sql = "SELECT rvwName, rvwEmail, rvwText, rvwImgSrc, rvwDate, rvwTime, isMaintained
                    FROM reviews
                    WHERE isApproved = 2
                    $order";

            return $this->db->query($sql);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


    }