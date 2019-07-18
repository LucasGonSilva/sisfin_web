<?php

include_once '../config/db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

#Verifica se tem um email para pesquisa
if (isset($_POST['email'])) {

    #Recebe o Email Postado
    $emailPostado = $_POST['email'];

    #Conecta banco de dados 
    //$con = mysqli_connect("localhost", "root", "", "outrasintencoes");
    $sql = "SELECT * FROM tb_usuario WHERE email = '{$emailPostado}'";
    $query = $db->query($sql);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    #Se o retorno for maior do que zero, diz que já existe um.
    if (empty($result))
        echo json_encode(array('email' => 'Ja existe um usuario cadastrado com este email', 'msg' => 'teste'));
    else
        echo json_encode(array('email' => 'Usuário valido.'));
}
?>