<?php
include 'config/protecao.php';
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
require 'config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include './util/Util.php';
date_default_timezone_set('America/Sao_Paulo');
$date = date('d/m/Y H:i');

use Sisfin\Util;
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Lucas Silva, Desenvolvedor Web">
        <meta name="generator" content="Jekyll v3.8.5">
        <title>Sistema de Finanças Web</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
        <script defer src="css/fontawesome/js/all.js"></script> <!--load all styles -->
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="js/util.js"></script>
        <script>
            $(document).ready(function () {
                pluginDataTable();
            });

            function pluginDataTable() {
                $('.buscar').DataTable({
                    paging: false,
                    language: {
                        processing: "Processando...",
                        search: "Buscar:"
                    },
                    columnDefs: [
                        {
                            "searchable": false
                        }
                    ]
                }).order([[1, 'desc']]).draw();
            }
        </script>
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Sistema de Finanças Web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="?pg=home">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="?pg=tarefas">Tarefas</a>
                            <a class="dropdown-item" href="?pg=projetos">Projetos</a>
                            <a class="dropdown-item" href="?pg=usuarios">Usuários</a>
                            <a class="dropdown-item" href="?pg=perfil_usuarios">Perfil de Usuário</a>
                            <a class="dropdown-item" href="?pg=status_usuarios">Status de Usuário</a>
                            <a class="dropdown-item" href="?pg=prioridades">Prioridade de Tarefas</a>
                            <a class="dropdown-item" href="?pg=prioridade">Status da Tarefa</a>
                            <a class="dropdown-item" href="?pg=prioridade">Situação da Tarefa</a>
                            <a class="dropdown-item" href="?pg=categoria_financeira">Categoria Financeira</a>
                            <a class="dropdown-item" href="?pg=situacao_financeira">Situação Financeiro</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Controle Financeiro</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="?pg=receitas">Receitas</a>
                            <a class="dropdown-item" href="?pg=despesas_fixas">Despesas Fixas</a>
                            <a class="dropdown-item" href="?pg=despesas_variaveis">Despesas Variáveis</a>
                            <a class="dropdown-item" href="?pg=impostos">Impostos</a>
                            <a class="dropdown-item" href="?pg=transferencias">Transferências</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relatórios</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="?pg=financeiro">Financeiro</a>
                            <a class="dropdown-item" href="?pg=metas">Metas</a>
                            <a class="dropdown-item" href="?pg=gastos">Gastos</a>
                            <a class="dropdown-item" href="?pg=home"></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gráficos</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="?pg=grafico_mensal_gastos">Mensal de Gastos</a>
                            <a class="dropdown-item" href="?pg=metas">Metas</a>
                            <a class="dropdown-item" href="?pg=gastos">Gastos</a>
                            <a class="dropdown-item" href="?pg=home"></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown05">
                            <a class="dropdown-item" href="?pg=home">Perfil</a>
                            <a class="dropdown-item" href="?pg=home">Another action</a>
                            <a class="dropdown-item" href="config/logout.php">Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <?php

            function getGet($key) {
                return isset($_GET[$key]) ? $_GET[$key] : 'home';
            }

            $pag = getGet('pg');
            if (is_file($pag . '.php'))
                include $pag . '.php';
            else
                include 'error.php';
            ?>


        </div>
        <script>
            window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>
        <script src="js/bootstrap.bundle.min.js"></script>

    </body>
</html>