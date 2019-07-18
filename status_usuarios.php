<?php
$sql = "SELECT * FROM sisfin_web.tb_status ORDER BY descricao";
$query = $db->prepare($sql);
$query->execute();
$status = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Lista de Perfil</h1>
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
            foreach ($status as $value) {
                ?>
                <tr>
                    <td><?= $ordem ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td><?= $value['created'] ?></td>
                    <td>
                        <a href="#" class="text-primary" title="Editar usuário"><i class="fa fa-user-edit"></i></a>
                        <a href="#" class="text-danger" title="Excluir usuário"><i class="fa fa-trash-alt"></i></a>
                        <a href="#" class="text-success" title="Usuário ativo"><i class="fa fa-thumbs-up"></i></a>
                        <a href="#" class="text-danger" title="Usuário inativo"><i class="fa fa-thumbs-down"></i></a>
                    </td>
                </tr>

                <?php
                $ordem++;
            }
            ?>
        </tbody>
    </table>
</div>