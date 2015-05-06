<?php
class Dao{

	/*
	VERIFICA SE O USUARIO POSSUI UM DOCUMENTO UPADA PARA O PERÍODO ATIVO
	FUNÇÃO USADA PELA actionAgendamento DA agendaController
	*/
	public function contaDocAcadAtv($mat,$idAcad){

		$qtdeDoc=0;
		$sql = "SELECT COUNT(*) AS NOMEARQUIVO
				FROM ARQUIVO INNER JOIN ACADEMIA ON(ACADEMIA.CODIGO_CONFIG=ARQUIVO.ID_ACADEMIA)
				WHERE MAT_USUARIO='".$mat."' AND ID_ACADEMIA='".$idAcad."'";
		$models = Arquivo::model()->findAllbySql($sql);

		foreach($models as $record) {
			$qtdeDoc = $record->NOMEARQUIVO;
		}

		return $qtdeDoc;
	}

	/*
	ATUALIZA A CAPACIDADE NOS REGISTRO DE HORARIO QUANDO O PERFIL DA ACADEMIA É ALTERADO.
	FUNÇÃO USADA PELA actionUpdate DA academiaController
	*/
	public function atualizaCapHorarios($idAcad){
		/*$sqlCommand = Yii::app()->db->createCommand("UPDATE HORARIO
												   SET TOTAl_USO = (SELECT CAPACIDADE
																	FROM ACADEMIA
																	WHERE CODIGO_CONFIG='".$idAcad."')
												   WHERE ID_ACADEMIA = '".$idAcad."'");
		*/
		$sqlCommand = Yii::app()->db->createCommand("SELECT ATUALIZA_CAPACIDADE('".$idAcad."');");


		$sqlCommand->execute();
	}

	/*
	ATIVA UM PERFIL DA ACADEMIA.
	FUNÇÃO USADA PELA actionUpdate DA academiaController
	*/
	public function ativaAcademia($idAcad){
		$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$idAcad.')');
		$command->execute();
	}

	public function desativaAcademia($idAcad){
		$command = Yii::app()->db->createCommand(
			"UPDATE ACADEMIA SET SITUACAO ='inativo' WHERE CODIGO_CONFIG = '".$idAcad."'");
		$command->execute();
	}

	public function contaHorariosDaAcademia($idAcad){
		/*SELECT COUNT(*)
			FROM ACADEMIA INNER JOIN HORARIO ON (CODIGO_CONFIG=ID_ACADEMIA)
			WHERE CODIGO_CONFIG = 2;*/

		$command = Yii::app()->db->createCommand('SELECT COUNT(*) AS QTD
			FROM ACADEMIA INNER JOIN HORARIO ON (CODIGO_CONFIG=ID_ACADEMIA)
			WHERE CODIGO_CONFIG = '.$idAcad.';');
		$list = $command->queryaLL();

		$rs;
		foreach($list as $item){
			//process each item here
			$rs=$item['QTD'];
		}
		return $rs;
	}

	public function contaMarcacoesDaAcademia($idAcad){

		$command = Yii::app()->db->createCommand('SELECT COUNT(*) AS QTD
			FROM (ACADEMIA INNER JOIN HORARIO ON (ACADEMIA.CODIGO_CONFIG=HORARIO.ID_ACADEMIA))
			INNER JOIN AGENDA ON (HORARIO.ID=AGENDA.ID_HORARIO)
			WHERE CODIGO_CONFIG = '.$idAcad.';');
		$list = $command->queryaLL();

		$rs;
		foreach($list as $item){
			//process each item here
			$rs=$item['QTD'];
		}
		return $rs;
		//return $ret->COUNT;
	}

	public function deletaHorarios($idAcad){
		$command = Yii::app()->db->createCommand('DELETE FROM HORARIO
			WHERE ID_ACADEMIA='.$idAcad.';');
		$command->execute();
	}
}
?>
