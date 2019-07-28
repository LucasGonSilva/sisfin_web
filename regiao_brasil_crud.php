<?php
if ($_GET['acao'] && $_GET['acao'] == 'editar') {
    $sql = $db->query("SELECT * FROM tb_regioes WHERE id = " . $_GET['id']);
    $resultRegiao = $sql->fetch(PDO::FETCH_ASSOC);
    $_POST['id'] = $_GET['id'];
    $acao = "editar";
    $btn = 'Editar';
} elseif ($_GET['acao'] != 'editar') {
    $btn = 'Salvar';
}

use Sisfin\Util;
?>
<script>
    function verificaDescricao() {
        var descricao = $('#txtDescricao').val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: 'ajax/ajax_usuario.php?acao=verificaDescricao',
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
        <h4 class="align-middle">Região do Brasil</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=list_regiao_brasil" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Lista de Regiões</a>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" class="form-group">
    <div class="row">
        <div class="col col-lg-4">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input class="form-control input-input-lg" type="text" name="txtDescricao" required="required" id="txtDescricao" value="<?= $resultRegiao['descricao']; ?>" onkeyup="verificaDescricao()">
                <div class="invalid-feedback">
                    Estado já cadastrado!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 center-block">
            <input type="submit" value="<?= $btn ?>" class="btn btn-primary center-block"> 
        </div>
    </div>
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtDescricao').val("<?= $_POST['txtDescricao'] ?>");
    </script>
    <?php
    try {
        //Salva no banco
        $date = date('Y-m-d');
        $sql = "INSERT INTO tb_regioes(
                                    descricao,
                                    created
                                )
                                  VALUES (
                                            '{$_POST['txtDescricao']}',
                                            '{$date}')";
        $insert = $db->prepare($sql);
        $insert->execute();

        echo "<br/><div class='alert alert-success' role='alert'><b>Registro salvo com sucesso!</b><br /><script>window.location='?pg=list_regiao_brasil';</script></div>";
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>Não foi possível salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>