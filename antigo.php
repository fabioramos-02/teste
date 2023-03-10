<?php
include_once('config.php');

if (isset($_POST['formaAtuacao'])) {
    $formaAtuacao = implode(',', $_POST['formaAtuacao']);
  } else {
    $formaAtuacao = '';
  }
$campos = ['nome', 'email', 'cpf', 'telefone', 'celular', 'orgaoEmissor', 'rg', 'ufEmissor', 'ocupacaoPrincipal', 'ocupacaoSecundaria', 'capital', 'nomeFantasia', 'formaAtuacao', 'cep', 'rua', 'bairro', 'complemento', 'numero', 'cidade', 'estado'];
$valores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se a variável listBox2 foi definida
    if (isset($_POST['listBox2'])) {
        // Junta os valores selecionados em uma string separada por vírgulas
        $ocupacaoSecundaria = implode(',', $_POST['listBox2']);
    }
}

foreach ($campos as $campo) {
    if (isset($_POST[$campo])) {
        if (is_array($_POST[$campo])) {
            $valores[$campo] = implode(", ", $_POST[$campo]);
        } else {
            $valores[$campo] = $_POST[$campo];
        }
    } else {
        $valores[$campo] = '';
    }
}
$sql = "INSERT INTO cadastro (";
$sql .= implode(', ', $campos);
$sql .= ") VALUES ('";
$sql .= implode("', '", $valores);
$sql .= "')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Dados inseridos com sucesso!";
    header("Location: formulario.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
