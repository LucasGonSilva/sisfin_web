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
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Lista de Receitas</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=receita_crud" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Nova Receita</a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Ordem</th>
                <th scope="col">Valor (R$)</th>
                <th scope="col">Descrição</th>
                <th scope="col">Recebido de</th>
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
<div class="row">
    <div class="col col-md-4">
        <div class="alert alert-primary">
            <h3 class="font-weight-normal">Total Receita</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="col col-md-4">
        <div class="alert alert-danger">
            <h3 class="font-weight-normal">Total Despesas</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="col col-md-4">
        <div class="alert alert-secondary">
            <h3 class="font-weight-normal">Total Geral</h3>
            <p class="text-center">R$ <?= number_format($valorTotal, 2, ',', '.') ?></p>
        </div>
    </div>
</div>