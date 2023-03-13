<?php
// Conecta ao banco de dados (substitua com suas próprias credenciais)
include_once("config.php");

// Verifica se o ID do registro foi passado como parâmetro
if (isset($_GET['id'])) {

    // Verifica se a conexão foi bem sucedida
    if (!$conn) {
        die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    // Obtém o ID do registro a ser excluído
    $id = $_GET['id'];

    // Cria uma query para buscar o registro com o ID especificado
    $query = "SELECT * FROM cadastro WHERE id = $id";

    // Executa a query
    $resultado = mysqli_query($conn, $query);

    // Verifica se a query foi bem sucedida
    if (!$resultado) {
        die('Erro ao buscar registro: ' . mysqli_error($conn));
    }

    // Verifica se o registro foi encontrado
    if (mysqli_num_rows($resultado) == 1) {
        // Se o registro existe, cria uma query DELETE para removê-lo
        $query = "DELETE FROM cadastro WHERE id = $id";

        // Executa a query
        $resultado = mysqli_query($conn, $query);

        // Verifica se a query foi bem sucedida
        if ($resultado) {
            // Se a query foi bem sucedida, redireciona de volta para a página de cadastro
            header('Location: listagem.php');
        } else {
            // Se houve um erro ao excluir o registro, exibe uma mensagem de erro
            echo 'Erro ao excluir registro: ' . mysqli_error($conn);
        }
    } else {
        // Se o registro não existe, exibe uma mensagem de erro
        echo 'Registro não encontrado.';
    }

    // Libera a memória usada pelo resultado da query
    mysqli_free_result($resultado);

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Se o ID do registro não foi especificado, redireciona de volta para a página de cadastro
    header('Location: listagem.php');
}
