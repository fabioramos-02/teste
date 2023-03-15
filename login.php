<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/stiloLogin.css">
    <title>Login</title>
</head>
<?php
session_start();
include_once("config.php");
?>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                    <img src="./img/logo.png" alt="">
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <?php if (isset($_SESSION['loginErro'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['loginErro']; ?>
                                <?php unset ($_SESSION['loginErro']); ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="valida.php">
                            <div class="form-group input-field">
                                <label for="username">Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                            </div>
                            <div class="form-group input-field">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control " name="password" id="password" required>
                            </div>
                            <div class="input-field">
                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>