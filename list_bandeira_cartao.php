<div class="row">
    <div class="col-md-6 align-middle">
        <h4 class="align-middle">Lista de Badeiras de Cartões</h4>
    </div>
    <div class="col-md-6">
        <a href="?pg=bandeira_cartao_crud" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Adicionar Nova</a>
    </div>
</div>
<?php
$sql = "SELECT * FROM sisfin_web.tb_bandeira_cartao ORDER BY descricao";
$query = $db->prepare($sql);
$query->execute();
$bandeira = $query->fetchAll(PDO::FETCH_ASSOC);

use Sisfin\Util;

if (!empty($bandeira)) {
    ?>
    <div class="row">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Ordem</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" class="text-center">Imagem</th>
                    <th scope="col">Status</th>
                    <th scope="col">Criação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ordem = 1;
                foreach ($bandeira as $value) {
                    ?>
                    <tr>
                        <td><?= $ordem ?></td>
                        <td><?= $value['descricao'] ?></td>
                        <td class="text-center"><img src="assets/images/bandeiras/<?= $value['img'] ?>" style="width: 5%"></td>
                        <td><?= $status = $value['status'] == '1' ? 'Ativo' : 'Inativo'; ?></td>
                        <td><?= Util::FormataBancoData($value['created']) ?></td>
                        <td>
                            <a href="?pg=bandeira_cartao_crud&acao=editar&id=<?= $value['id'] ?>" class="text-dark" title="Editar Bandeira"><i class="fa fa-edit"></i></a>
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
    <?php
} else {
    echo '<p class="text-center">Não existe dados lançados.</p>';
}
?>
<script>
    $(document).ready(function () {
        $('.excluir').on('click', function (e) {
            e.preventDefault();
            if (confirm("Deseja excluir?")) {
                window.location.replace("?pg=bandeira_cartao_crud&acao=excluir&id=" + $(this).attr('href'));
            }
        });

    });
</script>