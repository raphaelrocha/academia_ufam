
<head>
	<!--MICROSOFT-->
	<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>-->
	<!--GOOGLE-->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<!--LOCAL-->
	<script src="jquery/jquery-1.11.2.min.js"></script> <!--usando o jquery local no diretório raiz do projeto-->
</head>

<?php
$model=$this->loadModel($id);
$GLOBALS['nome'] = "Agenda do usuário ".$model->NOME." ".$model->SOBRENOME;

$this->menu=array(
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar"/>', 'url'=>array('update&id='.$id)/*, 'visible'=>$situacao*/),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')/*, 'visible'=>$situacao*/),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/new_user.png" width="50px" height="50px" alt="Novo Usuário"/>', 'url'=>array('usuario/create')/*, 'visible'=>$situacao*/),
	//  array('label'=>'Gerar Relatórios', 'url'=>array('')/*, 'visible'=>$situacao*/),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados" title="Editar dados do usuário"/>', 'url'=>array('usuario/update&id='.$id)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
	//array('label'=>'Logout', 'url'=>array('site/logout')),
);
?>



<script>
	window.onload = setupRefresh;

	function setupRefresh() {
		setTimeout("refreshPage('form');", 30000); // milliseconds
	}
	function refreshPage() {
		window.location = location.href;
	}
</script>
<?php

/* @var $this SiteController */

//include 'ajax.php';
$this->pageTitle=Yii::app()->name;
?>
<?php if ($academiaRecord!==null):?>
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
		//echo $id;
		//$modelsAgendaV = AgendaV::model()->findAllByAttributes(array("MAT_USUARIO"=>Yii::app()->user->getState('MATRICULA'),"ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$modelsAgendaV = AgendaV::model()->findAllByAttributes(array("MAT_USUARIO"=>$id,"ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$modelsGrid = Horario::model()->findAllByAttributes(array("ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG),array('order'=>'ID'));
		foreach($modelsAgendaV as $modelAgendaV)
		{
			//echo $modelAgendaV->MAT_USUARIO." ".$modelAgendaV->ID_ACADEMIA." ".$modelAgendaV->HORAINICIO." ".$modelAgendaV->DIASEMANA." ".$modelAgendaV->PRESENCA." ".$modelAgendaV->FALTA." ".$modelAgendaV->IDCEL."<br>";
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
			}
			if($modelGrid->DIASEMANA=="terca"){
				$php_arrayVagasTerca[]=$modelGrid->TOTAL_USO;
			}
			if($modelGrid->DIASEMANA=="quarta"){
				$php_arrayVagasQuarta[]=$modelGrid->TOTAL_USO;
			}
			if($modelGrid->DIASEMANA=="quinta"){
				$php_arrayVagasQuinta[]=$modelGrid->TOTAL_USO;
			}
			if($modelGrid->DIASEMANA=="sexta"){
				$php_arrayVagasSexta[]=$modelGrid->TOTAL_USO;
			}
			if($modelGrid->DIASEMANA=="sabado"){
				$php_arrayVagasSabado[]=$modelGrid->TOTAL_USO;
			}
			if($modelGrid->DIASEMANA=="domingo"){
				$php_arrayVagasDomingo[]=$modelGrid->TOTAL_USO;
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
			var mat = <?php echo json_encode($id);?>;

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
					var parte2 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasSegunda[x]+"]</td>";
					arrayMap.push("segunda;"+javascript_arrayHora[x]);
					idCel++;
					var parte3 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasTerca[x]+"]</td>";
					arrayMap.push("terca;"+javascript_arrayHora[x]);
					idCel++;
					var parte4 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasQuarta[x]+"]</td>";
					arrayMap.push("quarta;"+javascript_arrayHora[x]);
					idCel++;
					var parte5 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasQuinta[x]+"]</td>";
					arrayMap.push("quinta;"+javascript_arrayHora[x]);
					idCel++;
					var parte6 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasSexta[x]+"]</td>";
					arrayMap.push("sexta;"+javascript_arrayHora[x]);
					idCel++;
					var parte7 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasSabado[x]+"]</td>";
					arrayMap.push("sabado;"+javascript_arrayHora[x]);
					idCel++;
					var parte8 = "<td id='cel_"+idCel+"' bgcolor='"+bg+"' class='vaga'>["+javascript_arrayVagasDomingo[x]+"]</td>";
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

					if(color=="rgb(255, 0, 0)"){
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
					if ($ROW.find('.vaga:contains("[0]")').css("background-color"," rgb(255, 0, 0)").length) {
						console.log('find')

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
			<style type="text/css">

				table
				{
					font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
					width:100%;
					border-collapse: collapse;
				}
				table, td, th
				{
					border: 1px solid black;
					text-align: center;
				}
				th {
					height: 20px;
					text-align: center;
					font-size:1.2em;
					//padding-top:5px;
					padding-bottom:4px;
					background-color:#2E82FF;
					color:#fff;
				}
				td {
					height: 25px;
					//vertical-align: bottom;
					text-align: center;
					color:#fff;
					font-size:1.2em;
				}
				mousechange:hover {
					cursor:pointer;
				}

			</style>
			<!--//FIM-CSS==================================-->
			<font size="2"><?php
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
