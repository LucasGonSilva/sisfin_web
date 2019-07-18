<script>

    function salvarNovoUsuario() {
        $.ajax({
            url: "ajax/usuario.php",
            type: 'post',
            data: {
                nome: "Maria Fernanda",
                salario: '3500'
            },
            beforeSend: function () {
                $("#resultado").html("ENVIANDO...");
            }
        })
                .done(function (msg) {
                    $("#resultado").html(msg);
                })
                .fail(function (jqXHR, textStatus, msg) {
                    alert(msg);
                });
    }

</script>
<div class="row">
    <div class="col-md-6 align-middle">
        <h1 class="align-middle">Cadastrar Novo Usuário</h1>
    </div>
    <div class="col-md-6">
        <a href="?pg=usuarios" class="btn btn-primary btn-sm float-right" role="button" aria-disabled="true">Todos os Usuários</a>
    </div>
</div>
<form action="" method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="txtNome">Nome Completo</label>
                <input type="text" name="txtNome" class="form-control" id="txtNome" placeholder="Nome Completo">
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="txtCPF">CPF</label>
                <input type="text" name="txtCPF" class="form-control" id="txtCPF" placeholder="CPF">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="txtEmail">Email</label>
            <input type="email" name="txtEmail" class="form-control" id="txtEmail" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPerfil">Perfil</label>
            <select id="inputPerfil" name="inputPerfil" class="form-control">
                <option selected>Selecione</option>
                <option>...</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
<?php if (($_SERVER['REQUEST_METHOD'] == 'POST')) { ?>
    <script>
        $('#hdnID').val([<?= $_POST['hdnID'] ?>]);
        $('#txtNome').val("<?= $_POST['txtNome'] ?>");
        $('#txtCPF').val("<?= $_POST['txtCPF'] ?>");
        $('#txtEmail').val("<?= $_POST['txtEmail'] ?>");
        $('#inputPerfil').val("<?= $_POST['inputPerfil'] ?>");
        $('#ativo').prop('checked', <?= isset($_POST['ativo']) ? 1 : 0 ?>);
    </script>
    <?php
    try {
        var_dump($_POST);die;
        //Salva no banco
        $ativo = isset($_POST['ativo']) ? 1 : 0;
        $cpf = Util::limpaMascara($_POST['txtCPF']);
        if (empty($_POST['hdnID'])) {
            $sql = "INSERT INTO tb_usuario(
                                    nome,
                                    cpf,
                                    email,
                                    senha,
                                    ativo,
                                    id_perfil)
                                  VALUES ('{$_POST['txtNome']}',
                                    '{$cpf}',
                                    '{$_POST['txtEmail']}',
                                    'e10adc3949ba59abbe56e057f20f883e',
                                     1,
                                    {$_POST['inputPerfil']})";
        } else {
            $acao = $_GET['acao'];
            $sql = "UPDATE user SET
                                        nome =  '{$_POST['txtNome']}',
                                        cpf =  '{$cpf}',
                                        email =  '{$_POST['txtEmail']}',
                                        id_perfil = {$_POST['cmbPerfil']}
                                        WHERE id = {$_POST['hdnID']}";
        }
        $execute = $db->prepare($sql);
        if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
            if ($execute->execute()) {
                echo '<br/><div class="alert alert-success" role="alert"><b>Usuário atualizado com sucesso!</b><br/><script>window.location="?pg=c_list_usuario";</script></div>';
            } else {
                throw new Exception("Não foi possivel cadastrar o arquivo importado.");
            }
        } else {
            if ($execute->execute()) {
                echo '<br/><div class="alert alert-success" role="alert"><b>Usuário cadastrado com sucesso!</b><br/><script>window.location="?pg=c_list_usuario";</script></div>';
            } else {
                throw new Exception("Não foi possivel cadastrar o arquivo importado.");
            }
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"><b>Não foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
    }
}
?>