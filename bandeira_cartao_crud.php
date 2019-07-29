<?php
if ($_GET['acao'] && $_GET['acao'] == 'editar') {
    $sql = $db->query("SELECT * FROM tb_bandeira_cartao WHERE id = " . $_GET['id']);
    $resultBandeira = $sql->fetch(PDO::FETCH_ASSOC);
    $_POST['id'] = $_GET['id'];
    $acao = "editar";
    $btn = 'Editar';
} elseif ($_GET['acao'] != 'editar') {
    $btn = 'Salvar';
}

use Sisfin\Util;
?>

<script>
    function goBack() {
        window.history.back();
    }

</script>
<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Cadastrar Nova Bandeira de Cartão</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=list_bandeira_cartao" class="btn btn-outline-primary btn-sm float-right" role="button" aria-disabled="true">Todas as Bandeiras</a>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" class="form-group">
    <div class="row">
        <div class="form-group col-md-3">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input type="text" name="txtDescricao" class="form-control required" id="txtDescricao" placeholder="Descrição da Receita" value="<?= $resultBandeira['descricao'] ?>">
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="form-group">
                <label for="imgBandeira">Imagem</label>
                <input type="file" name="imgBandeira" id="imgBandeira" class="form-control-file">
                <input type="hidden" id="hdnImagem" name="hdnImagem" value="<?= $resultBandeira['img'] ?>">
                <?php if ($acao == "editar" && isset($resultBandeira['img'])) { ?>
                    <a href="assets/images/bandeiras/<?= $resultBandeira['img'] ?>" download="">Baixar Anexo <i class="fa fa-arrow-circle-down"></i></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php if ($acao == "editar" && isset($resultBandeira['img'])) { ?>
            <div class="form-group col-lg-3">
                <div class="form-group">
                    <label for="anexo">Imagem</label>
                    <img src="assets/images/bandeiras/<?= $resultBandeira['img'] ?>" style="width: 15%" class="img-responsive img-thumbnail" />
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group col-md-3">
            <div class="col-sm-2">Situação</div>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" name="checkSituacao" type="checkbox" id="checkSituacao" <?= $resultBandeira['status'] == '1' ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label" for="checkSituacao">Ativo</label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-outline-primary" id="sendForm"><?= $btn ?></button>
    <button type="reset" class="btn btn-outline-secondary">Limpar</button>
    <input type='button' class="btn btn-outline-warning" value='Voltar' onclick='history.go(-1)' />
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtDescricao').val("<?= $_POST['txtDescricao'] ?>");
        $('#imgBandeira').val("<?= $_POST['imgBandeira'] ?>");
        $('#checkSituacao').prop('checked', <?= isset($_POST['checkSituacao']) ? 1 : 0 ?>);
    </script>
    <?php
    try {
        //Salva no banco
        $ativo = isset($_POST['checkSituacao']) ? 1 : 0;
        $date = date('Y-m-d');
        if (isset($_FILES['imgBandeira'])) {
            // faz o upload dos arquivos e retorna o novo nome deles
            $anexo = '';
            $arquivos = Util::upload(array('arquivos' => $_FILES, 'dir' => 'assets/images/bandeiras/'));

            if (!empty($arquivos['imgBandeira'])) {
                $anexo = $arquivos['imgBandeira'];
            } else {
                $anexo = $_POST['hdnImagem'];
            }
        } else {
            $anexo = NULL;
        }
        if (empty($_POST['id'])) {
            $sql = "INSERT INTO tb_bandeira_cartao(
                        descricao,
                        img,
                        status,
                        created
                    ) VALUES (
                        '{$_POST['txtDescricao']}',
                        '{$anexo}',
                        '{$ativo}',
                        '{$date}')";
        } else {
            $sql = "UPDATE tb_bandeira_cartao SET
                        descricao = '{$_POST['txtDescricao']}',
                        img = '{$anexo}',
                        status = '{$ativo}',
                        modified = '{$date}'
                    WHERE id = {$_POST['id']}";
        }
        $insert = $db->prepare($sql);
        $insert->execute();
        echo '<br/><div class="alert alert-success" role="alert"><b>Registro salvo com sucesso!</b><br /><script>window.location.href="?pg=list_bandeira_cartao";</script></div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>NÃ£o foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>