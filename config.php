<?php
    // $host='LocalHost';
    // $userName= 'root';
    // $password= '';
    // $name='site-papai';
    $conn = new mysqli("avian-slice-380715:us-central1:site-papai");

    // Verificar se a conexão foi estabelecida com sucesso
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit();
}
?>