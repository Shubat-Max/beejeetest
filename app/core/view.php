<?php
    class View {
        public function __construct(){
        }

        public function render($content, $putHeader = false, $putFooter = false, $data = null){
            require "app/core/header.php";
            if($putHeader){
                require 'app/views/header_view.php';
            }
            if(is_array($content)){
                foreach($content as $page){
                    require 'app/views/'.$page;
                }
            }else{
                require 'app/views/'.$content;
            }

            if($putFooter){
                require 'app/views/footer_view.php';
            }
            require "app/core/footer.php";
        }


    }