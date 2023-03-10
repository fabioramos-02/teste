<?php
    $host='LocalHost';
    $userName= 'root';
    $password= '';
    $name='site-papai';
    $conn = new mysqli($host,$userName,$password,$name);

    // Verificar se a conexão foi estabelecida com sucesso
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit();
}
?>