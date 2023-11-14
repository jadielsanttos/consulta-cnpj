<?php

require __DIR__.'/../vendor/autoload.php';

use App\Usuarios\Usuario;

$objUsuario = new Usuario();

if(isset($_POST['Entrar'])) {
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');

    if($email && $senha) {
        $objUsuario->login($email, $senha);
    }

    header('location: login.php');
    exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Login</title>
</head>
<body>
    <section class="section_login">
        <div class="title">
            <h1>Login</h1>
        </div>
        <div class="area_form">
            <form method="post">
                <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
                    <div class="msg_error"><?=$_SESSION['error'];?></div>
                    <?php $_SESSION['error'] = '';?>
                <?php endif ?>
                <div class="row_input">
                    <label for="Email">Email</label>
                    <input type="email" name="email" placeholder="digite seu email...">
                </div>
                <div class="row_input">
                    <label for="Senha">Senha</label>
                    <input type="password" name="senha" placeholder="digite sua senha...">
                </div>
                <div class="row_input_submit">
                    <input type="submit" value="Entrar" name="Entrar">
                </div>
            </form>
        </div>
    </section>
</body>
</html>