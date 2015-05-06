<?php
/*
 *parametros Yii::app()->params['PARAMS'] configirados no config/main.php
*/
Yii::import('ext.validacpf.ValidaCpf', true);

class ValidaUsuario{

	public function valida($id)
	{
		//Checagem no SIE ativada.
		if(Yii::app()->params['sie_connect']=="sim"){
			if ( ValidaCpf( $id ) ) {
				//echo "CPF eh valido.";
				//$json = file_get_contents("http://200.129.163.9:8080/ecampus/servicos/getPessoaValidaSIE?cpf=".$id); // this will require php.ini to be setup to allow fopen over URLs
				$json = file_get_contents(Yii::app()->params['sie_url'].$id); // this will require php.ini to be setup to allow fopen over URLs
				$data = json_decode($json);
				if (sizeof($data)>0){
					foreach ($data as $linha){
						if($linha->ATIVO=="true"){
							return "ativo";
						}
					}
					return "inativo";
				}else{
					return "naoEncontrado";
				}
			} else {
				//echo "CPF Invalido.";
				return "invalido";
			}
		}
		//Checagem no SIE deativada, aceita qualquer valor como cpf.
		else if(Yii::app()->params['sie_connect']=="nao"){
			return "ativo";
		}
	}

	public function getDados($id)
	{
		//Checagem no SIE ativada.
		$nome;
		$mat=null;
		$siape=null;
		$sexo;
		$nasc;
		$curso=null;
		$email;
		$ativo=null;
		if(Yii::app()->params['sie_connect']=="sim"){
			if ( ValidaCpf( $id ) ) {
				//echo "CPF eh valido.";
				//$json = file_get_contents("http://200.129.163.9:8080/ecampus/servicos/getPessoaValidaSIE?cpf=".$id); // this will require php.ini to be setup to allow fopen over URLs
				$json = file_get_contents(Yii::app()->params['sie_url'].$id); // this will require php.ini to be setup to allow fopen over URLs
				$data = json_decode($json);
				if (sizeof($data)>0){
					foreach ($data as $linha){
						if($linha->ATIVO=="true"){
							//return $linha;
							$ativo = "sim";
							$nome = $linha->NOME_PESSOA;
							if ($linha->MATR_ALUNO!=null){
								if ($mat==null){
									$mat=$linha->MATR_ALUNO;
								}
							}
							if ($linha->SIAPE!=null){
								if ($siape==null){
									$siape=$linha->SIAPE;
								}
							}
							$sexo = $linha->SEXO;
							$nasc = $linha->DT_NASCTO;
							if ($linha->CURSO!=null){
								if ($curso==null){
									$curso=$linha->CURSO;
								}
							}
							$email = $linha->EMAIL;
						}
					}
					if($ativo!=null){
						$arr=array('NOME_PESSOA' => $nome,
								   'MATR_ALUNO' => $mat,
								   'SIAPE' => $siape,
								   'SEXO' => $sexo,
								   'DT_NASCTO' => $nasc,
								   'CURSO' => $curso,
								   'EMAIL'=>$email);
						$stringArr = json_encode($arr);
						$temp = json_decode($stringArr);
						return $temp;
					}else{
						return null;
					}
				}else{
					return null;
				}
			}else{
				//echo "CPF Invalido.";
				return null;
			}
		}
		//Checagem no SIE deativada, aceita qualquer valor como cpf.
		else if(Yii::app()->params['sie_connect']=="nao"){
			return "sieNao";
		}
	}

	public function validaCpf($id){
		return ValidaCpf( $id );
	}
}
