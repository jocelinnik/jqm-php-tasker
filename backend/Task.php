<?php

class Task{

    /**
     * Insere uma nova tarefa no banco de dados
     * @param String $title
     * @return int id_task
     */
    public function create($name, $email, $password){
        if(empty($_SESSION["user_id"])) throw new \Exception("Necessário login.");

        $status = '0';
        $user_id = $_SESSION["user_id"];
        $created = date("Y-m-d");

        $sql = "INSERT INTO tasks (title, status, created, user_id) VALUES (:title, :status, :created, :user_id)";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("title", $title);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("created", $created);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();

        $id_task = DB::lastInsertId();

        return $id_task;
    }

    /**
     * Retorna todas as tarefas que estao com um determinado status
     * @param String $status
     * @return array
     * @throws Exception
     */
    public function getByStatus($status="0"){
        if(empty($_SESSION["user_id"])) throw new \Exception("Necessário login.");

        $user_id = $_SESSION["user_id"];

        $sql = "SELECT * FROM tasks WHERE status=:status AND user_id=:user_id";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("status", $status);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Marca uma tarefa como completada
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function completeTask($id){
        if(empty($_SESSION["user_id"])) throw new \Exception("Necessário login.");

        $user_id = $_SESSION["user_id"];

        $sql = "SELECT * FROM tasks WHERE id=:id AND user_id=:user_id";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("id", $id);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();

        $task = $stmt->fetch();
        if($task!=null){
            $sql = "UPDATE tasks SET status='1' WHERE id=:id";
            $stmt = DB::prepare($sql);

            $stmt->bindParam("id", $id);
            $stmt->execute();

            return true;
        }else{
            throw new Exception("Tarefa não existe");
        }
    }
}

?>