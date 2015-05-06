<?php
class VerificaPatente{
	/*
	RETORNA TRUE PARA DIRETOR OU GESTOR.
	*/
	function isGestorOrDiretor($tipo)
	{
		$lista=array();
		$lista = split(';',$tipo);
		foreach ($lista as $valor){
			if($valor=="diretor"){
				return true;
			}elseif($valor=="gestor"){
				return true;
			}
		}
		return false;
	}
	/*
	RETORNA SE É DIRETOR OU GESTOR OU NENHUM.
	*/
	function isPatente($tipo)
	{
		$lista=array();
		$lista = split(';',$tipo);
		//$ehDiretorOuGestor=false;
		foreach ($lista as $valor){
			if($valor=="diretor"){
				return $valor;
			}elseif($valor=="gestor"){
				return $valor;
			}/*elseif($valor=="usuario"){
				return $valor;
			}*/
		}
		return "nda";
	}
	function isFuncionario($funcionario)
	{
		$lista=array();
		$lista = split(';',$funcionario);
		//$ehDiretorOuGestor=false;
		foreach ($lista as $valor){
			if($valor=="sim"){
				return true;
			}elseif($valor=="nao"){
				return false;
			}
		}
		return false;
	}
	function isUsuario($usuario)
	{
		$lista=array();
		$lista = split(';',$usuario);
		foreach ($lista as $valor){
			if($valor=="usuario"){
				return "sim";
			}
		}
		return "nao";
	}

	function verificaTipo($tipo){
		$lista=array();
		$lista = split(';',$tipo);
		$usuario=0;
		$gestor=0;
		$diretor=0;
		foreach ($lista as $valor){
			if($valor=="usuario"){
				$usuario=1;
			}elseif($valor=="gestor"){
				$gestor=1;
			}
			elseif($valor=="diretor"){
				$diretor=1;
			}
		}
		if($usuario==1){
			if(($diretor==0)&&($gestor==0)){
				return "soUsuario";
			}elseif(($diretor==1)&&($gestor==0)){
				return "usuarioDiretor";
			}
			elseif(($diretor==0)&&($gestor==1)){
				return "usuarioGestor";
			}
		}elseif($usuario==0){
			if(($diretor==1)&&($gestor==0)){
				return "soDiretor";
			}
			elseif(($diretor==0)&&($gestor==1)){
				return "soGestor";
			}
		}
	}

	public function isNotUser($tipo){
		$lista=array();
		$lista = split(';',$tipo);
		$usuario=0;
		$gestor=0;
		$diretor=0;
		foreach ($lista as $valor){
			if($valor=="usuario"){
				$usuario=1;
			}elseif($valor=="gestor"){
				$gestor=1;
			}
			elseif($valor=="diretor"){
				$diretor=1;
			}
		}
		if($usuario==0){
			return true;
		}else{
			return false;
		}
	}

	public function formataPatente($tipo){
		$lista=array();
		$lista = split(';',$tipo);
		$usuario=0;
		$gestor=0;
		$diretor=0;
		$trata = new TrataString;

		foreach ($lista as $valor){
			if($valor=="usuario"){
				$usuario=1;
			}elseif($valor=="gestor"){
				$gestor=1;
			}
			elseif($valor=="diretor"){
				$diretor=1;
			}
		}
		if($usuario==1){
			if(($diretor==0)&&($gestor==0)){
				//return $trata->converte("Usuário");
				return "Usuário";
			}elseif(($diretor==1)&&($gestor==0)){
				//return $trata->converte("Usuário/Diretor");
				return "Usuário / Diretor";
			}
			elseif(($diretor==0)&&($gestor==1)){
				//return $trata->converte("Usuário/Gestor");
				return "Usuário / Gestor";
			}
		}elseif($usuario==0){
			if(($diretor==1)&&($gestor==0)){
				return "Diretor";
			}
			elseif(($diretor==0)&&($gestor==1)){
				return "Gestor";
			}
		}
	}
}
