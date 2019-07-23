<?php

use Sisfin\Util;

$sqlCategoria = 'SELECT * FROM tb_categoria_financeira';
$sqlSituacao = 'SELECT * FROM tb_situacao_financeira';
?>

<script>
    function goBack() {
        window.history.back();
    }
    function salvarNovaDespesa() {
        //validaForm();
        var dados = $('#formReceita').serialize();
        $.ajax({
            url: "ajax/ajax_despesa.php?acao=novaDespesa",
            type: 'post',
            data: dados,
            success: function (resposta) {
                console.log(resposta);
                $('#dados').html('<p>' + resposta + '</p>');
            },
            error: function (xhr, er) {
                $('#mensagem_erro').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er + '</p>')
            }
        });
    }

//    function validaForm() {
//        $("#formReceita").click(function () {
//            event.preventDefault();
//            var dados = $(this).serialize();
//            var campos = $(this).find('.required');
//
//            $(campos).each(function () {
//                for (i = 0; i = $(this).val() == ''; i++) {
//                    if ($(this).val() == '') {
//                        alert("Preencha os campos obrigatórios");
//                        $(this).focus();
//                        e.preventDefault();
//                    } else {
//                        $.ajax({
//                            type: "POST",
//                            url: "cadastrar.php",
//                            data: dados,
//                            success: function (data)
//                            {
//                                $("#status").slideDown();
//                                $("#status").html(data);
//                            }
//                        });
//                        $('#contact-form').trigger("reset");
//
//                    }
//                }
//            });
//        });
//    }
//    function validaForm() {
//        $('#txtDescricao').removeClass('is-invalid');
//        $('#txtRecebidoDe').removeClass('is-invalid');
//        $('#txtValor').removeClass('is-invalid');
//        $('#cmbCategoria').removeClass('is-invalid');
//        $('#cmbSituacao').removeClass('is-invalid');
//        if ($('#txtDescricao').val() === '') {
//            $('#txtDescricao').addClass('is-invalid');
//            return false;
//        }
//        if ($('#txtRecebidoDe').val() === '') {
//            $('#txtRecebidoDe').addClass('is-invalid');
//            return false;
//        }
//        if ($('#txtValor').val() === '') {
//            $('#txtValor').addClass('is-invalid');
//            return false;
//        }
//        if ($('#cmbCategoria').val() === '') {
//            $('#cmbCategoria').addClass('is-invalid');
//            return false;
//        }
//        if ($('#cmbSituacao').val() === '') {
//            $('#cmbSituacao').addClass('is-invalid');
//            return false;
//        }
//        return false;
//    }

</script>
<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Cadastrar Nova Despesa</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=despesas" class="btn btn-outline-primary btn-sm float-right" role="button" aria-disabled="true">Todas as Despesas</a>
    </div>
</div>
<form method="post" id="formReceita">
    <div class="row">
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input type="text" name="txtDescricao" class="form-control required" id="txtDescricao" placeholder="Descrição da Receita" onkeyup="validaForm();">
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtRecebidoDe">Recebido de</label>
                <input type="text" name="txtRecebidoDe" class="form-control required" id="txtRecebidoDe" placeholder="Recebido de" onkeyup="validaForm();">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="txtValor">Valor (R$)</label>
            <input type="text" name="txtValor" class="form-control money required" id="txtValor" placeholder="R$ 0,00" maxlength="11" onkeyup="validaForm();">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cmbCategoria">Categoria</label>
            <select id="cmbCategoria" name="cmbCategoria" class="form-control required" onclick="validaForm();">
                <option value="" selected>Selecione</option>
                <?php
                $query = $db->query($sqlCategoria);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    if ($value['id'] == $resultDespesa[0]['formas_pagamento_id']) {
                        echo "<option selected value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                    } else {
                        echo "<option value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="cmbSituacao">Situação</label>
            <select id="cmbSituacao" name="cmbSituacao" class="form-control required" onclick="validaForm();">
                <option value="" selected>Selecione</option>
                <?php
                $query = $db->query($sqlSituacao);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    if ($value['id'] == $resultDespesa[0]['formas_pagamento_id']) {
                        echo "<option selected value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                    } else {
                        echo "<option value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <hr>
    <button type="button" class="btn btn-outline-primary" onclick="salvarNovaDespesa();">Salvar</button>
    <button type="reset" class="btn btn-outline-secondary">Limpar</button>
    <input type='button' class="btn btn-outline-warning" value='Voltar' onclick='history.go(-1)' />
</form>
<div id="dados"></div>