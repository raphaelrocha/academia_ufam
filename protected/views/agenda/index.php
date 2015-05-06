
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
/* @var $this CursoController */
/* @var $model Curso */


$this->menu=array(

	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
);
?>


<?php
$GLOBALS['nome'] = "Agendamento";
?>


<script>
	window.onload = setupRefresh;

	function setupRefresh() {
		setTimeout("refreshPage('form');", 30000); // milliseconds
	}
	function refreshPage() {
		window.location = location.href;
		//var container = document.getElementById("tabela_produto");
		//var content = container.innerHTML;
		//container.innerHTML= content;
	}
</script>

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

	<?php if(Yii::app()->user->hasFlash('SUCESSO')): ?>

	<div class="flash-success" align="center">
		<?php echo Yii::app()->user->getFlash('SUCESSO'); ?>
	</div>

	<?php elseif(Yii::app()->user->hasFlash('FALHA')): ?>
	<div class="flash-error" align="center">
		<?php echo Yii::app()->user->getFlash('FALHA'); ?>
	</div>

	<?php elseif(Yii::app()->user->hasFlash('gridAlert')): ?>
	<div class="flash-notice" align="center">
		<?php //echo Yii::app()->user->getFlash('gridAlert'); ?>
		<?php if($modelRestricao): ?>
		<b>ATENÇÃO!</b> Você é um funcionário e não deve usar a academia das <b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAINICIO); ?></b> ás <b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAFIM); ?></b>. Para usar neste horário, você deve enviar um documento de autorização <a href="/academia/index.php?r=arquivo/upload&id=<?php echo Yii::app()->user->MATRICULA; ?>"> aqui</a>.
		<?php else: ?>
		<b>ATENÇÃO!</b> Você é um funcionário e não deve usar a academia em horário de expediente. Para usar neste horário, você deve enviar um documento de autorização <a href="/academia/index.php?r=arquivo/upload&id=<?php echo Yii::app()->user->MATRICULA; ?>"> aqui</a>.
		<?php endif; ?>
	</div>

	<?php elseif(Yii::app()->user->hasFlash('gridAlert2')): ?>
	<div class="flash-notice" align="center">
		<?php //echo Yii::app()->user->getFlash('gridAlert'); ?>
		<b>ATENÇÃO!</b> Você é um funcionário e não deve usar a academia em horário de expediente. Para usar neste horário, você deve enviar um documento de autorização <a href="/academia/index.php?r=arquivo/upload&id=<?php echo Yii::app()->user->MATRICULA; ?>"> aqui</a>.
	</div>

	<?php endif; ?>

	<?php if($infoDocOk=="sim"):?>
	<div class="flash-success" align="center">
		Você é um funcionário e já enviou a portaria de autorização.
	</div>
	<?php endif;?>


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

	<!--<h1>Agendamento</h1>-->

	<!----
	<p>As últimas três ou quatro repetições são as que fazem o músculo crescer. Esta área de dor divide os campeões dos que não são. É isto o que falta nas pessoas, ter a coragem para seguir em frente até mesmo através da dor independente do que aconteça.</br>
	<i>Arnold Schwarzenegger</i>
	</p>
	-->

	<div style="background-image:url(css/fa.jpg); border: 1px solid #c2c2c2;" align="center">
		<font size="3">
			<!--<b>Código do Perfil: </b><?php echo $academiaRecord->CODIGO_CONFIG; ?></br>-->
			<!--<b>Abertura: </b><?php echo $academiaRecord->HORA_ABERTURA; ?></br>-->
			<b>Funcionamento diário das </b><font color="blue"><?php echo formataHora($academiaRecord->HORA_ABERTURA); ?></font>
			<b>às </b><font color="blue"><?php echo formataHora($academiaRecord->HORA_FECHAMENTO); ?></font>
			<b>| Período </b><font color="blue"><?php echo $academiaRecord->PERIODO; ?></font>
			<b>| Encerramento em </b><font color="blue"><?php echo $calendario->dataDbToDataForm($academiaRecord->DATA_FIM); ?></font>
			<!--<b>Vagas: </b><?php echo $academiaRecord->CAPACIDADE; ?></br>-->

		</font>
	</div>

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
		$funcionamento;
		?>
		<?php
		/*
		DISTRIBUI AS VAGAS DE CADA HORÁRIO DE ACORDO COM OS DIAS DA SEMANA E O PERFIL SELECIONADO
		*/
		//$modelsGrid = Grid::model()->findAll();
		$modelsAgendaV = AgendaV::model()->findAllByAttributes(array("MAT_USUARIO"=>Yii::app()->user->getState('MATRICULA'),"ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$modelsGrid = Horario::model()->findAllByAttributes(array("ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG),array('order'=>'ID'));

		//echo $academiaRecord->CODIGO_CONFIG."<br>";
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
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasSegunda[]=0;
							}else{
								$php_arrayVagasSegunda[]=$modelGrid->MAX_FUNC;
							}

						}else{
							$php_arrayVagasSegunda[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasSegunda[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasSegunda[]=0;
						}else{
							$php_arrayVagasSegunda[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasSegunda[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="terca"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasTerca[]=0;
							}else{
								$php_arrayVagasTerca[]=$modelGrid->MAX_FUNC;
							}

						}else{
							$php_arrayVagasTerca[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasTerca[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasTerca[]=0;
						}else{
							$php_arrayVagasTerca[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasTerca[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="quarta"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasQuarta[]=0;
							}else{
								$php_arrayVagasQuarta[]=$modelGrid->MAX_FUNC;
							}
						}else{
							$php_arrayVagasQuarta[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasQuarta[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasQuarta[]=0;
						}else{
							$php_arrayVagasQuarta[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasQuarta[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="quinta"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasQuinta[]=0;
							}else{
								$php_arrayVagasQuinta[]=$modelGrid->MAX_FUNC;
							}
						}else{
							$php_arrayVagasQuinta[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasQuinta[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasQuinta[]=0;
						}else{
							$php_arrayVagasQuinta[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasQuinta[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="sexta"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasSexta[]=0;
							}else{
								$php_arrayVagasSexta[]=$modelGrid->MAX_FUNC;
							}

						}else{
							$php_arrayVagasSexta[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasSexta[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasSexta[]=0;
						}else{
							$php_arrayVagasSexta[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasSexta[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="sabado"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasSabado[]=0;
							}else{
								$php_arrayVagasSabado[]=$modelGrid->MAX_FUNC;
							}

						}else{
							$php_arrayVagasSabado[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasSabado[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasSabado[]=0;
						}else{
							$php_arrayVagasSabado[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasSabado[]=$modelGrid->TOTAL_USO;
					}
				}

			}
			if($modelGrid->DIASEMANA=="domingo"){
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						if($semDoc=="sim"){
							if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
								$php_arrayVagasDomingo[]=0;
							}else{
								$php_arrayVagasDomingo[]=$modelGrid->MAX_FUNC;
							}
						}else{
							$php_arrayVagasDomingo[]=$modelGrid->MAX_FUNC;
						}
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$php_arrayVagasDomingo[]=$modelGrid->MAX_ALUNO;
					}
				}else{
					if($semDoc=="sim"){
						if($calendario->checaIntervalo($modelRestricao->HORAINICIO,$modelRestricao->HORAFIM,$modelGrid->HORAINICIO)=="dentro"){
							$php_arrayVagasDomingo[]=0;
						}else{
							$php_arrayVagasDomingo[]=$modelGrid->TOTAL_USO;
						}

					}else{
						$php_arrayVagasDomingo[]=$modelGrid->TOTAL_USO;
					}
				}

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
			var bg = "#93DB70";
			var idAcademia = <?php echo json_encode($academiaRecord->CODIGO_CONFIG); ?>;
			var arrayMap = new Array(); //SALVA A REFERENCIA DE CADA DIA/HORA DA SEMANA.
			var mat = <?php echo json_encode(Yii::app()->user->getState('MATRICULA'));?>;

			/*
				ATUALIZA o FORM A CADA 30 SEGUNDOS
				*/
			/*window.onload = setupRefresh;

			function setupRefresh() {
				setTimeout("refreshPage('form');", 30000); // milliseconds
			}
			function refreshPage() {
				window.location = location.href;
			}*/
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
					var parte1 = "<tr><th>"+javascript_arrayHora[x]+"</th>";
					var parte2 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasSegunda[x]+"</td>";
					arrayMap.push("segunda;"+javascript_arrayHora[x]);
					idCel++;
					var parte3 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasTerca[x]+"</td>";
					arrayMap.push("terca;"+javascript_arrayHora[x]);
					idCel++;
					var parte4 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasQuarta[x]+"</td>";
					arrayMap.push("quarta;"+javascript_arrayHora[x]);
					idCel++;
					var parte5 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasQuinta[x]+"</td>";
					arrayMap.push("quinta;"+javascript_arrayHora[x]);
					idCel++;
					var parte6 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasSexta[x]+"</td>";
					arrayMap.push("sexta;"+javascript_arrayHora[x]);
					idCel++;
					var parte7 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasSabado[x]+"</td>";
					arrayMap.push("sabado;"+javascript_arrayHora[x]);
					idCel++;
					var parte8 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'><font size='2'>vagas - </font>"+javascript_arrayVagasDomingo[x]+"</td>";
					arrayMap.push("domingo;"+javascript_arrayHora[x]);
					idCel++;
					document.getElementById("tabela_produto").innerHTML += parte1 + parte2 + parte3 + parte4 + parte5 + parte6 + parte7 + parte8/*+ parte2 + parte3*/;
					document.getElementById("tabela_produto").innerHTML += "</td></tr>";
					//hora++;
				}
			}
			//Definicação da função que verifica o número de marcações
			(function( $ ){
				$.fn.verificaMarcacao = function(id) {
					if(((id % 7) + 1) == 1){if(seg == 0){ seg = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 2){if(ter == 0){ ter = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 3){if(qua == 0){ qua = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 4){if(qui == 0){ qui = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 5){if(sex == 0){ sex = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 6){if(sab == 0){ sab = 1; return true;} else{ return false;}}
					if(((id % 7) + 1) == 7){if(dom == 0){ dom = 1; return true;} else{ return false;}}
					return this;
				};
			})( jQuery );
			$(document).ready(function(){
				//var sinal = 0;
				$("[id^=cel_]").click(function(){

					var color = $( this ).css( "background-color" );
					var strId = $(this).attr('id') //Id completo
					var intId = strId.match(/\d+/); //apenas o número do Id

					//if(color=="rgb(255, 0, 0)"){
					if(color=="rgb(255, 99, 71)"){
						alert("Não há vagas disponíveis neste horário.");
					}else{
						if($(this).verificaMarcacao(intId)){ //chama a função para verficar se teve mais de uma marcação no mesmo dia
							$(this).css("background-color","rgb(32, 178, 170)");//#20B2AA]
							//INICIO DA REQUISIÇÃO AJAX.
							$.ajax({
								type: 'POST',
								url: '<?php echo Yii::app()->createAbsoluteUrl("site/ajax"); ?>',
								//data: {ACAO: "decrementa_vaga",IDACADEMIA: "1",DIA: "domingo",HORARIO: "08:00:00"},
								data: {ACAO: "decrementa_vaga", IDACADEMIA: idAcademia, MAP: arrayMap[intId], IDCEL: strId, MAT:mat},
								success:function(data){
									//alert("HORÁRIO MARCADO.");
									location.reload("form");//RECARREGA APENAS O FORM.
									//alert(arrayMap[intId]);
								},
								error: function(data) { // if error occured
									alert("Ocorreu um erro, tente novamente.");
									location.reload();//RECARREGA APENAS O FORM.
									//alert(data);
								},

								dataType:'html'
							});
							//FIM DA REQUISIÇÃO AJAX.
						}
						else {
							if(color=="rgb(32, 178, 170)"){
								if(((intId % 7) + 1) == 1){seg = 0;}
								if(((intId % 7) + 1) == 2){ter = 0;}
								if(((intId % 7) + 1) == 3){qua = 0;}
								if(((intId % 7) + 1) == 4){qui = 0;}
								if(((intId % 7) + 1) == 5){sex = 0;}
								if(((intId % 7) + 1) == 6){sab = 0;}
								if(((intId % 7) + 1) == 7){dom = 0;}
								$.ajax({
									type: 'POST',
									url: '<?php echo Yii::app()->createAbsoluteUrl("site/ajax"); ?>',
									//data: {ACAO: "decrementa_vaga",IDACADEMIA: "1",DIA: "domingo",HORARIO: "08:00:00"},
									data: {ACAO: "incrementa_vaga", IDACADEMIA: idAcademia, MAP: arrayMap[intId], IDCEL: strId, MAT:mat},
									success:function(data){
										//alert("HORÁRIO DESMARCADO.");
										location.reload("form");//RECARREGA APENAS O FORM.
										//alert(arrayMap[intId]);
									},
									error: function(data) { // if error occured
										alert("Ocorreu um erro, tente novamente.");
										location.reload();//RECARREGA APENAS O FORM.
										//alert(data);
									},
									dataType:'html'
								});
								$(this).css("background-color"," rgb(147,219,112)");//#ADFF2F VERDE
							}
							else {
								alert("Você não pode selecionar mais de um horário em um mesmo dia da semana");
							}
						}
					}
				});
				$("table tr").each(function() {
					var $ROW = $(this);

					//if ($ROW.find('.vaga:contains("vagas - 0")').css("background-color"," rgb(255, 0, 0)").length) {
					if ($ROW.find('.vaga:contains("vagas - 0")').css("background-color"," rgb(255, 99, 71)").length) {
						console.log('find');

					} else {
						console.log('not find')
						//$ROW.find('.valor').css('color', '#000000');
					}

				});
				$("table tr").each(function() {
					for(x = 0; x < tamMarcados; x++){
						var cel = javascript_arrayMarcados[x];
						var intId = cel.match(/\d+/); //apenas o número do Id
						$("#"+cel).css("background-color","rgb(32, 178, 170)");
						if(((intId % 7) + 1) == 1){seg = 1;}
						else if(((intId % 7) + 1) == 2){ter = 1;}
						else if(((intId % 7) + 1) == 3){qua = 1;}
						else if(((intId % 7) + 1) == 4){qui = 1;}
						else if(((intId % 7) + 1) == 5){sex = 1;}
						else if(((intId % 7) + 1) == 6){sab = 1;}
						else if(((intId % 7) + 1) == 7){dom = 1;}
					}
				});
			});
			function selecionaMarcados(javascript_arrayMarcados,tamMarcados){
				/*for(x = 0; x < tamMarcados; x++){
					var cel = javascript_arrayMarcados[x];
					var intId = cel.match(/\d+/); //apenas o número do Id
					$("#"+cel).css("background-color","rgb(32, 178, 170)");
					if(((intId % 7) + 1) == 1){seg = 1;}
					else if(((intId % 7) + 1) == 2){ter = 1;}
					else if(((intId % 7) + 1) == 3){qua = 1;}
					else if(((intId % 7) + 1) == 4){qui = 1;}
					else if(((intId % 7) + 1) == 5){sex = 1;}
					else if(((intId % 7) + 1) == 6){sab = 1;}
					else if(((intId % 7) + 1) == 7){dom = 1;}
				}*/
			}
		</script>
		<div>
			<!--//INICIO-CSS==================================-->

			<!--//FIM-CSS==================================-->


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
		<img width="90px" height="50px" src="/academia/images/Legenda.png"/>


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
