<?php

class Task {

    public const SHOW_BY_DEFAULT = 3; 
    public static function getTaskList($page = 1, $sortRule, $reverseSort) {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $db = Db::getConnection();
        $taskList = array();

        if($reverseSort){
            $sql = "SELECT id, username, date, email, text, done FROM tasks ORDER BY $sortRule DESC LIMIT :limit OFFSET :offset";
        } else {
            $sql = "SELECT id, username, date, email, text, done FROM tasks ORDER BY $sortRule ASC LIMIT :limit OFFSET :offset";
        }
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        $result->execute();

        $i = 0;

        while($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['username'] = $row['username'];
            $taskList[$i]['date'] = $row['date'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['text'] = $row['text'];
            $taskList[$i]['done'] = $row['done'];
            $i++;
        }

        return $taskList;
    }

    public static function setTaskStatus($id, $status){
        $db = Db::getConnection(); 
        $statement = $db->prepare("UPDATE tasks SET done = :st WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->bindValue(':st', $status);
        return $statement->execute();
    }

    public static function createTask($username, $email, $text){
        $db = Db::getConnection(); 
        $statement = $db->prepare("INSERT INTO tasks (id, username, date, email, text, done) VALUES (NULL, :username, CURRENT_TIMESTAMP, :email, :text, 0)");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":text", $text, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function updateTask($id, $username, $email, $text){

        $db = Db::getConnection();
        $sql = "UPDATE tasks SET username = :username, email = :email, text = :text WHERE id = :id";

        $statement = $db->prepare($sql);
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":text", $text, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        
        return $statement->execute();
    }

    public static function getTotalTasks(){
        $db = Db::getConnection();

        $sql = 'SELECT count(id) AS count FROM tasks';

        $result = $db->prepare($sql);

        $result->execute();
        $row = $result->fetch();
        return $row['count'];
    }

    public static function getAllTasks() {
        $db = Db::getConnection();
        $taskList = array();
        $sql = "SELECT id, username, date, email, text, done FROM tasks ORDER BY id";
        $result = $db->prepare($sql);

        $result->execute();

        $i = 0;

        while($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['username'] = $row['username'];
            $taskList[$i]['date'] = $row['date'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['text'] = $row['text'];
            $taskList[$i]['done'] = $row['done'];
            $i++;
        }

        return $taskList;
    }

    public static function deleteTask($id){
    	$db = Db::getConnection();

        $sql = 'DELETE FROM tasks WHERE id = :id';
	
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);

          return $result->execute();
    }

    public static function updateTaskStatus($id, $status){
        $db = Db::getConnection();
        $sql = "UPDATE tasks SET done = :status WHERE id = :id";

        $statement = $db->prepare($sql);
        $statement->bindParam(":status", $status, PDO::PARAM_INT);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        
        return $statement->execute();
    }
}
?>