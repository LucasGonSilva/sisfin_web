<?php
if ($_GET['acao'] && $_GET['acao'] == 'editar') {
    $sql = $db->query("SELECT * FROM tb_despesa WHERE id = " . $_GET['id']);
    $resultDespesa = $sql->fetchAll(PDO::FETCH_ASSOC);
    $_POST['id'] = $_GET['id'];
    $acao = "editar";
}

use Sisfin\Util;

$sqlCategoria = 'SELECT * FROM tb_categoria_financeira';
$sqlSituacao = 'SELECT * FROM tb_situacao_financeira';
?>

<script>
    function goBack() {
        window.history.back();
    }
    function salvarNovaDespesa() {
        var dados = $('#formReceita').serialize();
        $.ajax({
            url: "ajax/ajax_despesa.php?acao=despesa_crud",
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
    function validaForm() {
        if ($('#txtDescricao').val() === '') {
            alert("Campo Descrição obrigatório.")
            $('#txtDescricao').focus();
            return false;
        }
        if ($('#txtPagoA').val() === '') {
            alert("Campo Pago a obrigatório.")
            $('#txtPagoA').focus();
            return false;
        }
        if ($('#txtValor').val() === '' || $('#txtValor').val() === '0,00') {
            alert("Campo Valor obrigatório.");
            $('#txtValor').val('');
            $('#txtValor').focus();
            return false;
        }
        if ($('#cmbCategoria').val() === '') {
            alert("Campo Categoria de obrigatório.")
            $('#cmbCategoria').focus();
            return false;
        }
        if ($('#cmbSituacao').val() === '') {
            alert("Campo Situação obrigatório.")
            $('#cmbSituacao').focus();
            return false;
        }
        salvarNovaDespesa();
    }
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
                <input type="text" name="txtDescricao" class="form-control required" id="txtDescricao" placeholder="Descrição da Receita" value="<?= $resultDespesa['descricao'] ?>">
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtPagoA">Pago a</label>
                <input type="text" name="txtPagoA" class="form-control required" id="txtPagoA" placeholder="Pago a" value="<?= $resultDespesa['pago_a'] ?>">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="txtValor">Valor (R$)</label>
            <input type="text" name="txtValor" class="form-control money required" id="txtValor" placeholder="R$ 0,00" maxlength="11" value="<?= number_format($resultDespesa[0]['valor'], 2, ',', '.') ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cmbCategoria">Categoria</label>
            <select id="cmbCategoria" name="cmbCategoria" class="form-control required">
                <option value="" selected>Selecione</option>
                <?php
                $query = $db->query($sqlCategoria);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    if ($value['id'] == $resultDespesa[0]['id_categoria']) {
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
            <select id="cmbSituacao" name="cmbSituacao" class="form-control required">
                <option value="" selected>Selecione</option>
                <?php
                $query = $db->query($sqlSituacao);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    if ($value['id'] == $resultDespesa[0]['id_situacao']) {
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
    <button type="button" class="btn btn-outline-primary" onclick="validaForm();">Salvar</button>
    <button type="reset" class="btn btn-outline-secondary">Limpar</button>
    <input type='button' class="btn btn-outline-warning" value='Voltar' onclick='history.go(-1)' />
</form>
<div id="dados"></div>