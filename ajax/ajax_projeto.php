<?php

include_once '../config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

switch ($_GET['acao']) {
    case 'totalFuncionario':
        $turno = $_POST['turno'];
        if ($_POST['turno'] == 'todos') {
            $turno = 'turno IN (1,2)';
        } elseif ($_POST['turno'] == '1') {
            $turno = 'turno = "1"';
        } else {
            $turno = 'turno = "2"';
        }
        $sql = "SELECT COUNT(id) as total FROM funcionario WHERE $turno AND ativo = 1";
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $total = $result[0]['total'];
        echo "(" . $total . ")";
        break;
    case 'buscarFuncionarioPorTurno':
        $turno = $_POST['turno'];
        if ($_POST['turno'] == 'todos') {
            $turno = 'turno IN (1,2)';
        } elseif ($_POST['turno'] == '1') {
            $turno = 'turno = "1"';
        } else {
            $turno = 'turno = "2"';
        }
        $sql = "SELECT * FROM funcionario WHERE $turno AND ativo = 1 ORDER BY nome";
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo '<option value="" selected>Selecione</option>';
        foreach ($result as $value) {
            echo "<option value='{$value["id"]}'>" . $value['nome'] . "</option>";
        }
        break;
    case 'carregaRelatorioDespesa':
        include '../blocoHTML/relatorioDespesa.php';
        break;
    default:
        break;
}