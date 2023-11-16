<?php

require __DIR__.'/vendor/autoload.php';

use App\WebService\Speedio;
use App\Consultas\Consulta;

// Instância da classe de consulta
$objConsulta = new Consulta();

// Pegando CNPJ via POST
$cnpjValue = filter_input(INPUT_POST, 'cnpj');

// Pegando DATA
$dataConsulta = date('Y-m-d');

// Pegando IP
$ip = $_SERVER['REMOTE_ADDR'];

// Verifica se o campo não está vazio
if(!empty($cnpjValue)) {
    $resultado = Speedio::consultarCnpj($cnpjValue);

    // Validando limite de requests por usuario
    if($objConsulta->findByIpAndDate($dataConsulta, $ip)) {
        echo '<script>alert("Você atingiu seu limite de consultas no dia")</script>';
        echo '<script>window.location.href = "index.php"</script>';
        exit;
    }
    
    // Evitando registros desnecessários
    if(!isset($resultado['error']) && !isset($resultado['detail'])) {
        $objConsulta->cadastrarConsulta($cnpjValue, $dataConsulta, $ip);
    }
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
                <h1>Busca CNPJ</h1>
            </div>
            <div class="area_field">
                <form method="POST">
                    <div class="row_input_search">
                        <input type="text" name="cnpj" placeholder="99.999.999/9999-99" autocomplete="off" id="input_cnpj">
                        <button id="btn_send"><i class="fa-regular fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <div class="area_termos_de_uso">
                <div class="left_side">
                    <input type="checkbox" checked>
                </div>
                <div class="right_side">
                    <span>Li e concordo com os <strong>termos de uso</strong></span>
                </div>
            </div>
            <div class="area_modal_termos_de_uso">
                <div class="modal">
                    <div class="btn_close_modal"><i class="fa-solid fa-xmark"></i></div>
                    <div class="content_modal">
                        <p>
                            O uso inapropriado dos dados referente aos CNPJ's, está ligado diretamente com a índole do usuário, 
                            o projeto foi criado com o intuito de ser uma ferramenta de pesquisa e investigação digital afim de verificar a procedência de um CNPJ e evitar tais tipos de golpes.
                            Por questões de segurança e acessibilidade, cada usuário pode fazer até 2 consultas por dia.
                        </p>
                        <p id="single_paragraph">ok, li e concordo</p>
                    </div>
                </div>
            </div>
            <div class="area_loading">
                <div class="loader"></div>
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