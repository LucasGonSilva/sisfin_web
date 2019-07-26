<?php
if ($_GET['acao'] && $_GET['acao'] == 'editar') {
    $sql = $db->query("SELECT * FROM tb_bandeira_cartao WHERE id = " . $_GET['id']);
    $resultBandeira = $sql->fetchAll(PDO::FETCH_ASSOC);
    $_POST['id'] = $_GET['id'];
    $acao = "editar";
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
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="txtDescricao">Descrição</label>
                <input type="text" name="txtDescricao" class="form-control required" id="txtDescricao" placeholder="Descrição da Receita" value="<?= $resultBandeira['descricao'] ?>">
            </div>
        </div>
        <div class="form-group col-md-4">
            <div class="form-group">
                <label for="imgBandeira">Imagem</label>
                <input type="file" name="imgBandeira" id="imgBandeira" class="form-control-file">
                <input type="hidden" id="hdnImagem" name="hdnImagem" value="<?= $resultBandeira[0]['img'] ?>">
                <?php if ($acao == "editar" && isset($resultBandeira[0]['img'])) { ?>
                    <a href="assets/images/bandeiras/<?= $resultBandeira[0]['img'] ?>" download="">Baixar Anexo <i class="fa fa-arrow-circle-o-down"></i></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php if ($acao == "editar" && isset($resultBandeira[0]['img'])) { ?>
            <div class="form-group col-lg-6">
                <label for="anexo">Imagem</label>
                <img src="anexos/<?= $resultBandeira[0]['img'] ?>" class="img-responsive img-thumbnail" />
            </div>
            <?php
        }
        ?>
        <div class="form-group col-md-4">
            <div class="col-sm-2">Situação</div>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" name="checkSituacao" type="checkbox" id="checkSituacao">
                    <label class="form-check-label" for="checkSituacao">
                        Ativo
                    </label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-outline-primary" id="sendForm">Salvar</button>
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
                                    created)
                                    VALUES ('{$_POST['txtDescricao']}',
                                    '{$anexo}',
                                    '{$ativo}',
                                    '{$date}')";
        } else {
            $sql = "UPDATE despesas SET
                    data_lancamento = '{$data}',
                    turno = {$_POST['cmbTurno']},
                    formas_pagamento_id = {$_POST['cmbFormaPagamento']},
                    valor_despesa = {$_POST['txtValorPago']},
                    origem = '{$_POST['txtOrigemDespesa']}',
                    anexo = '{$anexo}',
                    obs = '{$_POST['txtObs']}'
                    WHERE id = {$_POST['hdnID']}";
        }
//                }


        $insert = $db->prepare($sql);
        $insert->execute();


        echo '<br/><div class="alert alert-success" role="alert"><b>Registro salvo com sucesso</b><br /><a href="?pg = c_lanca_despesas">Listar Despesas</a></div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>NÃ£o foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>