<?php
include_once('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stilo.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>REGISTRO DO MEI</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />


    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.estado);

                                //Atualiza o select de estados
                                $("#estado option").filter(function() {
                                    return $(this).text() == dados.uf;
                                }).prop('selected', true);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
</head>

<body>

    <div class="EstH1 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
        <div class="container">

            <h1>REGISTRO DO MEI</h1>

        </div>
    </div>
    <div class="container">


        <div class="container container_interno">

            <div class="box">
                <div class="PgTextoLivre mb20">
                    <h4 style="text-align: center;"><span style="font-size: 22px; font-family: Arial;">Abra agora seu CNPJ MEI </span></h4>
                    <h4 style="text-align: center;"><span style="font-size: 22px;"><span style="font-family: Arial;">Aproveite todos os beneficios de ser um Empreendedor MEI</span></span></h4>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                </div>
                <form method="POST" id="formulario" action="processa_dados.php">
                    <div class="EstH3">
                        <fieldset>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">* Nome Completo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nome" id="nome" required data-input />
                                </div>
                            </div>

                            <br>
                            <br><br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">* Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " name="email" id="email" class="inputUser" required data-input />
                                </div>
                            </div>
                            <br>
                            <br><br>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">* CPF</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control CampoCPF" name="cpf" id="cpf" required data-input />
                                </div>

                                <label class="col-sm-1 control-label">Telefone</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control CampoTelefone1" id="telefone" name="telefone" />
                                </div>
                                <label class="col-sm-1 control-label">* Celular</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control CampoTelefone2" id="celular" name="celular" required data-input />
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">* RG</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="rg" name="rg" required data-input />
                                </div>
                                <label class="col-sm-1 control-label">* Órgão Emissor</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="orgaoEmissor" name="orgaoEmissor" maxlength="6" required data-input />
                                </div>
                                <label class="col-sm-1 control-label">* UF Emissor</label>
                                <div class="col-sm-3">
                                    <div class="dropdown bootstrap-select show-tick form-control">
                                        <select name="ufEmissor" class="form-select shadow-none" id="ufEmissor" required data-input>
                                            <option value="">Selecione...</option>
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
                            <br><br>
                        </fieldset>
                    </div>
                    <br>
                    <div class="EstH3">
                        <fieldset>
                            <h2>Dados para o CNPJ</h2>
                            <br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="control-label">*Ocupação Principal</label>

                                    <div class="dropdown bootstrap-select show-tick form-control">
                                        <select name="ocupacaoPrincipal" class="selectpicker form-select shadow-none " id="ocupacaoPrincipal" required data-input>
                                            <option value="">Selecione...</option>

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
                                </div>
                            </div>
                            <br><br><br><br><br>


                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label class="control-label">* Escolha a Ocupação Secundária (até 15 opções)</label>
                                    <div class="dropdown bootstrap-select show-tick form-control">
                                        <select name="listBox1" class="selectpicker form-select shadow-none " size="10" id="listBox1">
                                            <?php
                                            $resul_ocupacao = "SELECT * FROM tb_ocupacao";
                                            $resultado_ocupacoes = mysqli_query($conn, $resul_ocupacao);
                                            while ($row_ocupacaoS = mysqli_fetch_assoc($resultado_ocupacoes)) {
                                                echo '<option value="' . $row_ocupacaoS['ocupacao'] . '">' . $row_ocupacaoS['ocupacao'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2" id="botao">
                                    <button type="button" class="btn-style1" onclick="adicionar()">ADICIONAR</button>
                                    <button type="button" class="btn-style1" onclick="removerItem()">REMOVER</button>
                                    <button type="button" class="btn-style1" onclick="removerTudo()">REMOVER TUDO</button>

                                </div>

                                <div class="col-sm-5" id="listbox2">
                                    <div class="dropdown bootstrap-select show-tick form-control">
                                        <select id="listBox2" class="selectpicker form-select shadow-none " name="ocupacaoSecundaria[]" multiple size="10" >

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Código JavaScript -->
                            <script>
                                document.querySelector('#formulario').addEventListener('submit', function() {
                                    var listBox2 = document.getElementById('listBox2');
                                    for (var i = 0; i < listBox2.options.length; i++) {
                                        listBox2.options[i].selected = true;
                                    }
                                });

                                function removerItem() {
                                    var listBox2 = document.getElementById("listBox2");
                                    listBox2.remove(listBox2.selectedIndex);
                                }

                                function removerTudo() {
                                    var listBox1 = document.getElementById("listBox1");
                                    var listBox2 = document.getElementById("listBox2");
                                    while (listBox2.options.length > 0) {
                                        var newOption = document.createElement("option");
                                        newOption.value = listBox2.options[0].value;
                                        newOption.text = listBox2.options[0].text;
                                        listBox1.appendChild(newOption);
                                        listBox2.remove(0);
                                    }
                                }

                                function adicionar() {
                                    var listBox1 = document.getElementById("listBox1");
                                    var listBox2 = document.getElementById("listBox2");

                                    // Verificar se o número de opções no listBox2 é menor que 15
                                    if (listBox2.options.length >= 15) {
                                        alert("Você atingiu o limite máximo de 15 opções!");
                                        return; // Sair da função sem adicionar a opção selecionada
                                    }

                                    var selectedOptions = [];
                                    for (var i = 0; i < listBox1.options.length; i++) {
                                        if (listBox1.options[i].selected) {
                                            selectedOptions.push(listBox1.options[i]);
                                        }
                                    }

                                    // Adicionar as opções selecionadas no listBox2
                                    for (var i = 0; i < selectedOptions.length; i++) {
                                        var selectedOption = selectedOptions[i];

                                        // Verificar se a opção selecionada já foi adicionada anteriormente
                                        var options = listBox2.options;
                                        for (var j = 0; j < options.length; j++) {
                                            if (options[j].value === selectedOption.value) {
                                                alert("Essa opção já foi selecionada!");
                                                return; // Sair da função sem adicionar a opção selecionada
                                            }
                                        }

                                        var newOption = document.createElement("option");
                                        newOption.value = selectedOption.value;
                                        newOption.text = selectedOption.text;
                                        listBox2.appendChild(newOption);

                                        selectedOption.remove(); // Remover a opção selecionada do listBox1
                                    }
                                }
                            </script>


                            <br><br><br><br><br><br><br><br>

                            <br><br><br><br><br><br><br><br>
                            <br><br><br>



                            <div class="form-group">
                                <label class="col-sm-2 control-label">* Capital Social</label>
                                <div class="col-sm-3">
                                    <div class="dropdown bootstrap-select show-tick form-control">
                                        <select name="capital" class="form-select shadow-none" id="capital" required data-input>
                                            <option value="" selected>Selecione...</option>
                                            <option value="R$ 1.000,00">R$ 1.000,00</option>
                                            <option value="R$ 2.000,00">R$ 2.000,00</option>
                                            <option value="R$ 3.000,00">R$ 3.000,00</option>
                                            <option value="R$ 5.000,00">R$ 5.000,00</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">* Nome Fantasia no CNPJ MEI</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nomeFantasia" value="" id="nome-fantasia" />
                                </div>
                            </div>
                            <br><br><br><br>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">* Forma de Atuação</label>
                                <div class="col-sm-10">
                                    <div class="checkbox" required data-input>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="estabelecimento-fixo" value="Estabelecimento fixo">
                                            Estabelecimento fixo
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="internet" value="Internet">
                                            Internet
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="local-fixo-fora-loja" value="Em local fixo fora da loja">
                                            Em local fixo fora da loja
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="correio" value="Correio">
                                            Correio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="porta-a-porta" value="Porta a porta">
                                            Porta a porta
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="postos-moveis" value="Postos móveis ou por ambulantes">
                                            Postos móveis ou por ambulantes
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="televenda" value="Televenda">
                                            Televenda
                                        </label>
                                        <label class="bloco">
                                            <input type="checkbox" name="formaAtuacao[]" id="maquinas-automaticas" value="Máquinas automáticas">
                                            Máquinas automáticas
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="EstH3">
                        <fieldset>
                            <form method="get" action=".">

                                <h2>Endereço do CNPJ</h2>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="control-label">* CEP</label>
                                        <input type="text" class="form-control shadow-none" id="cep" name="cep" value="" size="10" maxlength="8" required />
                                    </div>
                                    <div class="col-sm-9">
                                        <label class="control-label">* Rua</label>
                                        <input type="text" class="form-control shadow-none" id="rua" name="rua" required data-input />
                                    </div>


                                </div>
                                <br><br><br><br>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label class="control-label">Bairro</label>
                                        <input type="text" class="form-control shadow-none" id="bairro" name="bairro" required data-input />
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="control-label">Complemento</label>
                                        <input type="text" class="form-control shadow-none" id="complemento" name="complemento" data-input />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label">Número</label>
                                        <input type="text" class="form-control shadow-none" id="numero" name="numero" required data-input />
                                    </div>
                                </div>
                                <br><br><br><br>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="control-label">Cidade</label>
                                        <input type="text" class="form-control shadow-none" id="cidade" name="cidade" required data-input />
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="control-label">Estado</label>
                                        <div class="dropdown bootstrap-select show-tick form-control">
                                            <select name="estado" class="form-select shadow-none" id="estado" required data-input>
                                                <option value="">Selecione...</option>
                                                <?php
                                                $resul_estados = "SELECT * FROM tb_estados";
                                                $resultado_estados = mysqli_query($conn, $resul_estados);
                                                while ($row_estados = mysqli_fetch_assoc($resultado_estados)) { ?>
                                                    <option value="<?php echo $row_estados['nome'];  ?>"> <?php echo $row_estados['nome']; ?>
                                                    </option> <?php
                                                            }
                                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                        </fieldset>
                    </div>
                    <div class="text-center mt10">
                        <input type="submit" class="btn-style1" id="submit" value="ENVIAR">

                    </div>
                </form>
            </div>

            <br>

            <br>
        </div>
    </div>
</body>
<script type="text/javascript" src="bootstrap.min.js"></script>

</html>