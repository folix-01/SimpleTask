<?php
include_once ROOT . '/components/Db.php';

class Admin {
    public static function authenticate()
    {
        $_SESSION['user'] = "admin";
    }


    public static function checkAdminData($username, $password)
    {   
        $password = hash("sha256", $password);
        $db = Db::getConnection();


        $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        if ($result->fetch()) {
            return true;
        }
        return false;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}
?>