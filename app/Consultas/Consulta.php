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

        $perPage = 7;
        $page = intval(filter_input(INPUT_GET, 'p'));

        if($page < 1) {
            $page = 1;
        }

        $offSet = ($page - 1) * $perPage;

        // Puxando todas as consultas ordenando via ID de forma decrescente
        $query = "SELECT * FROM ".self::TABLE." ORDER BY id DESC LIMIT $offSet,$perPage";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $array['info'] = $stmt->fetchAll();
        }

        // Pegando a contagem total de registros
        $query = "SELECT COUNT(*) AS c FROM ".self::TABLE."";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $array['pages'] = ceil($data['c'] / $perPage);
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