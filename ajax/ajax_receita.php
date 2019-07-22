<?php

include_once '../config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

switch ($_GET['acao']) {
    case 'novaReceita':
//        var_dump($_POST);die;
        try {
            //Salva no banco
            Util::converteMoedaBanco($_POST['txtValor']);
            $created = Util::FormataDataBanco($_POST['txtData']);
//            var_dump($created);
//            die;
            if (empty($_POST['hdnID'])) {
                $sql = "INSERT INTO tb_receita(
                                    descricao,
                                    recebido_de,
                                    valor,
                                    id_categoria,
                                    id_situacao,
                                    created)
                                  VALUES ('{$_POST['txtDescricao']}',
                                    '{$_POST['txtRecebidoDe']}',
                                    '{$_POST['txtValor']}',
                                    {$_POST['cmbCategoria']},
                                     {$_POST['cmbSituacao']},
                                    '{$created}')";
                                    echo $sql;
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
                    echo '<br/><div class="alert alert-success" role="alert"><b>Receita cadastrada com sucesso!</b><br/><script>window.location="?pg=receitas";</script></div>';
                } else {
                    throw new Exception("Não foi possivel cadastrar o arquivo importado.");
                }
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert"><b>Não foi possivel salvar os registros.<br/>Detalhes: ' . $e->getMessage() . '</b></div>';
        }
        break;
    case 'verificaDescricaoSituacao':
        $descricao = $_POST['descricao'];
        if ($descricao == '') {
            $sql = "SELECT count(id) as valor FROM tb_situacao_financeira WHERE descricao = '$descricao';";
            $query = $db->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT count(id) as valor FROM tb_situacao_financeira WHERE descricao LIKE '%$descricao%';";
            $query = $db->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($result[0]['valor'] == '0') {
            echo 'is-valid';
        } elseif ($result[0]['valor'] != '0') {
            echo 'is-invalid';
        } else {
            echo 'teste';
        }
        break;
    default:
        break;
}