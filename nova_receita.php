<?php

use Sisfin\Util;

$sqlCategoria = 'SELECT * FROM tb_categoria_financeira';
$sqlSituacao = 'SELECT * FROM tb_situacao_financeira';
?>
<script type="text/javascript" src="js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script>

    function salvarNovaReceita() {
        $.ajax({
            url: "ajax/ajax_receita.php",
            type: 'post',
            data: {
                nome: "Maria Fernanda",
                salario: '3500'
            },
            beforeSend: function () {
                $("#resultado").html("ENVIANDO...");
            }
        })
                .done(function (msg) {
                    $("#resultado").html(msg);
                })
                .fail(function (jqXHR, textStatus, msg) {
                    alert(msg);
                });
    }

</script>
<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Cadastrar Nova Receita</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=receitas" class="btn btn-outline-primary btn-sm float-right" role="button" aria-disabled="true">Todas as Receitas</a>
    </div>
</div>
<form method="post">
    <div class="row">
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input type="text" name="txtDescricao" class="form-control" id="txtDescricao" placeholder="Descrição da Receita">
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtRecebidoDe">Recebido de</label>
                <input type="text" name="txtRecebidoDe" class="form-control" id="txtRecebidoDe" placeholder="Recebido de">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="txtValor">Valor (R$)</label>
            <input type="text" name="txtValor" class="form-control money" id="txtValor" placeholder="R$ 0,00" maxlength="11">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="cmbCategoria">Categoria</label>
            <select id="cmbCategoria" name="cmbCategoria" class="form-control">
                <option selected>Selecione</option>
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
            <select id="cmbSituacao" name="cmbSituacao" class="form-control">
                <option selected>Selecione</option>
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
        <div class="form-group col-md-4">
            <label for="txtData">Data</label>
            <input type="text" disabled="" name="txtData" class="form-control" id="txtData" value="<?= Util::FormataBancoData(date("Y-m-d")); ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-outline-primary">Salvar</button>
    <button type="reset" class="btn btn-outline-secondary">Limpar</button>
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtDescricao').val("<?= $_POST['txtDescricao'] ?>");
        $('#txtRecebidoDe').val("<?= $_POST['txtRecebidoDe'] ?>");
        $('#txtValor').val("<?= $_POST['txtValor'] ?>");
        $('#cmbCategoria').val("<?= $_POST['cmbCategoria'] ?>");
        $('#cmbSituacao').val("<?= $_POST['cmbSituacao'] ?>");
        $('#txtData').val("<?= $_POST['txtData'] ?>");
    </script>
    <?php
    try {
        //Salva no banco
        Util::converteMoedaBanco($_POST['txtValor']);
        $created = Util::FormataDataBanco($_POST['txtData']);
        var_dump($_POST);
        die;
        if (empty($_POST['hdnID'])) {
            $sql = "INSERT INTO tb_receita(
                                    descricao,
                                    recebido_de,
                                    valor,
                                    id_categoria,
                                    id_situacao,
                                    created)
                                  VALUES ('{$_POST['txtDescricao']}',
                                    '{$_POST['txtRecebidoDe']}',
                                    '{$_POST['txtValor']}',
                                    '{$_POST['cmbCategoria']}',
                                     {$_POST['cmbSituacao']},
                                    '{$created}')";
        } else {
            $acao = $_GET['acao'];
            $sql = "UPDATE user SET
                                        nome =  '{$_POST['txtNome']}',
                                        cpf =  '{$cpf}',
                                        email =  '{$_POST['txtEmail']}',
                                        id_perfil = {$_POST['cmbPerfil']}
                                        WHERE id = {$_POST['hdnID']}";
        }
        $execute = $db->prepare($sql);
        if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
            if ($execute->execute()) {
                echo '<br/><div class="alert alert-success" role="alert"><b>Usuário atualizado com sucesso!</b><br/><script>window.location="?pg=c_list_usuario";</script></div>';
            } else {
                throw new Exception("Não foi possivel cadastrar o arquivo importado.");
            }
        } else {
            if ($execute->execute()) {
                echo '<br/><div class="alert alert-success" role="alert"><b>Usuário cadastrado com sucesso!</b><br/><script>window.location="?pg=c_list_usuario";</script></div>';
            } else {
                throw new Exception("Não foi possivel cadastrar o arquivo importado.");
            }
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>Não foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>