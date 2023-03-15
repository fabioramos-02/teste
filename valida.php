<?php
session_start();
include_once("config.php");
if (isset($_POST['username']) && (isset($_POST['password']))) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); //escapar de caracteres especiais
    $passord = mysqli_real_escape_string($conn, $_POST['password']); //escapar de caracteres especiais
    // $passord = md5($passord);

    $sql = "SELECT * FROM login WHERE username ='$username' && password = '$passord' LIMIT 1 ";
    $result = mysqli_query($conn, $sql);
    $resultado = mysqli_fetch_assoc($result);

    if (empty($resultado)) {
        $_SESSION['loginErro'] = 'Usuário ou senha inválidos';
        header("Location: login.php");
    } elseif (isset($resultado)) {
        $_SESSION['id'] = $resultado['id'];
        $_SESSION['username'] = $resultado['username'];
        $_SESSION['password'] = $resultado['password'];
        header("Location: listagem.php");
    } else {
        $_SESSION['loginErro'] = 'Usuário ou senha inválidos';
        header("Location: login.php");
    }
} else {
    // Exibe uma mensagem de erro
    $_SESSION['loginErro'] = 'Usuário ou senha inválidos';
    header("Location: login.php");
}
?>