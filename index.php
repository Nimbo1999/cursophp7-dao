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
//$usuario = new Usuario();
//$usuario->loguin("gabriel", "8546621");
//echo $usuario;

//Criando um novo usuário
//$aluno = new Usuario();
//$aluno->setDesloguin("aluno");
//$aluno->setDessenha("#alun0");
//$aluno->insert();
//echo $aluno;

//Alterando um usuário
//$usuario = new Usuario();
//$usuario->loadById(14);
//$usuario->update("Nimbo", "5486523");
//echo $usuario;

//Deletando um usuário do Banco de dados.
$usuario = new Usuario();
$usuario->loadById(15);
$usuario->delete();
echo $usuario;

?>