<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Estado / Capital / Região</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=estado_capital_crud" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Novo</a>
    </div>
</div>
<?php
$sql = "SELECT ec.*, r.descricao AS regiao FROM sisfin_web.tb_estado_capital ec
        LEFT JOIN tb_regioes r
        ON ec.id_regiao = r.id
        ORDER BY r.descricao";
$query = $db->prepare($sql);
$query->execute();
$estado_capital = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;

if (!empty($estado_capital)) {
    ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Ordem</th>
                <th scope="col">Estado</th>
                <th scope="col">Capital</th>
                <th scope="col">UF</th>
                <th scope="col">Região</th>
                <th scope="col">Criação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ordem = 1;
            foreach ($estado_capital as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['estado'] ?></td>
                    <td><?= $value['capital'] ?></td>
                    <td><?= $value['uf'] ?></td>
                    <td><?= $value['regiao'] ?></td>
                    <td><?= Util::FormataBancoData($value['created']) ?></td>
                    <td>
                        <a href="?pg=estado_capital_crud&acao=editar&id=<?= $value['id'] ?>" class="text-dark" title="Editar Categoria"><i class="fa fa-edit"></i></a>
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
    