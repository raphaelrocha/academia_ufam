<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	* Authenticates a user.
	* The example implementation makes sure if the username and password
	* are both 'demo'.
	* In practical applications, this should be changed to authenticate
	* against some persistent user identity storage (e.g. database).
	* @return boolean whether authentication succeeds.
	*/
	/*public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/
	private $_username;
	private $_tipo;
	public function authenticate()
	{

		//$salt = openssl_random_pseudo_bytes(22); // É necessário usar OpenSSL.
		//$salt = '$2a$%13$' . strtr(base64_encode($salt), array('_' => '.', '~' => '/'));

		$record = Usuario::model()->findByAttributes(array('MATRICULA'=>$this->username));
		$crypt = new Criptografia;
		//$senhaEncriptada = $crypt->encrypt($this->password);


		//ESTE TRECHO É USADO PARA VALIDAR O USUARIO A CADA LOGIN
		if($record !== null){
			//$senhaDecriptada = $crypt->decrypt($record->SENHA);
			if($record->SITUACAO=="inativo"){ //invalida entrada de perfis marcados como inativo
				$record=null;
			}else{
				$verifPat = new VerificaPatente;
				$isNotUser = $verifPat->isNotUser($record->TIPO);
				$senhaEncriptada = $crypt->encrypt($this->password);

				if($isNotUser==false){ //não autentica no sie os gestores e diretores que não são usuarios.
					if(Yii::app()->params['sie_login_auth']=="sim"){
						if($record->MATRICULA!=Yii::app()->params['root']){
							$validador = new ValidaUsuario();
							$validaAluno = $validador->valida($record->MATRICULA);
							if($validaAluno != "ativo"){
								$record = null;
							}
						}
					}
				}
			}
		}
		/////////////////

		if($record === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		//} elseif ($record->SENHA !== crypt($this->password,$salt)){
		} elseif ($record->SENHA !== $senhaEncriptada){
		//} elseif ($senhaDecriptada !== $this->password){
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->username=$record->NOME;
			$this->setState('MATRICULA', $record->MATRICULA);
			$this->setState('NOME', $record->NOME);
			$this->setState('TIPO', $record->TIPO);
			$this->setState('SEXO', $record->SEXO);
			$this->setState('ALUNO', $record->ALUNO);
			$this->setState('FUNCIONARIO', $record->FUNCIONARIO);
			$this->setState('SITUACAO', $record->SITUACAO);
			//$this->tipo=$record->TIPO;
			//$this->setState('nome', $record->nome);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/*public function getId()
	{
		return $this->_name;
	}*/
}
