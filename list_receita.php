<div class="row text-center">
    <div class="col col-md-3">
        <div class="card border-secondary mb-3">
            <h3 class="font-weight-normal">Total Receita</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card border-secondary mb-3">
            <h3 class="font-weight-normal">Total Despesas</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card border-secondary mb-3">
            <h3 class="font-weight-normal">Total Geral</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="col col-md-3">
        <div class="card border-secondary mb-3">
<!--            <span class="badge badge-danger text-center">
                <i class="fa fa-thumbs-down"></i>
            </span>-->
            <h4 class="font-weight-normal text-center">Pagtos em Atraso</h4>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Lista de Receitas</h3>
    </div>
    <div class="col-md-6">
        <a href="?pg=receita_crud" class="btn btn-outline-primary btn-sm float-right" role="button" aria-disabled="true"><i class="fa fa-plus"></i> Nova Receita</a>
    </div>
</div>
<?php
$sql = "SELECT r.*, cf.descricao categoria, sf.descricao situacao FROM sisfin_web.tb_receita r
        INNER JOIN sisfin_web.tb_categoria_financeira cf
        ON cf.id = r.id_categoria
        INNER JOIN sisfin_web.tb_situacao_financeira sf
        ON sf.id = r.id_situacao
        ORDER BY valor DESC";
$query = $db->prepare($sql);
$query->execute();
$receita = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;

//var_dump($despesa);die;
if (!empty($receita)) {
    ?>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ordem</th>
                    <th scope="col">Valor (R$)</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Pago a</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Data de Cadastro</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ordem = 1;
                foreach ($receita as $value) {
                    ?>
                    <tr>
                        <td><?= $ordem ?></td>
                        <td class="text-right"><?= number_format($value['valor'], 2, ',', '.') ?></td>
                        <td><?= $value['descricao'] ?></td>
                        <td><?= $value['recebido_de'] ?></td>
                        <td><?= $value['categoria'] ?></td>
                        <td><?= $value['situacao'] ?></td>
                        <td><?= Util::FormataBancoData($value['created']) ?></td>
                        <td>
                            <a href="?pg=receita_crud&acao=editar&id=<?= $value['id']; ?>" class="text-primary" title="Editar Receita"><i class="fa fa-edit"></i></a>
                            <a href="#" class="text-danger" title="Excluir Receita"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>

                    <?php
                    $valorTotal += $value['valor'];
                    $ordem++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
} else {
    echo '<p class="text-center">Não existe dados lançados.</p>';
}
?>