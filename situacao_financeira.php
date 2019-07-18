<script>
    $(document).ready(function () {
        $('.excluir').on('click', function (e) {
            e.preventDefault();
            if (confirm("Deseja excluir?")) {
                window.location.replace("?pg=situacao_financeira&acao=excluir&id=" + $(this).attr('href'));
            }
        });

    });
</script>
<?php
$sql = "SELECT * FROM sisfin_web.tb_situacao_financeira ORDER BY descricao";
$query = $db->prepare($sql);
$query->execute();
$situacao = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;
if ($_GET['acao'] == 'excluir' && !empty($_GET['id'])) {
    $delete = $db->exec('DELETE FROM tb_situacao_financeira WHERE id = ' . $_GET['id']);
    if ($delete) {
        header("location:?pg=perfil_usuarios");
    } else {
        $msg = '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <h4>Não foi possivel excluir o registro. Verifique se há despesas nesse item</h4>
                        </div>';
    }
}
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Situação Financeira</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=nova_situacao" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Nova</a>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Ordem</th>
                <th scope="col">Descrição</th>
                <th scope="col">Criação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ordem = 1;
            foreach ($situacao as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td><?= Util::FormataBancoData($value['created']) ?></td>
                    <td>
                        <a href="?pg=edita_situacao_financeira&id=<?= $value['id'] ?>" class="text-dark" title="Editar Categoria"><i class="fa fa-edit"></i></a>
                        <a class="excluir" href="<?php echo $value['id'] ?>"><i class="fa fa-trash" style="color: red"></i></a>
                    </td>
                </tr>

                <?php
                $ordem++;
            }
            ?>
        </tbody>
    </table>
</div>
