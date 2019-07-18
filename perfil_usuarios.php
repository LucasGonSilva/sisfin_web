<script>
    $(document).ready(function () {
        $('.excluir').on('click', function (e) {
            e.preventDefault();
            if (confirm("Deseja excluir?")) {
                window.location.replace("?pg=perfil_usuarios&acao=excluir&id=" + $(this).attr('href'));
            }
        });

    });
</script>
<?php
$sql = "SELECT * FROM sisfin_web.tb_perfil_usuario ORDER BY descricao";
$query = $db->prepare($sql);
$query->execute();
$perfil = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;
if ($_GET['acao'] == 'excluir' && !empty($_GET['id'])) {
    $delete = $db->exec('DELETE FROM tb_perfil_usuario WHERE id = ' . $_GET['id']);
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
        <h1 class="align-middle">Lista de Perfil de Usuário</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=novo_perfil" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Novo</a>
    </div>
</div>
<div class="row">
    <table class="table">
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
            foreach ($perfil as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td><?= Util::FormataBancoData($value['created']) ?></td>
                    <td>
                        <a href="?pg=edita_perfil_usuario&id=<?= $value['id'] ?>" class="text-dark" title="Editar Perfil"><i class="fa fa-edit"></i></a>
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
