<?php

use Sisfin\Util;

if (isset($_GET['id'])) {
    $query = $db->query("SELECT * FROM tb_situacao_financeira WHERE id = {$_GET['id']}");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $result = null;
}
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Editar Situação Financeira</h1>
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
                <input type="hidden" name="hdnID" id="hdnID" value="<?= $result[0]['id'] ?>">
                <input class="form-control input-input-lg" type="text" name="txtDescricao" required="required" id="txtDescricao" value="<?= $result[0]['descricao'] ?>">
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtCreated">Data de Cadastro</label>
                <input type="hidden" name="hdnID" id="hdnID" value="<?= $result[0]['id'] ?>">
                <input class="form-control input-input-lg" disabled type="text" name="txtCreated" required="required" id="txtCreated" value="<?= Util::FormataBancoData($result[0]['created']) ?>">
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
        $dt_modified = date("Y-m-d");
        $sql = "UPDATE tb_situacao_financeira SET
                                        descricao =  '{$_POST['txtDescricao']}',
                                        modified = '{$dt_modified}'
                                        WHERE id = {$_POST['hdnID']}";
        $insert = $db->prepare($sql);
        $insert->execute();

        echo "<br/><div class='alert alert-success' role='alert'><b>Registro salvo com sucesso!</b><br /><script>window.location='?pg=situacao_financeira';</script></div>";
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>NÃ£o foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>