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

        $itemsPerPage = 7;
        $page = intval(filter_input(INPUT_GET, 'p'));

        if($page < 1) {
            $page = 1;
        }

        $offSet = ($page - 1) * $itemsPerPage;

        // Puxando todas as consultas e ordenando pelo ID de forma decrescente
        $query = "SELECT * FROM ".self::TABLE." ORDER BY id DESC LIMIT $offSet,$itemsPerPage";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $array['info'] = $stmt->fetchAll();
        }

        // Pegando a contagem total de registros para gerar as páginas (paginação)
        $array['pages'] = $this->quantidadeDeConsultas($itemsPerPage);

        return $array;
    }

    /**
     * Método responsável por pegar a quantidade total de consultas
     * @param integer (Items por página)
     * @return integer (Quantidade de páginas)
     */
    public function quantidadeDeConsultas($itemsPerPage) {
        $totalPages = 0;

        $query = "SELECT COUNT(*) AS c FROM ".self::TABLE."";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $totalPages = ceil($data['c'] / $itemsPerPage);
        }

        return $totalPages;
    }

    /**
     * Método responsável por cadastrar as consultas
     * @param string (cnpj)
     */
    public function cadastrarConsulta($cnpj, $dataConsulta, $ip) {
        $query = "INSERT INTO ".self::TABLE." VALUES (null,?,?,?)";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->execute(array($cnpj,$dataConsulta,$ip));
    }

    /**
     * Método responsável por limitar a quantidade de consultas por usuário
     * @param string (ip)
     * @param string (date)
     * @return boolean
     */
    public function findByIpAndDate($dataConsulta, $ip) {
        $query = "SELECT * FROM ".self::TABLE." WHERE data_consulta = :data_consulta AND ip = :ip";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->bindValue(':data_consulta', $dataConsulta);
        $stmt->bindValue(':ip', $ip);
        $stmt->execute();

        if($stmt->rowCount() >= 2) {
            return true;
        }

        return false;
    }

    /**
     * Método responsável por deletar uma consulta do banco de dados
     * @param integer (id)
     */
    public function deletarConsulta($id) {
        $query = "DELETE FROM ".self::TABLE." WHERE id = :id";
        $stmt = $this->MySQL->getDB()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    
}