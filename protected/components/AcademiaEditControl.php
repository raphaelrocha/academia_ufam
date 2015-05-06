<?php
class AcademiaEditControl{

	private $capacidade;
	private $cota;
	private $horaAbertura;
	private $horaFechamento;
	private $tipoFuncionamento;
	private $duracaoPeriodo;
	private $dataInicio;
	private $dataFim;

	public function autorizaMudanca($cap,$cot,$hab,$hfc,$tfn,$dpr,$din,$dfn){
		$val_capacidade=0;
		$val_cota=0;
		$val_horaAbertura=0;
		$val_horaFechamento=0;
		$val_tipoFuncionamento=0;
		$val_duracaoPeriodo=0;
		$val_dataInicio=0;
		$val_dataFim=0;
		$soma=0;

		if($cap!=$this->capacidade){
			$val_capacidade=1;
		}
		if($cot!=$this->cota){
			$val_cota=1;
		}
		if($hab!=$this->horaAbertura){
			$val_horaAbertura=1;
		}
		if($hfc!=$this->horaFechamento){
			$val_horaFechamento=1;
		}
		if($tfn!=$this->tipoFuncionamento){
			$val_tipoFuncionamento=1;
		}
		if($dpr!=$this->duracaoPeriodo){
			$val_duracaoPeriodo=1;
		}
		if($din!=$this->dataInicio){
			$val_dataInicio=1;
		}
		if($dfn!=$this->dataFim){
			/*
			PARA EVITAR RESULTADOS AMBÍGUOS, O VALOR DEFINIDO  PARA VAL_DATAFIM NESTA FNÇÃO
			NÃO DEVE SER MENOR OU IGUAL A 14.
			POR SEGURANÇA, DEFINI UM VALOR LONGDE 14, NO CASO 36.
			*/
			$val_dataFim=36;
		}
		$soma= $val_capacidade+
			$val_cota +
			$val_horaAbertura +
			$val_horaFechamento +
			$val_tipoFuncionamento +
			$val_duracaoPeriodo +
			$val_dataInicio +
			$val_dataFim;
		//echo $soma;
		if($soma==0){
			return "nadaMudou";
		}elseif($soma==36){
			return "sim";
		}else{
			return "nao";
		}
	}

	public function setCapacidade($cap){
		$this->capacidade = $cap;
	}

	public function setCota($cot){
		$this->cota = $cot;
	}

	public function setHoraAbertura($hab){
		$this->horaAbertura = $hab;
	}

	public function setHoraFechamento($hfc){
		$this->horaFechamento = $hfc;
	}

	public function setTipoFuncionamento($tfn){
		$this->tipoFuncionamento = $tfn;
	}

	public function setDuracaoPeriodo($dpr){
		$this->duracaoPeriodo = $dpr;
	}

	public function setDataInicio($din){
		$this->dataInicio = $din;
	}

	public function setDataFim($dfn){
		$this->dataFim = $dfn;
	}

	/*public function getDataInicio(){
		return $this->dataInicio;
	}

	public function getDataFim(){
		return $this->dataFim;
	}

	public function getCapacidade(){
		return $this->capacidade;
	}*/
}
?>
