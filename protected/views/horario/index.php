
<head>
	<!--MICROSOFT-->
	<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>-->
	<!--GOOGLE-->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<!--LOCAL-->
	<script src="jquery/jquery-1.11.2.min.js"></script> <!--usando o jquery local no diretório raiz do projeto-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css" />
</head>

<?php
$GLOBALS['nome'] = "Ajustar cotas";

$this->menu=array(
	//	array('label'=>'List Horario', 'url'=>array('index')),
	//array('label'=>'Ativar perfil', 'url'=>array('ativarperfil&value='.$academiaRecord->CODIGO_CONFIG)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/accept.png" width="50px" height="50px" alt="Ativar title="Ativar"/>', 'url'=>array('ativarperfil&value='.$academiaRecord->CODIGO_CONFIG)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancelb.png" width="50px" height="50px" alt="Cancelar title="Cancelar"/>', 'url'=>array('academia/manage')),
);
?>



<?php
//OBJETOS
$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));
$calendario = new Calendario;
?>




<?php
/* @var $this SiteController */

//include 'ajax.php';
$this->pageTitle=Yii::app()->name;

?>
<?php if ($academiaRecord!==null):?>

	Capacidade máxima configurada: <?php echo $academiaRecord->CAPACIDADE?>
	<br><br>
	Clique em um campo da tabela para ajsutar as cotas de vagas para o horário desejado.
	<br>
	Campos em laranja indicam dias cujas as cotas já foram personalizadas.

	<?php
	$capacidade = $academiaRecord->CAPACIDADE;

	if($academiaRecord->TIPOFUNCIONAMENTO=="normal"){
		$funcionamento = "Normal";
	}else if ($academiaRecord->TIPOFUNCIONAMENTO=="ferias"){
		$funcionamento = "Férias";
	}else{
		$funcionamento = $academiaRecord->TIPOFUNCIONAMENTO;
	}

	function formataHora($hora){
		$dateHoraForm = new DateTime($hora);
		return $dateHoraForm->format('H:i');
	}
	?>


	</p>

	<?php if ($funcionamento!=="Férias"):?>

	<form action="#" method="post" id="form">
		<?php
		$php_arrayVagasSegunda = array();
		$php_arrayVagasTerca = array();
		$php_arrayVagasQuarta = array();
		$php_arrayVagasQuinta = array();
		$php_arrayVagasSexta = array();
		$php_arrayVagasSabado = array();
		$php_arrayVagasDomingo = array();
		$php_arrayMarcados = array();
		$php_arrayCotaAlunosVagasSegunda = array();
		$php_arrayCotaAlunosVagasTerca = array();
		$php_arrayCotaAlunosVagasQuarta = array();
		$php_arrayCotaAlunosVagasQuinta = array();
		$php_arrayCotaAlunosVagasSexta = array();
		$php_arrayCotaAlunosVagasSabado = array();
		$php_arrayCotaAlunosVagasDomingo = array();
		$php_arrayCotaFuncionariosVagasSegunda = array();
		$php_arrayCotaFuncionariosVagasTerca = array();
		$php_arrayCotaFuncionariosVagasQuarta = array();
		$php_arrayCotaFuncionariosVagasQuinta = array();
		$php_arrayCotaFuncionariosVagasSexta = array();
		$php_arrayCotaFuncionariosVagasSabado = array();
		$php_arrayCotaFuncionariosVagasDomingo = array();
		$php_arrayIdHorariosSegunda = array();
		$php_arrayIdHorariosTerca = array();
		$php_arrayIdHorariosQuarta = array();
		$php_arrayIdHorariosQuinta = array();
		$php_arrayIdHorariosSexta = array();
		$php_arrayIdHorariosSabado = array();
		$php_arrayIdHorariosDomingo = array();
		$php_arrayMarcados = array();
		$funcionamento;
		?>
		<?php
		/*
		DISTRIBUI AS VAGAS DE CADA HORÁRIO DE ACORDO COM OS DIAS DA SEMANA E O PERFIL SELECIONADO
		*/
		//$modelsGrid = Grid::model()->findAll();
		$modelsAgendaV = AgendaV::model()->findAllByAttributes(array("MAT_USUARIO"=>Yii::app()->user->getState('MATRICULA'),"ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$modelsGrid = Horario::model()->findAllByAttributes(array("ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG),array('order'=>'ID'));

		foreach($modelsAgendaV as $modelAgendaV)
		{
			//echo $modelAgendaV->MAT_USUARIO." ".$modelAgendaV->ID_ACADEMIA." ".$modelAgendaV->HORAINICIO." ".$modelAgendaV->DIASEMANA." "./*$modelAgendaV->PRESENCA.*/" ".$modelAgendaV->FALTA." ".$modelAgendaV->IDCEL."<br>";
			$php_arrayMarcados[]=$modelAgendaV->IDCEL;
		}
		/*foreach($php_arrayMarcados as $m)
				{
					echo $m." ";
				}*/
		foreach($modelsGrid as $modelGrid)
		{
			//if ($modelGrid->ID_ACADEMIA==$academiaRecord->CODIGO_CONFIG){
			//echo $modelGrid->ID_ACADEMIA." ".$modelGrid->HORAINICIO." ".$modelGrid->DIASEMANA." ".$modelGrid->TOTAL_USO."<br>";
			if($modelGrid->DIASEMANA=="segunda"){

				$php_arrayVagasSegunda[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasSegunda[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasSegunda[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosSegunda[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="terca"){

				$php_arrayVagasTerca[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasTerca[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasTerca[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosTerca[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="quarta"){

				$php_arrayVagasQuarta[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasQuarta[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasQuarta[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosQuarta[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="quinta"){

				$php_arrayVagasQuinta[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasQuinta[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasQuinta[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosQuinta[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="sexta"){

				$php_arrayVagasSexta[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasSexta[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasSexta[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosSexta[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="sabado"){

				$php_arrayVagasSabado[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasSabado[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasSabado[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosSabado[]=$modelGrid->ID;

			}
			if($modelGrid->DIASEMANA=="domingo"){

				$php_arrayVagasDomingo[]=$modelGrid->TOTAL_USO;
				$php_arrayCotaAlunosVagasDomingo[]=$modelGrid->MAX_ALUNO;
				$php_arrayCotaFuncionariosVagasDomingo[]=$modelGrid->MAX_FUNC;
				$php_arrayIdHorariosDomingo[]=$modelGrid->ID;

			}
			//}
		}
		//=======================================
		$horaBase = new DateTime('00:00:00');
		$periodo = new DateTime($academiaRecord->DURACAO_PERIODO);
		$horaStart = new DateTime($academiaRecord->HORA_ABERTURA);
		$horaEnd = new DateTime($academiaRecord->HORA_FECHAMENTO);
		$arrayPos=0;
		$php_arrayHora[$arrayPos] = formataHora($academiaRecord->HORA_ABERTURA);
		$arrayPos++;
		while($horaStart <= $horaEnd ){

			/*
					Aqui, ocorre o incremento para while e ao mesmo tempo a HORAFIM é salva.
					*/
			$horaAdicional = $horaStart->add($horaBase->diff($periodo))->format('H:i');
			$php_arrayHora[$arrayPos] = $horaAdicional;
			$arrayPos++;

		}
		//$jqueryURL = Yii::app()->createAbsoluteUrl("sites/jquery/jquery-1.11.2.min.js");
		?>
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
		<!--<script src=<?php $jqueryURL ?>></script>-->
		<script >
			var seg = ter = qua = qui = sex = sab = dom = 0;
			var idCel=0;
			var vagas=0;
			//var bg = "#ADFF2F";
			var bg = "#E6E6E6";
			var idAcademia = <?php echo json_encode($academiaRecord->CODIGO_CONFIG); ?>;
			var arrayMap = new Array(); //SALVA A REFERENCIA DE CADA DIA/HORA DA SEMANA.
			var mat = <?php echo json_encode(Yii::app()->user->getState('MATRICULA'));?>;

			function novaLinha(javascript_arrayHora,horasDia, linhas,
								javascript_arrayVagasSegunda,
								javascript_arrayVagasTerca,
								javascript_arrayVagasQuarta,
								javascript_arrayVagasQuinta,
								javascript_arrayVagasSexta,
								javascript_arrayVagasSabado,
								javascript_arrayVagasDomingo){
				//var hora = horasDia;
				for(x = 0; x < linhas-2; x++){
					if(javascript_arrayCotaAlunosVagasSegunda[x]!=javascript_arrayCotaFuncionariosVagasSegunda[x]){
						bg = "#F7BE81";
					}
					var parte1 = "<tr><th>"+javascript_arrayHora[x]+"</th>";
					var parte2 = "<td  id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosSegunda[x]+"'>A - "+javascript_arrayCotaAlunosVagasSegunda[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasSegunda[x]+"</a></td>";
					arrayMap.push("segunda;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasTerca[x]!=javascript_arrayCotaFuncionariosVagasTerca[x]){
						bg = "#F7BE81";
					}
					var parte3 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosTerca[x]+"'>A - "+javascript_arrayCotaAlunosVagasTerca[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasTerca[x]+"</a></td>";
					arrayMap.push("terca;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasQuarta[x]!=javascript_arrayCotaFuncionariosVagasQuarta[x]){
						bg = "#F7BE81";
					}
					
					var parte4 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosQuarta[x]+"'>A - "+javascript_arrayCotaAlunosVagasQuarta[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasQuarta[x]+"</a></td>";
					arrayMap.push("quarta;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasQuinta[x]!=javascript_arrayCotaFuncionariosVagasQuinta[x]){
						bg = "#F7BE81";
					}
					
					var parte5 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosQuinta[x]+"'>A - "+javascript_arrayCotaAlunosVagasQuinta[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasQuinta[x]+"</a></td>";
					arrayMap.push("quinta;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasSexta[x]!=javascript_arrayCotaFuncionariosVagasSexta[x]){
						bg = "#F7BE81";
					}
					var parte6 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosSexta[x]+"'>A - "+javascript_arrayCotaAlunosVagasSexta[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasSexta[x]+"</a></td>";
					arrayMap.push("sexta;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasSabado[x]!=javascript_arrayCotaFuncionariosVagasSabado[x]){
						bg = "#F7BE81";
					}
					var parte7 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosSabado[x]+"'>A - "+javascript_arrayCotaAlunosVagasSabado[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasSabado[x]+"</a></td>";
					arrayMap.push("sabado;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					if(javascript_arrayCotaAlunosVagasDomingo[x]!=javascript_arrayCotaFuncionariosVagasDomingo[x]){
						bg = "#F7BE81";
					}
					var parte8 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><a id='gridcota' href='index.php?r=horario/update&id="+javascript_arrayIdHorariosDomingo[x]+"'>A - "+javascript_arrayCotaAlunosVagasDomingo[x]+"<br>S - "+javascript_arrayCotaFuncionariosVagasDomingo[x]+"</a></td>";
					arrayMap.push("domingo;"+javascript_arrayHora[x]);
					idCel++;
					bg = "#E6E6E6";
					document.getElementById("tabela_produto").innerHTML += parte1 + parte2 + parte3 + parte4 + parte5 + parte6 + parte7 + parte8/*+ parte2 + parte3*/;
					document.getElementById("tabela_produto").innerHTML += "</td></tr>";
					//hora++;
					bg = "#E6E6E6";
				}
			}

		</script>
		<div>
			<font size="2">
				<?php
			$timestamp = mktime(date("H")-4, date("i"), date("s"), date("m"), date("d"), date("Y"), 0);
			$data_hora = gmdate("d/m/Y H:i:s", $timestamp);
			list($data, $hora) = split(' ',$data_hora);
			echo "Ultima atualização em ".$data." às ".$hora;
			//echo "Ultima atualização em ";
			//echo date("d/m/y"); // exibe a data no formato DD/MM/YY
			//echo " às ";
			//echo date("H")-4+date("i:s"); //exibe a hora no formato HH:MM
			?></font>
			<table id="tabela_produto">
				<tr>
					<th >Horário</th>
					<th>Segunda</th>
					<th>Terça</th>
					<th>Quarta</th>
					<th>Quinta</th>
					<th>Sexta</th>
					<th>Sábado</th>
					<th>Domingo</th>
				</tr>
			</table>
		</div>
		<!--<img width="90px" height="50px" src="/academia/images/Legenda.png"/>-->


		<script type=text/javascript>
			<?php

			$js_arrayHora = json_encode($php_arrayHora);
			$js_arrayVagasSegunda = json_encode($php_arrayVagasSegunda);
			$js_arrayVagasTerca = json_encode($php_arrayVagasTerca);
			$js_arrayVagasQuarta = json_encode($php_arrayVagasQuarta);
			$js_arrayVagasQuinta = json_encode($php_arrayVagasQuinta);
			$js_arrayVagasSexta = json_encode($php_arrayVagasSexta);
			$js_arrayVagasSabado = json_encode($php_arrayVagasSabado);
			$js_arrayVagasDomingo = json_encode($php_arrayVagasDomingo);
			$js_arrayMarcados = json_encode($php_arrayMarcados);

			echo "var javascript_arrayHora = ". $js_arrayHora . ";\n";
			echo "var javascript_arrayVagasSegunda = ". $js_arrayVagasSegunda . ";\n";
			echo "var javascript_arrayVagasTerca = ". $js_arrayVagasTerca . ";\n";
			echo "var javascript_arrayVagasQuarta = ". $js_arrayVagasQuarta . ";\n";
			echo "var javascript_arrayVagasQuinta = ". $js_arrayVagasQuinta . ";\n";
			echo "var javascript_arrayVagasSexta = ". $js_arrayVagasSexta . ";\n";
			echo "var javascript_arrayVagasSabado = ". $js_arrayVagasSabado . ";\n";
			echo "var javascript_arrayVagasDomingo = ". $js_arrayVagasDomingo . ";\n";
			echo "var javascript_arrayMarcados = ". $js_arrayMarcados . ";\n";


$js_arrayCotaAlunosVagasSegunda = json_encode($php_arrayCotaAlunosVagasSegunda);
$js_arrayCotaAlunosVagasTerca = json_encode($php_arrayCotaAlunosVagasTerca);
$js_arrayCotaAlunosVagasQuarta = json_encode($php_arrayCotaAlunosVagasQuarta);
$js_arrayCotaAlunosVagasQuinta = json_encode($php_arrayCotaAlunosVagasQuinta);
$js_arrayCotaAlunosVagasSexta = json_encode($php_arrayCotaAlunosVagasSexta);
$js_arrayCotaAlunosVagasSabado = json_encode($php_arrayCotaAlunosVagasSabado);
$js_arrayCotaAlunosVagasDomingo = json_encode($php_arrayCotaAlunosVagasDomingo);


echo "var javascript_arrayCotaAlunosVagasSegunda = ". $js_arrayCotaAlunosVagasSegunda . ";\n";
echo "var javascript_arrayCotaAlunosVagasTerca = ". $js_arrayCotaAlunosVagasTerca . ";\n";
echo "var javascript_arrayCotaAlunosVagasQuarta = ". $js_arrayCotaAlunosVagasQuarta . ";\n";
echo "var javascript_arrayCotaAlunosVagasQuinta = ". $js_arrayCotaAlunosVagasQuinta . ";\n";
echo "var javascript_arrayCotaAlunosVagasSexta = ". $js_arrayCotaAlunosVagasSexta . ";\n";
echo "var javascript_arrayCotaAlunosVagasSabado = ". $js_arrayCotaAlunosVagasSabado . ";\n";
echo "var javascript_arrayCotaAlunosVagasDomingo = ". $js_arrayCotaAlunosVagasDomingo . ";\n";


$js_arrayCotaFuncionariosVagasSegunda = json_encode($php_arrayCotaFuncionariosVagasSegunda);
$js_arrayCotaFuncionariosVagasTerca = json_encode($php_arrayCotaFuncionariosVagasTerca);
$js_arrayCotaFuncionariosVagasQuarta = json_encode($php_arrayCotaFuncionariosVagasQuarta);
$js_arrayCotaFuncionariosVagasQuinta = json_encode($php_arrayCotaFuncionariosVagasQuinta);
$js_arrayCotaFuncionariosVagasSexta = json_encode($php_arrayCotaFuncionariosVagasSexta);
$js_arrayCotaFuncionariosVagasSabado = json_encode($php_arrayCotaFuncionariosVagasSabado);
$js_arrayCotaFuncionariosVagasDomingo = json_encode($php_arrayCotaFuncionariosVagasDomingo);


echo "var javascript_arrayCotaFuncionariosVagasSegunda = ". $js_arrayCotaFuncionariosVagasSegunda . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasTerca = ". $js_arrayCotaFuncionariosVagasTerca . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasQuarta = ". $js_arrayCotaFuncionariosVagasQuarta . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasQuinta = ". $js_arrayCotaFuncionariosVagasQuinta . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasSexta = ". $js_arrayCotaFuncionariosVagasSexta . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasSabado = ". $js_arrayCotaFuncionariosVagasSabado . ";\n";
echo "var javascript_arrayCotaFuncionariosVagasDomingo = ". $js_arrayCotaFuncionariosVagasDomingo . ";\n";

$js_arrayIdHorariosSegunda = json_encode($php_arrayIdHorariosSegunda);
$js_arrayIdHorariosTerca = json_encode($php_arrayIdHorariosTerca);
$js_arrayIdHorariosQuarta = json_encode($php_arrayIdHorariosQuarta);
$js_arrayIdHorariosQuinta = json_encode($php_arrayIdHorariosQuinta);
$js_arrayIdHorariosSexta = json_encode($php_arrayIdHorariosSexta);
$js_arrayIdHorariosSabado = json_encode($php_arrayIdHorariosSabado);
$js_arrayIdHorariosDomingo = json_encode($php_arrayIdHorariosDomingo);

echo "var javascript_arrayIdHorariosSegunda = ". $js_arrayIdHorariosSegunda . ";\n";
echo "var javascript_arrayIdHorariosTerca = ". $js_arrayIdHorariosTerca . ";\n";
echo "var javascript_arrayIdHorariosQuarta = ". $js_arrayIdHorariosQuarta . ";\n";
echo "var javascript_arrayIdHorariosQuinta = ". $js_arrayIdHorariosQuinta . ";\n";
echo "var javascript_arrayIdHorariosSexta = ". $js_arrayIdHorariosSexta . ";\n";
echo "var javascript_arrayIdHorariosSabado = ". $js_arrayIdHorariosSabado . ";\n";
echo "var javascript_arrayIdHorariosDomingo = ". $js_arrayIdHorariosDomingo . ";\n";




			?>

			var linhas = javascript_arrayHora.length;
			novaLinha(javascript_arrayHora,
						8,
						linhas,
						javascript_arrayVagasSegunda,
						javascript_arrayVagasTerca,
						javascript_arrayVagasQuarta,
						javascript_arrayVagasQuinta,
						javascript_arrayVagasSexta,
						javascript_arrayVagasSabado,
						javascript_arrayVagasDomingo);

			var tamMarcados = javascript_arrayMarcados.length;
			selecionaMarcados(javascript_arrayMarcados,tamMarcados);



		</script>
	</form>
	<?php else:?>
	<br/>
	<br/>
	<div  align="center">
		<h1><b><font size=28 color="#008000">FUNCIONAMENTO LIVRE.</font></b></h1>
		<h2>Entrada liberada, desde que existam vagas disponíveis.</h2>
		<h2>Total de Vagas: <?php echo $capacidade ?></h2>
	</div>
	<br/>
	<br/>
	<?php endif; ?>

<?php else:?>
	<br/>
	<br/>
	<div  align="center">
		<h1><b><font size=28 color="#FF0000">ACADEMIA SEM PERFIL ATIVO.</font></b></h1>
		<h2>Volte mais tarde.</h2>
	</div>
	<br/>
	<br/>
<?php endif; ?>
