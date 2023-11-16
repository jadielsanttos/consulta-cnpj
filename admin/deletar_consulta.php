<?php 

require __DIR__.'/../vendor/autoload.php';

use App\Consultas\Consulta;

$objConsulta = new Consulta();

$id = filter_input(INPUT_GET, 'id');

if(isset($id) && !empty($id)) {
    $objConsulta->deletarConsulta($id);
}

header('location: index.php');
exit;