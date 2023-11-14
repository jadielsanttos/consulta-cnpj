<?php 

namespace App\Consultas;

use App\DB\MySQL;

class Consulta {
    /**
     * Objeto MYSQL
     * @var object
     */
    private object $MySQL;

    /**
     * Variável que armazena o nome da tabela
     * @var string
     */
    const TABLE = 'consultas';

    public function __construct() {
        $this->MySQL = new MySQL;
    }

    /**
     * Método responsável por listar as consultas
     * @return array
     */
    public function listarConsultas() {
        $array = [];

        $query = "SELECT * FROM ".self::TABLE."";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $dadosDaConsulta = $stmt->fetchAll();

            foreach($dadosDaConsulta as $item) {
                $array[] = $item['id'];
                $array[] = $item['cnpj'];
                $array[] = $item['data_consulta'];
                $array[] = $item['ip'];
            }
        }

        return $array;
    }

    /**
     * Método responsável por cadastrar as consultas
     * @param string (cnpj)
     */
    public function cadastrarConsulta($cnpj) {
        // Data da consulta
        $dataConsulta = date('Y-m-d');

        // Pegando IP
        $ip = '192.168.63.116';

        $query = "INSERT INTO ".self::TABLE." VALUES (null,?,?,?)";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute(array($cnpj,$dataConsulta,$ip));
    }
    
}