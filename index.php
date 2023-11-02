<?php

require __DIR__.'/vendor/autoload.php';

use App\WebService\Speedio;

$objSpeedio = new Speedio();

$cnpjValue = filter_input(INPUT_POST, 'cnpj');

// Verifica se o campo não está vazio
if(!empty($cnpjValue)) {
    $resultado = $objSpeedio->consultarCnpj($cnpjValue);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Consulta CNPJ</title>
</head>
<body>
    <section class="section_single">
        <div class="bar_top"></div>
        <div class="area_section">
            <div class="title">
                <h1>Consulta CNPJ</h1>
            </div>
            <div class="area_field">
                <form method="POST">
                    <div class="row_input_search">
                        <input type="text" name="cnpj" placeholder="99.999.999/9999-99" autocomplete="off" id="input_cnpj">
                        <button id="btn_send"><i class="fa-regular fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <?php 
                if(isset($resultado) && !isset($resultado['error']) && !isset($resultado['detail'])) {
                    require 'partials/resultado.php';
                }else if(isset($resultado['error'])) {
                    require 'partials/resultado_error.php';
                }
            ?>
        </div>
    </section>
    
    <script src="assets/js/app.js"></script>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>

