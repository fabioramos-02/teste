<?php
// Inclui o arquivo de configuração com a conexão ao banco de dados
require_once 'config.php';

// Array com os campos do formulário
$campos = [
    'nome', 'email', 'cpf', 'telefone', 'celular', 'orgaoEmissor', 'rg',
    'ufEmissor', 'ocupacaoPrincipal', 'ocupacaoSecundaria','capital', 'nomeFantasia',
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
if (isset($_POST['ocupacaoSecundaria'])) {
    $ocupacaoSecundaria = implode(',', $_POST['ocupacaoSecundaria']);
} else {
    $ocupacaoSecundaria = '';
}
foreach ($campos as $campo) {
    if (isset($_POST[$campo])) {
        $valor = $_POST[$campo];


         // Verifica se o valor é um array e o converte em string separada por vírgulas
         if (is_array($valor)) {
            $valor = implode(", ", $valor);
        } else {
            $valor = trim($valor);
        }
        // Verifica se o valor é um array e o converte em string separada por vírgulas
        if (is_array($valor)) {
            $valor = implode(", ", $valor);
        } else {
            $valor = trim($valor);
        }

        $valores[$campo] = $valor;
    } else {
        $valores[$campo] = '';
    }
}


// Adiciona o valor de forma de atuação e ocupação secundária ao array de valores
$valores['formaAtuacao'] = $formaAtuacao;
$valores['ocupacaoSecundaria'] = $ocupacaoSecundaria;

// Monta a query de inserção no banco de dados
$sql = "INSERT INTO cadastro (" . implode(',', $campos) . ") VALUES ('" . implode("', '", $valores) . "')";

// Executa a query no banco de dados
if ($conn->query($sql) === TRUE) {
    header("Location: formulario.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
