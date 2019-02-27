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

			$this->setData($result[0]);

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

			$this->setData($result[0]);

		}else {
			throw new Exception("Loguin ou senha inválidos(Podendo ser ambos.)");
		}
	}

	public function setData($data){

		$this->setIdUsuario($data['idusuario']);
		$this->setDesloguin($data['desloguin']);
		$this->setDesSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){
		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGUIN, :PASSWORD)", array(
			':LOGUIN'=>$this->getDesloguin(),
			':PASSWORD'=>$this->getDesSenha()
		));

		if(count($result) > 0){
			$this->setData($result[0]);
		}
	}

	public function update($loguin, $senha){

		$this->setDesloguin($loguin);
		$this->setDesSenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET desloguin = :LOGUIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGUIN'=>$this->getDesloguin(),
			':PASSWORD'=>$this->getDesSenha(),
			':ID'=>$this->getIdUsuario()
		));

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setDesloguin("");
		$this->setDesSenha("");
		$this->setDtCadastro(new DateTime());
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