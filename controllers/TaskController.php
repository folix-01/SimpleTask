<?php

include_once ROOT . '/models/Task.php';
include_once ROOT . '/components/Pagination.php';

class TaskController {

    public function actionIndex() {
        header('Location: '."/task/1");
    }

    public function actionList($page = 1){
    	if($_SERVER['REQUEST_URI'] == "/task"){
    		header("Location: /task/1");
    	}
        if(isset($_SESSION['sortRule'])){
            $sortRule = $_SESSION['sortRule'];
        } else {
            $sortRule = 'id';//default sort pattern
        }

        if(isset($_GET['sort'])){
            switch($_GET['sort']){
                case 'id':
                    $sortRule = 'id';
                    break;
                case 'email':
                    $sortRule = 'email';
                    break;
                case 'status':
                    $sortRule = 'done';
                    break;
                case 'username':
                    $sortRule = "username";
                    break;
                }
        }
        $_SESSION['sortRule'] = $sortRule;

        if(isset($_GET['reverse'])){
            if($_GET['reverse'] == "false"){
                $_SESSION['reverse'] = "false";
            } else {
                $_SESSION['reverse'] = "true";
            }
        } else {
            $_SESSION['reverse'] = "true";
        }

        if(isset($_SESSION['reverse'])){
            if($_SESSION['reverse'] == 'false'){
                $reverseSort = false;
            } else {
                $reverseSort = true;
            }
        } else {
            $reverseSort = true;
        }
        
        $formValidationErrors = array();

        $username = "";
        $email = "";
        $text = "";
        if(isset($_POST['submit'])){
            if(empty($_POST['username'])){
                $formValidationErrors['username'] = 'empty';
            } else {
                $username = htmlspecialchars($_POST['username']);
            }

            if(empty($_POST['email'])){
                $formValidationErrors['email'] = 'empty';
            } else {
                $email = htmlspecialchars($_POST['email']);
            }

            if(empty($_POST['text'])){
                $formValidationErrors['text'] = 'empty';
            } else {
                $text = htmlspecialchars($_POST['text']);
            }

            if(empty($formValidationErrors)){
                Task::createTask($username, $email, $text);
            }
        }

        $total = Task::getTotalTasks();
        $taskList = Task::getTaskList($page, $sortRule, $reverseSort);
        $pagination = new Pagination($total, $page, Task::SHOW_BY_DEFAULT);
        require_once(ROOT . '/views/list/index.php');
    }
    
}
?>
