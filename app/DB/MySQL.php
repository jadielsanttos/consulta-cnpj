<?php

namespace App\DB;

session_start();

use PDO;
use PDOException;

class MySQL {

     /**
      * host
      * @var string
      */
     const DB_HOST = 'localhost';

     /**
      * db_name
      * @var string
      */
     const DB_NAME = 'consulta_cnpj';

     /**
      * db_user
      * @var string
      */
     const DB_USER = 'root';

     /**
      * db_pass
      * @var string
      */
     const DB_PASS = '';

     /**
      * Objeto DB
      * @var objeto
      */
     private object $db;

     public function __construct() {
          $this->db = $this->setDB();
     }

     /**
      * Método responsável por fazer a conexao com o banco de dados
      * @return PDO
      */
     public function setDB() {
          try {
               return new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS);
          }catch(PDOException $e) {
               throw new PDOException('ERRO: '.$e->getMessage());
          }
     }

     public function getDB() {
          return $this->db;
     }
}