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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Lista de Cadastros</title>
    <link rel="stylesheet" href="./css/stiloListagem.css">

</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


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
<style>
    .table .table-striped .table-dark .table-hover {
        font-size: 28px;
    }
</style>

<body>
    <div class="EstH1">
        <div class="container">

            <h1>LISTAGEM DE REGISTRO MEI</h1>

        </div>
    </div>


    <div class="container-fluid mt-4 container-pai">

        <div class="row">

            <div class="col-md-2 mb-3 ml-auto">
                <input type="text" class="form-control pesquisar" id="pesquisa" placeholder="Pesquisar pelo nome">
                <i></i>
            </div>
        </div>

        <?php
        // Inclui o arquivo de configuração com a conexão ao banco de dados
        require_once 'config.php';

        // Define o número máximo de resultados por página
        $resultados_por_pagina = 15;

        // Obtém o número da página atual a partir da URL
        $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

        // Calcula o deslocamento para a consulta SQL com base na página atual e no número máximo de resultados por página
        $offset = ($pagina_atual - 1) * $resultados_por_pagina;

        // Monta a string SQL para selecionar os cadastros com base no deslocamento e no número máximo de resultados por página
        $sql = "SELECT * FROM cadastro LIMIT $offset, $resultados_por_pagina";

        // Executa a query SQL
        $resultado = mysqli_query($conn, $sql);

        // Obtém o número total de resultados da consulta SQL
        $total_resultados = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cadastro"));

        // Calcula o número total de páginas com base no número total de resultados e no número máximo de resultados por página
        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

        ?>

        <span id="msgAlerta"></span>
        <table id="tabela" class="table table-striped  table-dark table-hover">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Nome</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">CPF</th>
                    <th class="text-center" scope="col">Celular</th>
                    <th class="text-center" scope="col">Ocupação Principal</th>
                    <th class="text-center" scope="col">Capital</th>
                    <th class="text-center" scope="col">Nome Fantasia</th>
                    <th class="text-center" scope="col">Endereço</th>
                    <th class="text-center" scope="col" class="text-center" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody id="tabela-cadastros">
                <?php
                // Loop para exibir os resultados da query
                while ($row = mysqli_fetch_assoc($resultado)) {
                    // Converte a string de ocupações secundárias em um array
                    $ocupacoes_secundarias = explode(',', $row['listBox2']);
                   
                    if ($row['formaAtuacao']) {
                        $formasAtuacao = explode(',', $row['formaAtuacao']);
                    } else {
                        $formasAtuacao = array();
                    }

                ?>
                    <tr>
                        <td scope="row"><?php echo $row['nome']; ?></td>
                        <td scope="row"><?php echo $row['email']; ?></td>
                        <td scope="row"> <?php echo $row['cpf']; ?></td>
                        <td scope="row"><?php echo $row['celular']; ?></td>
                        <td scope="row"><?php echo $row['ocupacaoPrincipal']; ?></td>
                        <td scope="row"><?php echo $row['capital']; ?></td>
                        <td class="text-center" scope="row"><?php echo $row['nomeFantasia']; ?></td>
                        <td scope="row"><?php echo "{$row['rua']} {$row['numero']}, {$row['bairro']} - {$row['cidade']}"; ?></td>
                        <td scope="row" class=" text-center table-secondary">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-visualizar-<?php echo $row['id']; ?>">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </span>
                            </button>

                        </td>

                        <td class="text-center table-dark">
                            <button class="btn btn-danger" onclick="excluirCadastro(<?php echo $row['id']; ?>)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>

                    </tr>

                    <!-- modal para alteração de dados -->
                    <div class="modal fade" id="modal-visualizar-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-visualizar-label-<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="modal-visualizar-label-<?php echo $row['id']; ?>"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                        <div class="col-md-12 titulo">
                                            <div class="form-group">
                                                <label for="celular" class="titulo">Dados Pessoais</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nome">Nome:</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="celular">Celular:</label>
                                                    <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $row['celular']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="celular">Telefone:</label>
                                                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cpf">CPF:</label>
                                                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="rg">RG:</label>
                                                    <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $row['rg']; ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="orgaoEmissor">Orgão Emissor:</label>
                                                    <input type="text" class="form-control" id="orgaoEmissor" name="orgaoEmissor" value="<?php echo $row['orgaoEmissor']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ufEmissor">UF Emissor</label>
                                                    <select class="selects" name="ufEmissor" id="ufEmissor" required data-input>
                                                        <option value="<?php echo $row['ufEmissor']; ?>"><?php echo $row['ufEmissor']; ?></option>
                                                        <?php
                                                        $resul_estado = "SELECT * FROM tb_estados";
                                                        $resultado_estado = mysqli_query($conn, $resul_estado);
                                                        while ($row_estado = mysqli_fetch_assoc($resultado_estado)) { ?>
                                                            <option value="<?php echo $row_estado['nome'];  ?>"> <?php echo $row_estado['nome']; ?>
                                                            </option> <?php
                                                                    }
                                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 titulo">
                                            <div class="form-group">
                                                <label for="celular" class="titulo">Dados do CNPJ</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ocupacaoPrincipal">Ocupação Principal:</label>
                                            <select name="ocupacaoPrincipal" class="selects" id="ocupacaoPrincipal" required data-input>
                                                <option value="<?php echo $row['ocupacaoPrincipal']; ?>"><?php echo $row['ocupacaoPrincipal']; ?></option>
                                                <?php
                                                $resul_ocupacao = "SELECT * FROM tb_ocupacao";
                                                $resultado_ocupacao = mysqli_query($conn, $resul_ocupacao);
                                                while ($row_ocupacaoP = mysqli_fetch_assoc($resultado_ocupacao)) { ?>
                                                    <option value="<?php echo $row_ocupacaoP['ocupacao'];  ?>"> <?php echo $row_ocupacaoP['ocupacao']; ?>
                                                    </option> <?php
                                                            }
                                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="listBox2">Ocupação Secundaria:</label>
                                            <select name="listBox2" class="selects" id="listBox2" name="listBox2[]" size="10" required data-input>

                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="nomeFantasia">Nome Fantasia:</label>
                                                    <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" value="<?php echo $row['nomeFantasia']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="capital">Capital:</label>
                                                    <select name="capital" class="selects" id="capital" required data-input>
                                                        <option value="<?php echo $row['capital']; ?>"><?php echo $row['capital']; ?></option>
                                                        <option value="R$ 1.000,00">R$ 1.000,00</option>
                                                        <option value="R$ 2.000,00">R$ 2.000,00</option>
                                                        <option value="R$ 3.000,00">R$ 3.000,00</option>
                                                        <option value="R$ 5.000,00">R$ 5.000,00</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="formaAtuacao">Forma de Atuação:</label>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-check">

                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Estabelecimento fixo" <?php if (in_array('Estabelecimento fixo', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Estabelecimento fixo
                                                        </label>
                                                    </div>
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Correio" <?php if (in_array('Correio', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Correio
                                                        </label>
                                                    </div>
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Máquinas automáticas" <?php if (in_array('Máquinas automáticas', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Máquinas automáticas
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Internet" <?php if (in_array('Internet', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Internet
                                                        </label>
                                                    </div>

                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Postos móveis ou por ambulantes" <?php if (in_array('Postos móveis ou por ambulantes', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Postos móveis ou por ambulantes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value="Em local fixo fora da loja" <?php if (in_array('Em local fixo fora da loja', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Em local fixo fora da loja
                                                        </label>
                                                    </div>
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value=" Porta a porta" <?php if (in_array(' Porta a porta', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Porta a porta
                                                        </label>
                                                    </div>
                                                    <div class="form-check espacoBox">
                                                        <input class="form-check-input" name="formaAtuacao[]" type="checkbox" value=" Televenda" <?php if (in_array(' Televenda', $formasAtuacao)) echo 'checked'; ?>>
                                                        <label class="form-check-label">
                                                            Televenda
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="espaco">
                                            <div class="col-md-12 titulo">
                                                <div class="form-group">
                                                    <label for="Endereço" class="titulo">Endereço</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cep">CEP:</label>
                                                    <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $row['cep']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="rua">Rua:</label>
                                                    <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $row['rua']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="numero">Número:</label>
                                                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $row['numero']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="complemento">Complemento:</label>
                                                    <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $row['complemento']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bairro">Bairro:</label>
                                                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row['bairro']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cidade">Cidade:</label>
                                                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row['cidade']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="estado">Estado</label>
                                                    <select class="selects" name="estado" id="estado" required data-input>
                                                        <option value="<?php echo $row['estado']; ?>"><?php echo $row['estado']; ?></option>
                                                        <?php
                                                        $resul_estado = "SELECT * FROM tb_estados";
                                                        $resultado_estado = mysqli_query($conn, $resul_estado);
                                                        while ($row_estado = mysqli_fetch_assoc($resultado_estado)) { ?>
                                                            <option value="<?php echo $row_estado['nome'];  ?>"> <?php echo $row_estado['nome']; ?>
                                                            </option> <?php
                                                                    }
                                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="botao btn btn-danger" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal de Exclusão -->
                    <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="modal-excluir-titulo" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-excluir-titulo">Confirmar exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Você tem certeza que deseja excluir este cadastro?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="botao  btn btn-primary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="botao  btn btn-danger" id="btn-excluir">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                // Libera a memória usada pelo resultado da query
                mysqli_free_result($resultado);

                // Fecha a conexão com o banco de dados
                mysqli_close($conn);
                ?>

            </tbody>
        </table>

        <!-- Adicione esta linha abaixo da tabela de resultados -->
        <nav aria-label="Navegação de página">
            <ul class="pagination">
                <?php
                // Loop para exibir os números das páginas e seus respectivos links
                for ($pagina = 1; $pagina <= $total_paginas; $pagina++) {
                    // Cria o link para a página de resultados correspondente
                    $link = "listagem.php?pagina=" . $pagina;
                    // Adiciona a classe "active" para a página atual
                    $classe_ativa = ($pagina == $pagina_atual) ? "active" : "";
                    // Exibe o número da página e o link correspondente
                    echo "<li class='page-item $classe_ativa'><a class='page-link' href='$link'>$pagina</a></li>";
                }
                ?>
            </ul>
        </nav>

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





        function excluirCadastro(id) {
            // Armazena o ID do cadastro a ser excluído em uma variável
            var cadastroId = id;

            // Abre o modal de confirmação
            $('#modal-excluir').modal('show');

            // Associa a função de exclusão ao botão "Excluir" do modal
            $('#btn-excluir').click(function() {
                // Redireciona para a página de exclusão
                window.location.href = 'excluir.php?id=' + cadastroId;
            });
        }
    </script>


</body>

</html>