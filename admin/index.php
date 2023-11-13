<?php 

session_start();

if(!isset($_SESSION['usuario_logado']) && empty($_SESSION['usuario_logado'])) {
    header('location: login.php');
    exit;
}

echo '<h1>Olá, você está logado!</h1>';