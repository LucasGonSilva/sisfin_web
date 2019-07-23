<?php

include_once '../config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

switch ($_GET['acao']) {
    case 'despesa_crud':
        try {
            //Salva no banco
            Util::converteMoedaBanco($_POST['txtValor']);
            $date = date("Y-m-d");
            if (empty($_POST['id'])) {
                $sql = "INSERT INTO tb_despesa(
                                    descricao,
                                    pago_a,
                                    valor,
                                    id_categoria,
                                    id_situacao,
                                    created)
                                  VALUES ('{$_POST['txtDescricao']}',
                                    '{$_POST['txtPagoA']}',
                                    '{$_POST['txtValor']}',
                                    {$_POST['cmbCategoria']},
                                     {$_POST['cmbSituacao']},
                                    '{$date}')";
            } else {
                $acao = $_GET['acao'];
                $sql = "UPDATE tb_despesa SET
                                        descricao =  '{$_POST['txtDescricao']}',
                                        pago_a =  '{$_POST['txtPagoA']}',
                                        valor =  '{$_POST['txtValor']}',
                                        id_categoria = {$_POST['cmbCategoria']},
                                        id_situacao = {$_POST['cmbSituacao']},
                                        modified = '$date'
                                        WHERE id = {$_POST['id']}";
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
    default:
        break;
}