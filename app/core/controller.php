<?php
    class Controller {

        public function __construct(){
            $this->view = new View();
        }

        public function loadModel($name) {
            $path = strtolower('app/models/model_'.$name.'.php');
            if(file_exists($path)){
                require $path;
                $modelName = 'Model_'.$name;
                $this->model = new $modelName();
                return 1;
            }else{
                return -1;
            }
        }

        //public $model;
        //public $view;

        //public function action_index(){}
    }