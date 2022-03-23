<?php


class AdminController {
    public static function checkAdmin()
    {

        if(Admin::checkLogged()){
            return true;
        }

    }

    public function actionlist(){
        if(self::checkAdmin()){
            $taskList = Task::getAllTasks();

            require_once(ROOT . '/views/admin/index.php');
            return true;
        }

        header("Location: /admin/login");

    }

    public function actionLogin()
    {
        $username = false;
        $password = false;
        
        if(self::checkAdmin()){
            header("Location: /admin");
            die();
        }

        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $errors = false;

            if (!Admin::checkAdminData($username, $password)) {
                $errors[] = 'Wrong login data';
            } else {
                Admin::authenticate(); 
                header("Location: /admin");
            }
        }

        require_once(ROOT . '/views/admin/login.php');
        return true;
    }

    public function actionLogout(){
        unset($_SESSION['user']);
    }

    public function actionUpdate(){
        if(self::checkAdmin()){
            header("Location: /admin");
            die();
        }
        if(isset($_POST['submit'])){
            if(Task::updateTask($_POST['id'], $_POST['username'], $_POST['email'], $_POST['text'])){
                header("Location: /admin");
            }
        }
    }

    public static function actionDelete($id){
        if(!self::checkAdmin()){
            header("Location: /admin");
            die();
        }

    	Task::deleteTask($id);
    	header("Location: /admin");
    }

    public static function actionSetstatus($id, $status){
        if(!self::checkAdmin()){
            return http_response_code(400);
        }
        if(Task::updateTaskStatus($id, $status)){
            return http_response_code(200);
        }

    }
}

?>