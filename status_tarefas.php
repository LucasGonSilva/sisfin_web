<?php
$sql = "SELECT * FROM sisfin_web.tb_prioridade_tarefa";
$query = $db->prepare($sql);
$query->execute();
$prioridade = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;
?>
<div class="row">
    <?php
    if (!empty($prioridade)) {
        ?>
        <div class="col-md-6 align-middle">
            <h1 class="align-middle">Lista de Prioridades</h1>
        </div>
        <div class="col-md-6">
            <a href="?pg=nova_prioridade" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Nova</a>
        </div>
    <?php } ?>
</div>
<?php
if (empty($prioridade)) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="text-center">Não existe prioridades cadastradas.</p>
        <a href="?pg=nova_prioridade">Nova Prioridade</a>
    </div>
    <?php
} else {
    ?>
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
                foreach ($prioridade as $value) {
                    ?>
                    <tr>
                        <td><?= $ordem ?></td>
                        <td><?= $value['descricao'] ?></td>
                        <td><?= Util::FormataBancoData($value['created']) ?></td>
                        <td>
                            <a href="#" class="text-primary" title="Editar prioridade"><i class="fa fa-user-edit"></i></a>
                            <a href="#" class="text-danger" title="Excluir prioridade"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>

                    <?php
                    $ordem++;
                }
                ?>
            </tbody>
        </table>
    </div>
<?php }
?>