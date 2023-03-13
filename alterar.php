<?php
// Conexão com o banco de dados
include_once("config.php");

// Obtém o ID do registro a ser atualizado
$id = $_GET['id'];

// Obtém os dados do registro a ser atualizado
$sql = "SELECT * FROM cadastro WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtém os dados do formulário
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $cpf = $_POST['cpf'];
  $celular = $_POST['celular'];
  $ocupacaoPrincipal = $_POST['ocupacaoPrincipal'];
  $capital = $_POST['capital'];
  $nomeFantasia = $_POST['nomeFantasia'];
  $formaAtuacao = $_POST['formaAtuacao'];

  // Atualiza os dados no banco de dados
  $sql = "UPDATE cadastros SET nome = '$nome', email = '$email', cpf = '$cpf', celular = '$celular', ocupacaoPrincipal = '$ocupacaoPrincipal', capital = $capital, nomeFantasia = '$nomeFantasia', formaAtuacao = '$formaAtuacao' WHERE id = $id";
  mysqli_query($conn, $sql);

  // Redireciona para a página principal
  header('Location: listagem.php');
  exit;
}

// Obtém o ID do registro a ser atualizado
$id = $_GET['id'];

// Obtém os dados do registro a ser atualizado
$sql = "SELECT * FROM cadastro WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>