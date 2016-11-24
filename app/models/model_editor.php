<?php
class Model_Editor extends Model{
    public function __construct(){
        parent::__construct();
    }

    //Moderator/edit/1
    public function getRvwText($rvwID){
        $sql = "SELECT rvwText
                    FROM reviews
                    WHERE rvwID = '$rvwID'";
        $result = $this->db->query($sql);
        if(!empty($result)){
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row['rvwText'];
            }
        }else{
            return -1;
        }
    }

    public function setRvwText($rvwID, $text){
        $sql = "UPDATE reviews
                SET rvwText = '$text', isMaintained = '1'
                WHERE rvwID = '$rvwID'";

        $this->db->query($sql);
    }
}