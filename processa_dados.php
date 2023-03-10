<?php
include_once 'config.php';

// Define as variáveis e atribui a elas valores padrão
$campos = array(
    'nome' => '',
    'email' => '',
    'cpf' => '',
    'telefone' => '',
    'celular' => '',
    'rg' => '',
    'orgaoEmissor' => '',
    'ufEmissor' => '',
    'ocupacaoPrincipal' => '',
    'ocupacaoSecundaria' => '',
    'capital' => '',
    'nomeFantasia' => '',
    'formaAtuacao' => '',
    'cep' => '',
    'rua' => '',
    'bairro' => '',
    'complemento' => '',
    'numero' => '',
    'cidade' => '',
    'estado' => ''
);

// Define as variáveis com os valores do formulário
foreach ($campos as $campo => $valorPadrao) {
    $campos[$campo] = isset($_POST[$campo]) ? $_POST[$campo] : '';
}

// Transforma os valores das caixas de seleção em uma string separada por vírgula
foreach (array('ocupacaoSecundaria', 'formaAtuacao') as $campoSelecao) {
    $campos[$campoSelecao] = is_array($campos[$campoSelecao]) ? implode(",", $campos[$campoSelecao]) : '';
}

// Insere os dados no banco de dados
$query = "INSERT INTO cadastro (";
$query .= implode(",", array_keys($campos));
$query .= ") VALUES ('";
$query .= implode("','", array_values($campos));
$query .= "')";

if (mysqli_query($conn, $query)) {
    echo "Dados inseridos com sucesso!";
    header("Location: formulario.php", true, 302);
    exit;
} else {
    echo "Erro ao inserir dados: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?> 