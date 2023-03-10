<?php
// Inclui o arquivo de configuração com a conexão ao banco de dados
require_once 'config.php';

// Array com os campos do formulário
$campos = [
    'nome', 'email', 'cpf', 'telefone', 'celular', 'orgaoEmissor', 'rg',
    'ufEmissor', 'ocupacaoPrincipal', 'capital', 'nomeFantasia',
    'formaAtuacao', 'cep', 'rua', 'bairro', 'complemento', 'numero', 'cidade',
    'estado'
];

// Array que irá conter os valores a serem inseridos no banco de dados
$valores = [];

// Verifica se a forma de atuação foi selecionada e a converte em string
if (isset($_POST['formaAtuacao'])) {
    $formaAtuacao = implode(',', $_POST['formaAtuacao']);
} else {
    $formaAtuacao = '';
}

// Verifica se há ocupações secundárias selecionadas e as converte em string
if (isset($_POST['listBox2'])) {
    $ocupacaoSecundaria = implode(',', $_POST['listBox2']);
} else {
    $ocupacaoSecundaria = '';
}

// Percorre os campos do formulário e adiciona seus valores ao array de valores
foreach ($campos as $campo) {
    if (isset($_POST[$campo])) {
        // Verifica se o valor é um array e o converte em string separada por vírgulas
        if (is_array($_POST[$campo])) {
            $valores[$campo] = implode(", ", $_POST[$campo]);
        } else {
            $valores[$campo] = $_POST[$campo];
        }
    } else {
        $valores[$campo] = '';
    }
}

// Monta a string SQL para inserir os dados no banco de dados
$sql = "INSERT INTO cadastro (";
$sql .= implode(', ', $campos);
$sql .= ", ocupacaoSecundaria) VALUES ('";
$sql .= implode("', '", $valores);
$sql .= "', '$ocupacaoSecundaria')";

// Executa a query SQL
$resultado = mysqli_query($conn, $sql);

// Verifica se a query foi executada com sucesso e redireciona para a página de formulário
if ($resultado) {
    echo "Dados inseridos com sucesso!";
    header("Location: formulario.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>