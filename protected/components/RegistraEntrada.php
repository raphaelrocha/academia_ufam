<?php
class RegistraEntrada{

	public function gravaEntrada($id)
	{
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$record = Usuario::model()->findByAttributes(array('MATRICULA'=>$id));
		if($record == null){
			return false;
		}else {
			$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
			if($academiaRecord->TIPOFUNCIONAMENTO=="ferias"){
				return true;
			}else{
				$date = new DateTime();

				//echo date("D M j G:i:s T Y");
				$hora = $date->format("H:i:s");
				$data = $date->format("Y-m-d");
				//echo $data;
				$ano = $date->format('Y');
				$mes = $date->format('m');
				$dia = $date->format('d');
				$nomeDia = date("D", mktime(0, 0, 0, $mes, $dia, $ano));
				$nomeDiaPtb;
				if($nomeDia=="Mon"){
					$nomeDiaPtb="segunda";
				}else if($nomeDia=="Tue"){
					$nomeDiaPtb="terca";
				}else if($nomeDia=="Wed"){
					$nomeDiaPtb="quarta";
				}else if($nomeDia=="Thu"){
					$nomeDiaPtb="quinta";
				}else if($nomeDia=="Fri"){
					$nomeDiaPtb="sexta";
				}else if($nomeDia=="Sat"){
					$nomeDiaPtb="sabado";
				}else if($nomeDia=="Sun"){
					$nomeDiaPtb="domingo";
				}
				/*$stringCommand = "select horario.diasemana, horario.horainicio, horario.horafim
									from (usuario inner join agenda on (usuario.matricula=agenda.mat_usuario) inner join horario on (agenda.id_horario=horario.id))inner join academia on (horario.ID_ACADEMIA=academia.CODIGO_CONFIG)
									where academia.SITUACAO='ativo' and usuario.matricula='".$id."'";
				$command = Yii::app()->db->createCommand($stringCommand);
				$dataReader=$command->queryAll();
				*/
				$codAcad = $academiaRecord->CODIGO_CONFIG;
				$stringCommand = "SELECT REGISTRA_PRESENCA('".$id."','".$nomeDiaPtb."','".$data."','".$hora."','".$codAcad."') as ret";
				$command = Yii::app()->db->createCommand($stringCommand);
				$dataReader=$command->queryAll();

				$valida=0;
				//echo $nomeDiaPtb."</br>";
				foreach($dataReader as $item){
					if($item['ret']=="1"){
						$valida=1;
					}
				}

				//var_dump($dataReader);
				if($valida==0){
					return false;
				}else{
					return true;
				}
			}
		}
	}
}
