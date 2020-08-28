<?php

class User{

    /**
     * Insere um novo usuario no banco de dados
     * @param String $name
     * @param String $email
     * @param String $password
     * @return int id_user
     */
    public function create($name, $email, $password){
        $this->checkEmail($email);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("name", $name);
        $stmt->bindParam("email", $email);
        $stmt->bindParam("password", $password);
        $stmt->execute();

        $id_user = DB::lastInsertId();

        return $id_user;
    }

    /**
     * Verifica se o email jah estah cadastrado no banco de dados
     * @param String $email
     * @throws Exception
     */
    public function checkEmail($email){
        $sql = "SELECT id FROM users WHERE email=':email'";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("email", $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if($user) throw new \Exception("Email já está cadastrado");
    }

    /**
     * Valida o login do usuario
     * @param String $email
     * @param String $password
     * @return User
     */
    public function checkLogin($email, $password){
        $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("email", $email);
        $stmt->bindParam("password", $password);
        $stmt->execute();
        $user = $stmt->fetch();

        return $user;
    }
}

?>