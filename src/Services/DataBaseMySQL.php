<?php

namespace App\Services;


use PDO;
use PDOException;


/**
 * Class to connect to the database with its methods
 */
final class DataBaseMySQL 
{

    private string $dbname ;
    private string $host;
    private string $username ;
    private string $password ;
    private  $pdo;
    


    /**
     * method __construct()
     *
     * 
     */
    public function __construct(string $dbname, string $host, string $username, string $password, )
    {
        $this->dbname= $dbname;
        $this->host= $host;
        $this->username= $username;
        $this->password= $password;
    }
    

    /**
     * medoth for create a folder and a file who will stocked the errors, interface=> DBLoggerable
     * @params the error message
     * @return void
     */
    public function createLogger(string $message):void 
    {
        if (!is_dir('Logger/')) {
            mkdir('Logger/database/', 0777, true);
        }
        file_put_contents('Logger/database/'.date('Y-d-m').'.log', $message. PHP_EOL, FILE_APPEND);
    }
    

    /**
     * created private method a pdo instance
     *
     * @return void
     */
    private function createPDO() : void
    {
            $this->pdo = new PDO('mysql:dbname='.$this->dbname.';host='.$this->host,$this->username, $this->password,
            [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS
            ]
        );
    }

    /**
     * method create a pdo instance if no exists
     * in catch => manage errors
     *
     * @return PDO
     */
    public function getPDO() : PDO
    {
        try{
            if ($this->pdo === null) {
                $this->createPDO();
                echo 'Base de données create';
            }
                return $this->pdo;

        } catch(PDOException $exception){
            $exception = sprintf("[%s] : %s ligne %s",$exception->getMessage(), $exception->getFile(), $exception->getLine()) .PHP_EOL;
            $this->createLogger($exception);
            echo 'Oups !!! Une erreur est survenue';
            die();
        }
    }


    
}