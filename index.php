<?php

require_once("config.php");
// Carrega 1 usuário
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuários buscando pelo loguin
//$search = Usuario::search("ma");
//echo json_encode($search);

// Carrega um usuário informando o loguin e a senha
$usuario = new Usuario();
$usuario->loguin("gabriel", "8546621");
echo $usuario;
?>