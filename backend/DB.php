<?php

/**
 * Classe para conexao com o banco de dados MySQL,
 * via acesso nativo do PHP/PDO.
 * Eh necessario ter definido as seguintes constantes:
 * DB_NAME, DB_HOST, DB_USER, DB_PASSWORD
 */

class DB{
    /**
     * Instancia Singleton
     * @var DB
     */
    private static $instance;
    /**
     * Conexao com o banco de dados
     * @var PDO
     */
    private static $connection;

    /**
     * Construtor privado da classe Singleton
     */
    private function __construct(){
        self::$connection = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * Obtem a instancia da classe DB
     * @return type
     */
    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new DB();
        }

        return self::$instance;
    }

    /**
     * Retorna a conexao PDO com o banco de dados
     * @return PDO
     */
    public static function getConn(){
        self::getInstance();

        return self::$connection;
    }

    /**
     * Prepara o SQL para ser executado posteriormente
     * @param String $sql
     * @return PDOStatement stmt
     */
    public static function prepare($sql){
        return self::getConn()->prepare($sql);
    }

    /**
     * Retorna o id da ultima query INSERT
     * @return int
     */
    public static function lastInsertId(){
        return self::getConn()->lastInsertId();
    }

    /**
     * Inicia uma transacao
     * @return bool
     */
    public static function beginTransaction(){
        return self::getConn()->beginTransaction();
    }

    /**
     * Commita uma transacao
     * @return bool
     */
    public static function commit(){
        return self::getConn()->commit();
    }

    /**
     * Realiza um rollback na transacao
     * @return bool
     */
    public static function rollBack(){
        return self::getConn()->rollBack();
    }

    /**
     * Formata uma data para o MySQL (05/12/2012 para 2012-12-05)
     * @param type $date
     * @return type
     */
    public static function dateToMySQL($date){
        return implode("-", array_reverse(explode("/", $date)));
    }

    /**
     * Formata uma data do MySQL (2012-12-05 para 05/12/2012)
     * @param type $date
     * @return type
     */
    public static function dateFromMySQL($date){
        return implode("/", array_reverse(explode("-", $date)));
    }

    /**
     * Ajusta um valor para o padrao decimal do MySQL
     * @param type $value
     * @return type
     */
    public static function decimalToMySQL($value){
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);

        return $value;
    }
}

?>