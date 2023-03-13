<?php
// Inclui o arquivo de configuração com a conexão ao banco de dados
require_once 'config.php';

// Lê o valor da pesquisa
$q = $_GET['q'];

// Monta a string SQL para selecionar os cadastros filtrados pelo nome
$sql = "SELECT * FROM cadastro WHERE nome LIKE '%$q%'";

// Executa a query SQL
$resultado = mysqli_query($conn, $sql);

// Cria um array com os resultados
$resultados = array();
while ($row = mysqli_fetch_assoc($resultado)) {
    $resultados[] = $row;
}

// Retorna os resultados em formato JSON
echo json_encode($resultados);
?>
