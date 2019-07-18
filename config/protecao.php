<?php

session_start();
//var_dump($_SESSION);die;
if (!isset($_SESSION['email']) || !isset($_SESSION['cpf']))
    header("Location: ./login.php");
?>