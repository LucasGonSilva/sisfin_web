<?php

include_once '../config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

switch ($_GET['acao']) {
    case 'verificaDescricao':
        $descricao = $_POST['descricao'];
        if ($descricao == '') {
            $sql = "SELECT count(id) as valor FROM tb_perfil_usuario WHERE descricao = '$descricao';";
            $query = $db->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT count(id) as valor FROM tb_perfil_usuario WHERE descricao LIKE '%$descricao%';";
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