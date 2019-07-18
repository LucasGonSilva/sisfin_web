<?php
$sql = "SELECT *  FROM sisfin_web.tb_tarefa";
$query = $db->prepare($sql);
$query->execute();
$projeto = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Lista de Projetos</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=novo_projeto" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Novo</a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Ordem</th>
                <th scope="col">tarefa</th>
                <th scope="col">Descrição</th>
                <th scope="col">lançamento</th>
                <th scope="col">Prazo</th>
                <th scope="col">Prioridade</th>
                <th scope="col">Concluída</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ordem = 1;
            foreach ($projeto as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['tarefa'] ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td><?= $value['created'] ?></td>
                    <td><?= $value['prazo'] ?></td>
                    <td><?= $value['prioridade'] ?></td>
                    <td><?= $value['status'] ?></td>
                    <td>
                        <a href="#" class="text-primary" title="Editar usuário"><i class="fa fa-user-edit"></i></a>
                        <a href="#" class="text-danger" title="Excluir usuário"><i class="fa fa-trash-alt"></i></a>
                        <a href="#" class="text-<?= $text ?>" title="Usuário <?= $descricao ?>"><i class="fa fa-<?= $icon ?>"></i></a>
                    </td>
                </tr>

                <?php
                $ordem++;
            }
            ?>
        </tbody>
    </table>
</div>