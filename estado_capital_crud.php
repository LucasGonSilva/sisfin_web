<?php
if ($_GET['acao'] && $_GET['acao'] == 'editar') {
    $sql = $db->query("SELECT * FROM tb_estado_capital WHERE id = " . $_GET['id']);
    $resultEstado = $sql->fetch(PDO::FETCH_ASSOC);
    $_POST['id'] = $_GET['id'];
    $acao = "editar";
    $btn = 'Editar';
} elseif ($_GET['acao'] != 'editar') {
    $btn = 'Salvar';
}
$sqlRegiao = "SELECT * FROM tb_regioes ORDER BY descricao";

use Sisfin\Util;
?>
<script>
    function goBack() {
        window.history.back();
    }
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
        <h4 class="align-middle">Estados / Capital</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=list_estado_capital" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Lista de Estado / Capital</a>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" class="form-group">
    <div class="row">
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtEstado">Estado</label>
                <input class="form-control input-input-lg" type="text" name="txtEstado" required="required" id="txtEstado" value="<?= $resultEstado['estado']; ?>" onkeyup="verificaDescricao()">
                <div class="invalid-feedback">
                    Estado já cadastrado!
                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtCapital">Capital</label>
                <input class="form-control input-input-lg" type="text" name="txtCapital" required="required" id="txtCapital" value="<?= $resultEstado['capital']; ?>" onkeyup="verificaDescricao()">
                <div class="invalid-feedback">
                    Capital já cadastrada!
                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="txtUF">UF</label>
                <input class="form-control input-input-lg" type="text" name="txtUF" required="required" id="txtUF" value="<?= $resultEstado['uf']; ?>" onkeyup="verificaDescricao()">
                <div class="invalid-feedback">
                    UF já cadastrada!
                </div>
            </div>
        </div>
        <div class="col col-lg-6">
            <div class="form-group">
                <label for="cmbRegiao">Região</label>
                <select id="cmbRegiao" name="cmbRegiao" class="form-control required">
                    <option value="" selected>Selecione</option>
                    <?php
                    $query = $db->query($sqlRegiao);
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $value) {
                        if ($value['id'] == $resultEstado['id_regiao']) {
                            echo "<option selected value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                        } else {
                            echo "<option value=\"{$value["id"]}\">{$value["descricao"]}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-outline-primary"><?= $btn ?></button>
    <button type="reset" class="btn btn-outline-secondary">Limpar</button>
    <input type='button' class="btn btn-outline-warning" value='Voltar' onclick='history.go(-1)' />
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtEstado').val("<?= $_POST['txtEstado'] ?>");
        $('#txtCapital').val("<?= $_POST['txtCapital'] ?>");
        $('#txtUF').val("<?= $_POST['txtUF'] ?>");
        $('#cmbRegiao').val("<?= $_POST['cmbRegiao'] ?>");
    </script>
    <?php
    try {
//Salva no banco
        $date = date('Y-m-d');
        if (empty($_POST['id'])) {
            $sql = "INSERT INTO tb_estado_capital(
                                    estado,
                                    capital,
                                    uf,
                                    id_regiao,
                                    created
                                )
                                  VALUES (
                                            '{$_POST['txtEstado']}',
                                            '{$_POST['txtCapital']}',
                                            '{$_POST['txtUF']}',
                                            '{$_POST['cmbRegiao']}',
                                            '{$date}')";
        } else {
            $sql = "UPDATE tb_estado_capital SET
                                        estado = '{$_POST['txtEstado']}', 
                                        capital = '{$_POST['txtCapital']}',
                                        uf = '{$_POST['txtUF']}',
                                        id_regiao = '{$_POST['cmbRegiao']}',
                                        modified = '{$date}'
                                WHERE id = {$_POST['id']}";
        }
        $insert = $db->prepare($sql);
        $insert->execute();

        echo "<br/><div class='alert alert-success' role='alert'><b>Registro salvo com sucesso!</b><br /><script>window.location='?pg=list_estado_capital';</script></div>";
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>Não foi possível salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>