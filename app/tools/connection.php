<?php
    function connect_db(){
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'beejeetest';

        $link = new mysqli($host, $user, $password, $database);
        if($link->connect_error){
            return $link->connect_error;
        }
        return $link;
    }

    function disconnect_db($link){
        $link->close();
    }


