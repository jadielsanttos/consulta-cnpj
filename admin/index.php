<?php 

require __DIR__.'/../vendor/autoload.php';

use App\Consultas\Consulta;

$consulta = new Consulta();
$data = $consulta->listarConsultas();

$listaDeConsultas = isset($data['info']) ? $data['info'] : [];

$pages = $data['pages'];
$currentPage = filter_input(INPUT_GET, 'p');

if(!isset($currentPage)) {
    $currentPage = 1;
}

if(!isset($_SESSION['usuario_logado']) && empty($_SESSION['usuario_logado'])) {
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Painel Admin</title>
</head>
<body>
    <section class="section_container">
        <aside class="side_bar">
            <div class="area_top">
                <a href="../index.php"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="area_bottom">
                <a href="logout.php"><i class="fa-solid fa-power-off"></i></a>
            </div>
        </aside>
        <main class="area_main_admin">
            <div class="area_title">
                <div class="left_side"><h1>Listagem de consultas</h1></div>
                <div class="right_side">
                    <select name="order_by">
                        <option>Mais Recentes</option>
                    </select>
                </div>
            </div>
            <?php if(isset($listaDeConsultas) && !empty($listaDeConsultas)): ?>
                <div class="area_table">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>CNPJ</th>
                            <th>Data da consulta</th>
                            <th>IP</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach($listaDeConsultas as $item): ?>
                                <tr>
                                    <td><?=$item['id'];?></td>
                                    <td><?=$item['cnpj'];?></td>
                                    <td><?=$item['data_consulta'];?></td>
                                    <td><?=$item['ip'];?></td>
                                    <td><a href="deletar_consulta.php?id=<?=$item['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="area_pagination">
                        <?php for($i=0;$i<$pages;$i++): ?>
                            <div class="item_pagination"><a class="<?=($i+1==$currentPage)?'active':''?>" href="index.php?p=<?=$i+1?>"><?=$i+1;?></a></div>
                        <?php endfor ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="area_excessao">
                    <span>Não há registros a serem exibidos...</span>
                </div>
            <?php endif ?>
        </main>
    </section>
    <script src="https://kit.fontawesome.com/e3dc242dae.js" crossorigin="anonymous"></script>
</body>
</html>