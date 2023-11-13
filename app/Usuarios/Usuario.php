<?php

namespace App\Usuarios;

use App\DB\MySQL;

class Usuario {

    private object $MySql;

    const TABLE = 'usuarios';

    public function __construct() {
        $this->MySql = new MySQL();
    }

    /**
     * Método responsável por fazer login
     * @param string (email)
     * @param string (senha)
     */
    public function login($email, $senha) {
        $consulta = "SELECT * FROM ".self::TABLE." WHERE email = :email AND senha = :senha";
        $stmt = $this->MySql->getDB()->prepare($consulta);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $dataUser = $stmt->fetch();

            $_SESSION['usuario_logado'] = $dataUser['id'];

            header('location: admin/index.php');
            exit;
        }else {
           $_SESSION['error'] = 'Dados não encontrados!';
        }
    }

    /**
     * Método responsável por fazer logout
     */
    public function logout() {
        unset($_SESSION['usuario_logado']);
        header('location: index.php');
        exit;
    }
    
}