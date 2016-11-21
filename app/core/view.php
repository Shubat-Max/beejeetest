<?php
    class View {
        public function __construct(){

        }

        public function render($content_view, $noInclude = false, $data = null){
            if(!$noInclude){
                require 'app/views/header_view.php';
                require 'app/views/'.$content_view;
                require 'app/views/footer_view.php';
            }else{
                require 'app/views/'.$content_view;
            }
        }
    }