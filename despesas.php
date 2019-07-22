<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Lista de Despesas</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=nova_despesa" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Nova Despesa</a>
    </div>
</div>
<?php
$sql = "SELECT r.*, cf.descricao categoria, sf.descricao situacao FROM sisfin_web.tb_despesa r
        INNER JOIN sisfin_web.tb_categoria_financeira cf
        ON cf.id = r.id_categoria
        INNER JOIN sisfin_web.tb_situacao_financeira sf
        ON sf.id = r.id_situacao
        ORDER BY valor DESC";
$query = $db->prepare($sql);
$query->execute();
$despesa = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;
?>
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
            foreach ($despesa as $value) {
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
                        <a href="#" class="text-primary" title="Editar usuário"><i class="fa fa-user-edit"></i></a>
                        <a href="#" class="text-danger" title="Excluir usuário"><i class="fa fa-trash-alt"></i></a>
                        <a href="#" class="text-<?= $text ?>" title="Usuário <?= $descricao ?>"><i class="fa fa-<?= $icon ?>"></i></a>
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