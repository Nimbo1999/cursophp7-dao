<?php

class Usuario{

	private $idusuario;
	private $desloguin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		return $this->idusuario = $value;
	}

	public function getDesloguin(){
		return $this->desloguin;
	}

	public function setDesloguin($value){
		return $this->desloguin = $value;
	}

	public function getDesSenha(){
		return $this->dessenha;
	}

	public function setDesSenha($value){
		return $this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		return $this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($result) > 0){

			$row = $result[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesloguin($row['desloguin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));

		}

	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY desloguin;");
	}

	public static function search($loguin){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE desloguin LIKE :SEARCH ORDER BY desloguin", array(
			':SEARCH'=>"%". $loguin ."%"
		));
	}

	public function loguin($usuario, $senha){

		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE desloguin = :USUARIO AND dessenha = :PASSWORD", array(
			":USUARIO"=>$usuario,
			":PASSWORD"=>$senha
		));

		if(count($result) > 0){

			$row = $result[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesloguin($row['desloguin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));

		}else {
			throw new Exception("Loguin ou senha inválidos(Podendo ser ambos.)");
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"desloguin"=>$this->getDesloguin(),
			"dessenha"=>$this->getDesSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}

?>