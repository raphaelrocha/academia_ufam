<?php
class CriaHorario{

	public function gravaHorarios($idAcad)
	{
		$cod=0;
		//$fuso = (4 * 60 * 60);
		$model = Academia::model()->findByPk($idAcad);

		if($model->CAPACIDADE % 2 != 0){
			return 5;
		}

		//Star date
		//$dateStart 		= '20/04/2013';
		$dateStart 		= $model->DATA_INICIO;
		$dateStart 		= implode('-', array_reverse(explode('/', substr($dateStart, 0, 10)))).substr($dateStart, 10);
		$dateStart 		= new DateTime($dateStart);

		//End date
		//$dateEnd 		= '25/04/2013';
		$dateEnd 		= $model->DATA_FIM;
		$dateEnd 		= implode('-', array_reverse(explode('/', substr($dateEnd, 0, 10)))).substr($dateEnd, 10);
		$dateEnd 		= new DateTime($dateEnd);

		//Prints days according to the interval
		$dateRange = array();
		$var = 'null';

		$totalRegistros=0;
		$sqlInsert = "INSERT INTO HORARIO (ID,
											ID_ACADEMIA,
											DIASEMANA,
											PERIODO,
											HORAINICIO,
											HORAFIM,
											TOTAL_USO,
											MAX_ALUNO,
											MAX_FUNC)
		VALUES";
		$i = 0;
		while($i < 7){

			$dateRange[] = $dateStart->format('Y-m-d');

			$horaBase = new DateTime('00:00:00');
			$periodo = new DateTime($model->DURACAO_PERIODO);
			$horaStart = new DateTime($model->HORA_ABERTURA);
			$horaEnd = new DateTime($model->HORA_FECHAMENTO);

			while($horaStart <= $horaEnd ){

				$sqlInsert = $sqlInsert.'(';
				$horario = new Horario;

				$horario->ID = $var;
				$sqlInsert = $sqlInsert.$horario->ID.",'";

				$horario->ID_ACADEMIA = $model->CODIGO_CONFIG;
				$sqlInsert = $sqlInsert.$horario->ID_ACADEMIA."','";

				//$horario->DATADIA = $dateStart->format('Y-m-d');
				//$sqlInsert = $sqlInsert.$horario->DATADIA."','";
				//$sqlInsert = $sqlInsert."NULL"."','";

				//$ano = $dateStart->format('Y');
				//$mes = $dateStart->format('m');
				//$dia = $dateStart->format('d');
				//$nomeDia = date("D", mktime(0, 0, 0, $mes, $dia, $ano));

				if($i==0){
					$horario->DIASEMANA = 'segunda';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==1){
					$horario->DIASEMANA = 'terca';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==2){
					$horario->DIASEMANA = 'quarta';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==3){
					$horario->DIASEMANA = 'quinta';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==4){
					$horario->DIASEMANA = 'sexta';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==5){
					$horario->DIASEMANA = 'sabado';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}else if($i==6){
					$horario->DIASEMANA = 'domingo';
					$sqlInsert = $sqlInsert.$horario->DIASEMANA."','";
				}

				if($horaStart < new DateTime('12:00:00')){
					$horario->PERIODO = 'manhã';
					$sqlInsert = $sqlInsert.$horario->PERIODO."','";
				}
				elseif($horaStart >= new DateTime('12:00:00') && $horaStart < new DateTime('14:00:00')){
					$horario->PERIODO = 'almoço';
					$sqlInsert = $sqlInsert.$horario->PERIODO."','";
				}
				elseif($horaStart >= new DateTime('14:00:00') && $horaStart < new DateTime('18:00:00')){
					$horario->PERIODO = 'tarde';
					$sqlInsert = $sqlInsert.$horario->PERIODO."','";
				}
				elseif($horaStart >= new DateTime('18:00:00')){
					$horario->PERIODO = 'noite';
					$sqlInsert = $sqlInsert.$horario->PERIODO."','";
				}

				$horario->HORAINICIO = $horaStart->format('H:i:s');
				$sqlInsert = $sqlInsert.$horario->HORAINICIO."','";

				/*
		Aqui, ocorre o incremento para while e ao mesmo tempo a HORAFIM é salva.
		*/
				$horario->HORAFIM = $horaStart->add($horaBase->diff($periodo))->format('H:i:s');
				$sqlInsert = $sqlInsert.$horario->HORAFIM."','";

				$horario->TOTAL_USO = $model->CAPACIDADE;
				$sqlInsert = $sqlInsert.$horario->TOTAL_USO."','";

				$horario->MAX_ALUNO = $model->CAPACIDADE/2;
				$sqlInsert = $sqlInsert.$horario->MAX_ALUNO."','";

				$horario->MAX_FUNC = $model->CAPACIDADE/2;
				$sqlInsert = $sqlInsert.$horario->MAX_FUNC."'),";

				//$horario->save();//salva modelo no banco.

				$totalRegistros=$totalRegistros+1;

			}
			$dateStart = $dateStart->modify('+1day');
			$i++;
			//var_dump($sqlInsert);
		}

		$sqlInsert = substr($sqlInsert,0, -1);
		$sqlInsert = $sqlInsert.";";
		//echo $sqlInsert;

		try{
			Yii::app()->db->createCommand($sqlInsert)->execute();
		}catch(Exception $e){
			$cod=1;
			//echo "
			//<script type=\"text/javascript\">
			//    alert('Já existem horários cadastrados para este perfil...');
			//</script>
			//";
		}
		//echo '<br/>';
		//echo "Total de registros gerados: ".$totalRegistros;
		return $cod;
	}
}
