<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Lucas Silva, Desenvolvedor Web">
        <meta name="description" content="Sistema de Finanças e Tarefas Web">
        <meta name="generator" content="NetBeans IDE 8.2 RC">
        <title>Sistema de Finanças Web</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <script src="js/jquery-1.11.3.mim.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            function limpaForm() {
                $('#inputEmail').val('');
                $('#inputPassword').val('');
            }
            function login() {
                var email = $('#inputEmail').val();
                var password = $('#inputPassword').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: 'ajax/ajax_login.php?acao=logar',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function (resposta) {
                        console.log(resposta);
                        switch (resposta) {
                            case 'campos_vazios':
                                $('.msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        'Informe E-mail e Password!' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>');
                                limpaForm();
                                break;
                            case 'campos_incorretos':
                                $('.msg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                        'Email ou senha incorretos!' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                        '</button>' +
                                        '</div>');
                                limpaForm();
                                break;
                            case 'ok':
                                window.location.href = "painel.php?pg=home";
                                break;
                            default:

                                break;
                        }
                    },
                    error: function (erro) {
                        alert('Não foi possivel realizar a operação');
                        console.log(erro);
                    }
                });
            }
        </script>
    </head>
    <body class="text-center">
        <form class="form-signin" action="config/acessar.php" method="post">
            <div class="msg"></div>
            <h1 class="h3 mb-3 font-weight-normal">Sistema de Finanças Web</h1>
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login();">Acessar</button>
            <p class="mt-5 mb-3 text-muted">&copy; Copyright <?= date("Y"); ?> <br> Todos os direitos reservados</p>
        </form>
    </body>
</html>
