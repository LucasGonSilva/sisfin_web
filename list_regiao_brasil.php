<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Regiões do Brasil</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=regiao_brasil_crud" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Nova</a>
    </div>
</div>
<?php
$sql = "SELECT * FROM sisfin_web.tb_regioes ORDER BY descricao";
$query = $db->prepare($sql);
$query->execute();
$regiao = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;

if (!empty($regiao)) {
    ?>
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
            foreach ($regiao as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td><?= Util::FormataBancoData($value['created']) ?></td>
                    <td>
                        <a href="?pg=regiao_brasil_crud&acao=editar&id=<?= $value['id'] ?>" class="text-dark" title="Editar Categoria"><i class="fa fa-edit"></i></a>
                        <a class="excluir" href="<?php echo $value['id'] ?>"><i class="fa fa-trash" style="color: red"></i></a>
                    </td>
                </tr>

                <?php
                $ordem++;
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo '<p class="text-center">Não existe dados cadastrados!</p>';
}
?>
    