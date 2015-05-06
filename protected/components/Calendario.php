<?php
class Calendario{

	public function getDia()
	{
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$date = new DateTime();
		$ano = $date->format('Y');
		$mes = $date->format('m');
		$dia = $date->format('d');
		$nomeDia = date("D", mktime(0, 0, 0, $mes, $dia, $ano));
		$nomeDiaPtb;
		if($nomeDia=="Mon"){
			return "segunda";
		}else if($nomeDia=="Tue"){
			return "terca";
		}else if($nomeDia=="Wed"){
			return "quarta";
		}else if($nomeDia=="Thu"){
			return "quinta";
		}else if($nomeDia=="Fri"){
			return "sexta";
		}else if($nomeDia=="Sat"){
			return "sabado";
		}else if($nomeDia=="Sun"){
			return "domingo";
		}else{
			return "falhou";
		}
	}
	public function getDiaFormatado()
	{
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$date = new DateTime();
		$trata = new TrataString;
		$ano = $date->format('Y');
		$mes = $date->format('m');
		$dia = $date->format('d');
		$nomeDia = date("D", mktime(0, 0, 0, $mes, $dia, $ano));
		$nomeDiaPtb;
		if($nomeDia=="Mon"){
			return $trata->converte("Segunda-Feira");
		}else if($nomeDia=="Tue"){
			return $trata->converte("Terça-Feira");
		}else if($nomeDia=="Wed"){
			return $trata->converte("Quarta-Feira");
		}else if($nomeDia=="Thu"){
			return $trata->converte("Quinta-Feira");
		}else if($nomeDia=="Fri"){
			return $trata->converte("Sexta-Feira");
		}else if($nomeDia=="Sat"){
			return $trata->converte("Sábado");
		}else if($nomeDia=="Sun"){
			return $trata->converte("Domingo");
		}else{
			return "falhou";
		}
	}
	public function getMesAtual(){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$date = new DateTime();
		$trata = new TrataString;
		$ano = $date->format('Y');
		$mes = $date->format('m');
		$dia = $date->format('d');
		$nomeMes = date("M", mktime(0, 0, 0, $mes, $dia, $ano));
		return $nomeMes;
	}
	public function getPeriodo($currDataString){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$currData = strtotime($currDataString);
		$mesAno = date('Y-m',$currData);
		$mes = date('m',$currData);
		$ano = date('Y',$currData);
		if($mes=="01"){
			return $ano."-1";
		}else if($mes=="02"){
			return $ano."-1";
		}else if($mes=="03"){
			return $ano."-1";
		}else if($mes=="04"){
			return $ano."-1";
		}else if($mes=="05"){
			return $ano."-1";
		}else if($mes=="06"){
			return $ano."-1";
		}else if($mes=="07"){
			return $ano."-2";
		}else if($mes=="08"){
			return $ano."-2";
		}else if($mes=="09"){
			return $ano."-2";
		}else if($mes=="10"){
			return $ano."-2";
		}else if($mes=="11"){
			return $ano."-2";
		}else if($mes=="12"){
			return $ano."-2";
		}
		//echo $mesAno;
	}
	public function checaIntervalo($inicio,$fim,$atual){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);

		$currTime = strtotime($atual);
		$iniTime = strtotime($inicio);
		$fimTime  = strtotime($fim);

		$almocoIni = strtotime("12:00:00");
		$almocoFim = strtotime("14:00:00");

		$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));

		if($modelRestricao->LIBERA_ALMOCO=="ativo"){
			if(($currTime>=$almocoIni)&&($currTime<$almocoFim)){
				return "fora";
			}elseif($currTime<$iniTime){
				return "fora";
			}elseif(($currTime>=$iniTime)&&($currTime<=$fimTime)){
				return "dentro";
			}elseif($currTime>$fimTime){
				return "fora";
			}
			return "erro";

		}else if ($modelRestricao->LIBERA_ALMOCO=="inativo"){
			if($currTime<$iniTime){
				return "fora";
			}elseif(($currTime>=$iniTime)&&($currTime<=$fimTime)){
				return "dentro";
			}elseif($currTime>$fimTime){
				return "fora";
			}
			return "erro";
		}
		return "erro";
	}
	public function getHoraFormatada($hora){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$time = strtotime($hora);
		return date('H:i',$time);
	}
	public function dataFormToDataDb($dataNormal){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$dataDb = str_replace("/", "-", $dataNormal);
		$dataDb = date('Y-m-d', strtotime($dataDb));
		return $dataDb;
	}
	public function dataDbToDataForm($dataDb){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$dataForm = date('d/m/Y', strtotime($dataDb));
		return $dataForm;
	}
	public function getData(){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$data = date('d/m/Y');
		return $data;
	}
	public function getHora(){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$hora = date('H:i');
		return $hora;
	}
	public function comparaDataComDataAtual($data){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$dataCurr = date('Y-m-d');
		if($data<$dataCurr){
			return "false";
		}else if($data>=$dataCurr){
			return "true";
		}
		return "nda";
	}
	public function formataHora($hora){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$hora = date('H:i', strtotime($hora));
		return $hora;
	}
	public function formataData($data){
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$data = date('Y-m-d', strtotime($data));
		return $data;
	}
	public function converteNomeDia($nomeDia)
	{
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$trata = new TrataString;
		if($nomeDia=="segunda"){
			//return $trata->converte("Segunda-Feira");
			return "Segunda-Feira";
		}else if($nomeDia=="terca"){
			//return $trata->converte("Terça-Feira");
			return "Terça-Feira";
		}else if($nomeDia=="quarta"){
			//return $trata->converte("Quarta-Feira");
			return "Quarta-Feira";
		}else if($nomeDia=="quinta"){
			//return $trata->converte("Quinta-Feira");
			return "Quinta-Feira";
		}else if($nomeDia=="sexta"){
			//return $trata->converte("Sexta-Feira");
			return "Sexta-Feira";
		}else if($nomeDia=="sabado"){
			//return $trata->converte("Sábado");
			return "Sábado";
		}else if($nomeDia=="domingo"){
			//return $trata->converte("Domingo");
			return "Domingo";
		}else{
			return "falhou";
		}
	}

	public function getArrayHora(){

		return array("06:00:00"=>"06:00",
					 "07:00:00"=>"07:00",
					 "08:00:00"=>"08:00",
					 "09:00:00"=>"09:00",
					 "10:00:00"=>"10:00",
					 "11:00:00"=>"11:00",
					 "12:00:00"=>"12:00",
					 "13:00:00"=>"13:00",
					 "14:00:00"=>"14:00",
					 "15:00:00"=>"15:00",
					 "16:00:00"=>"16:00",
					 "17:00:00"=>"17:00",
					 "18:00:00"=>"18:00",
					 "19:00:00"=>"19:00",
					 "20:00:00"=>"20:00",
					 "21:00:00"=>"21:00",
					 "22:00:00"=>"22:00",
					 "23:00:00"=>"23:00",
		);

	}
}
