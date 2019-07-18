<?php

use Sisfin\Util;
?>
<script>
    function verificaDescricao() {
        var descricao = $('#txtDescricao').val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: 'ajax/ajax_financeiro.php?acao=verificaDescricaoSituacao',
            data: {
                descricao: descricao
            },
            success: function (resposta) {
                $('#txtDescricao').removeClass('is-invalid');
                $('#txtDescricao').removeClass('is-valid');
                if (resposta == 'is-valid') {
                    $('#txtDescricao').removeClass('is-invalid');
                    $('#txtDescricao').addClass('is-valid');
                } else if (resposta == 'is-invalid') {
                    $('#txtDescricao').removeClass('is-valid');
                    $('#txtDescricao').addClass('is-invalid');
                }
                console.log(resposta);
            },
            error: function (erro) {
                alert('Não foi possivel realizar a operação');
                console.log(erro);
            }
        });
    }
    function validaForm() {
        if ($("#txtDescricao").val() === '') {
            alert("Campo descrição obrigatorio.");
            return false;
        }
    }
</script>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Nova Situação Financeira</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=situacao_financeira" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Lista de Situações</a>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" class="form-group">
    <div class="row">
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input class="form-control input-input-lg" type="text" name="txtDescricao" required="required" id="txtDescricao" onkeyup="verificaDescricao()">
                <div class="invalid-feedback">
                    Descrição já cadastrada!
                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtCreated">Data de Criação</label>
                <input class="form-control input-input-lg" disabled="" type="text" name="txtCreated" required="required" id="txtCreated" value="<?= Util::FormataBancoData(date("Y-m-d")) ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 center-block">
            <input type="submit" value="Salvar" class="btn btn-primary center-block"> 
        </div>
    </div>
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtDescricao').val("<?= $_POST['txtDescricao'] ?>");
        $('#txtCreated').val("<?= $_POST['txtCreated'] ?>");
    </script>
    <?php
    try {
        //Salva no banco
        $dt_created = date("Y-m-d");
        $sql = "INSERT INTO tb_situacao_financeira(
                                    descricao,
                                    created
                                )
                                  VALUES ('{$_POST['txtDescricao']}',
                                    '{$dt_created}')";
        $insert = $db->prepare($sql);
        $insert->execute();

        echo "<br/><div class='alert alert-success' role='alert'><b>Registro salvo com sucesso!</b><br /><script>window.location='?pg=situacao_financeira';</script></div>";
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>Não foi possível salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>