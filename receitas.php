<?php
//$sql = "SELECT u.*, p.descricao perfil, s.descricao status FROM sisfin_web.tb_usuario u
//        INNER JOIN sisfin_web.tb_perfil p
//        ON p.id = u.id_perfil
//        INNER JOIN sisfin_web.tb_status s
//        ON s.id = u.id_status";
//$query = $db->prepare($sql);
//$query->execute();
//$receita = $query->fetchAll(PDO::FETCH_ASSOC);
//
//use Sisfin\Util;
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Lista de Receitas</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=nova_receita" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Nova Receita</a>
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Ordem</th>
                <th scope="col">Descrição</th>
                <th scope="col">Recebido de</th>
                <th scope="col">Valor (R$)</th>
                <th scope="col">Categoria</th>
                <th scope="col">Situação</th>
                <th scope="col">Data de Cadastro</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ordem = 1;
            foreach ($users as $value) {
                if ($value['id_status'] == '1') {
                    $text = 'success';
                    $descricao = 'ativo';
                    $icon = 'thumbs-up';
                } else {
                    $text = 'danger';
                    $descricao = 'inativo';
                    $icon = 'thumbs-down';
                }
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= Util::formatarMascara("cpf", $value['cpf']) ?></td>
                    <td><?= $value['perfil'] ?></td>
                    <td><?= $value['status'] ?></td>
                    <td><?= Util::FormataBancoData($value['created']) ?></td>
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