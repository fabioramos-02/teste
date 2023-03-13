<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Lista de Cadastros</title>
</head>

<!-- Link para o jQuery e o JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Ao digitar na barra de pesquisa
        $("#pesquisa").on("keyup", function() {
            var value = $(this).val().toLowerCase(); // Obtém o valor da pesquisa em minúsculas
            $("#tabela tr").filter(function() { // Filtra as linhas da tabela
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1); // Exibe ou esconde as linhas que correspondem à pesquisa
            });
        });
    });
</script>

<body>
   
    <div class="container-fluid mt-4">
        <h1 class="text-center">Lista de Cadastros</h1>

        <div class="row">
            <div class="col-md-2 mb-3 ml-auto">
                <input type="text" class="form-control" id="pesquisa" placeholder="Pesquisar pelo nome">
                <i></i>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Orgão Emissor</th>
                    <th>RG</th>
                    <th>UF Emissor</th>
                    <th>Ocupação Principal</th>
                    <th>Capital</th>
                    <th>Nome Fantasia</th>
                    <th>Forma de Atuação</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Complemento</th>
                    <th>Número</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ocupações Secundárias</th>
                </tr>
            </thead>
            <tbody id="tabela-cadastros">
                <?php
                // Inclui o arquivo de configuração com a conexão ao banco de dados
                require_once 'config.php';

                // Monta a string SQL para selecionar todos os cadastros
                $sql = "SELECT * FROM cadastro";

                // Executa a query SQL
                $resultado = mysqli_query($conn, $sql);

                // Loop para exibir os resultados da query
                while ($row = mysqli_fetch_assoc($resultado)) {
                    // Converte a string de ocupações secundárias em um array
                    $ocupacoes_secundarias = explode(',', $row['listBox2']);
                ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['cpf']; ?></td>
                        <td><?php echo $row['telefone']; ?></td>
                        <td><?php echo $row['celular']; ?></td>
                        <td><?php echo $row['orgaoEmissor']; ?></td>
                        <td><?php echo $row['rg']; ?></td>
                        <td><?php echo $row['ufEmissor']; ?></td>
                        <td><?php echo $row['ocupacaoPrincipal']; ?></td>
                        <td><?php echo $row['capital']; ?></td>
                        <td><?php echo $row['nomeFantasia']; ?></td>
                        <td><?php echo $row['formaAtuacao']; ?></td>
                        <td><?php echo $row['cep']; ?></td>
                        <td><?php echo $row['rua']; ?></td>
                        <td><?php echo $row['bairro']; ?></td>
                        <td><?php echo $row['complemento']; ?></td>
                        <td><?php echo $row['numero']; ?></td>
                        <td><?php echo $row['cidade']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td><?php echo implode(", ", $ocupacoes_secundarias); ?></td>
                    </tr>
                <?php
                }
                // Libera a memória usada pelo resultado da query
                mysqli_free_result($resultado);

                // Fecha a conexão com o banco de dados
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $("#pesquisa").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).find("td:first").text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


</body>

</html>