<?php
/*
.../ CLASS / METHOD / VAR
.../Login/Run/123
$url[0]/$url[1]/$url[2]
*/
    class Route{
        public function __construct(){
            $url = isset($_GET['url']) ? $_GET['url'] : NULL;
            $url = rtrim($url, '/');
            $url = explode('/', $url);

            /*
            echo "<PRE>";
            print_r($url);
            echo "</PRE>";
            */

            //Default page
            if(empty($url[0])){
                require 'app/controllers/controller_desk.php';
                $controller = new Controller_Desk();
                $controller->loadModel('desk');
                $controller->index();
                return false;
            }

            $file = strtolower('app/controllers/controller_'.$url[0].'.php');
            if(file_exists($file)){
                require $file;
            }else{
                require 'app/controllers/controller_404.php';
                $controller = new Controller_404();
                $controller->view->render('404_view.php');
                return false;
            }

            $ctrl_name = 'Controller_'.$url[0];
            $controller = new $ctrl_name;
            //Проверка на наличие файла модели реализована внутри функции loadModel()
            $controller->loadModel($url[0]);

            if(isset($url[2])){
                if(method_exists($controller, $url[1])){
                    $controller->{$url[1]}($url[2]);
                }else{
                    echo "Ошибка: Функция $url[1] не принимает параметр $url[2]";
                    //TODO: Редирект + 404
                }
            }else{
                if(isset($url[1])){
                    if(method_exists($controller,$url[1])){
                        $controller->{$url[1]}();
                    }else{
                        echo "Ошибка: Отсутствует метод $url[1]";
                        //TODO: Редирект + 404
                    }
                }else{
                    $controller->index();
                }
            }
        }

        /*
        static function launch(){
            //Values by default (Index page)
            $controller_name = 'Desk';
            $action_name = 'index';

            $routes = explode('/', $_SERVER['REQUEST_URI']);

            //Getting controller name
            if( !empty($routes[1]) ){
                $controller_name = $routes[1];
            }

            //Getting action name
            if( !empty($routes[2]) ){
                $action_name = $routes[2];
            }

            //Adding prefixes
            $model_name = 'Model_'.$controller_name;
            $controller_name = 'Controller_'.$controller_name;
            $action_name = 'action_'.$action_name;

            //Inserting the file containing class of the Model
            $model_file = strtolower($model_name).'.php';
            $model_path = "app/models/".$model_file;
            if( file_exists($model_path) ){
                include $model_path;
            }

            //Inserting the file containing class of the Controller
            $controller_file = strtolower($controller_name).'.php';
            $controller_path = "app/controllers/".$controller_file;
            if( file_exists($controller_path) ){
                include $controller_path;
            }else{
                Route::ErrorPage404();
            }

            $controller = new $controller_name;
            $action = $action_name;

            if( method_exists($controller, $action) ){
                $controller->$action();
            }else{
                Route::ErrorPage404();
            }
        }
        */


        function ErrorPage404(){
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:'.$host.'404');
        }
    }