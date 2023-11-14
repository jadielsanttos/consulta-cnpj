<?php 

require __DIR__.'/../vendor/autoload.php';

use App\Usuarios\Usuario;

$objUsuario = new Usuario();
$objUsuario->logout();