<?php

// inclui o arquivo de inicialização
session_start();
require 'db/Conexao.php';
$db = new Conexao();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../util/Util.php';

use Sisfin\Util;

// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($email) || empty($password)) {
    echo "Informe email e senha";
    exit;
}

// cria o hash da senha
$passwordHash = md5($password);

$sql = "SELECT * FROM tb_usuario WHERE email = :email AND password = :password";
$stmt = $db->prepare($sql);

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $passwordHash);


$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0) {
    echo "Email ou senha incorretos";
    exit;
}

// pega o primeiro usuário
$user = $users[0];

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['id'] = $user['id'];
$_SESSION['nome'] = $user['nome'];
$_SESSION['email'] = $user['email'];
$_SESSION['cpf'] = $user['cpf'];
$_SESSION['status'] = $user['id_status'];
$_SESSION['perfil'] = $user['id_perfil'];
$_SESSION['created'] = $user['created'];

header('Location: ../painel.php');
