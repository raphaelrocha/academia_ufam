<?php
/* @var $this AcademiaController */
/* @var $model Academia */
/* @var $form CActiveForm */

$calendario = new Calendario;
$arrayHora = $calendario->getArrayHora();

if ($acao == 'create'){
	$codConf="null";
}else{
	$codConf=$model->CODIGO_CONFIG;
}

?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"/></script>



<div class="form">

<?php if(Yii::app()->user->hasFlash('erroHorario')): ?>
	<div class="flash-error" align="center">
		<?php echo Yii::app()->user->getFlash('erroHorario'); ?>
	</div>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'academia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>



	<script>

		$(function() {
			$("#cpf").mask("999.999.999-99",{placeholder:" "});
			//$("#datepicker").mask("00/00/0000",{placeholder:" "});
			$( "#CampoDF" ).datepicker({
				changeMonth: true,
				changeYear: true,
				//dateFormat: 'yy-mm-dd',
				dateFormat: 'dd/mm/yy',
				yearRange: '1910:2030',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				//monthNamesShort: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
			});
			$( "#CampoDI" ).datepicker({
				changeMonth: true,
				changeYear: true,
				//dateFormat: 'yy-mm-dd',
				dateFormat: 'dd/mm/yy',
				yearRange: '1910:2030',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				//monthNamesShort: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
			});
		});
	</script>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'CODIGO_CONFIG'); ?>
		<?php //echo $form->textField($model,'CODIGO_CONFIG',array('size'=>3,'maxlength'=>3, 'numerical', 'integerOnly'=>true)); ?>
		<?php $model->CODIGO_CONFIG = $codConf; echo $form->hiddenField($model,'CODIGO_CONFIG',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'CODIGO_CONFIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CAPACIDADE'); ?>
		<?php echo $form->textField($model,'CAPACIDADE',array('size'=>3,'maxlength'=>3, 'integerOnly'=>true)); ?>
		<font size="2" color="red"><i>(Somente valores pares)</i></font>
		<?php echo $form->error($model,'CAPACIDADE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COTA'); ?>
		<?php echo $form->radioButtonList($model,'COTA',
										  array('sim'=>'Sim',
												'nao'=>'Não'),
										  array(
											  'labelOptions'=>array('style'=>'display:inline'),
											  'separator'=>'  ',
										  )); ?>
		<?php echo $form->error($model,'COTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORA_ABERTURA'); ?>
		<?php //echo $form->textField($model,'HORA_ABERTURA'); ?>
		<?php echo $form->dropDownList($model,'HORA_ABERTURA',$arrayHora, array('id'=>'CampoHI',/*"disabled"=>"disabled", 'empty' => '--- Selecione  ---'*/)); ?>
		<?php
			//$form->widget('CMaskedTextField', array(
			//	'model' => $model,
			//	'attribute' => 'HORA_ABERTURA',
			//	'mask' => '99:99',
			//	'htmlOptions' => array('size' == 6)
			//));
		?>
		<?php echo $form->error($model,'HORA_ABERTURA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORA_FECHAMENTO'); ?>
		<?php echo $form->dropDownList($model,'HORA_FECHAMENTO',$arrayHora, array('id'=>'CampoHF',/*"disabled"=>"disabled", 'empty' => '--- Selecione  ---'*/)); ?>
		<?php //echo $form->textField($model,'HORA_FECHAMENTO'); ?>
		<?php
			//$form->widget('CMaskedTextField', array(
			//	'model' => $model,
			//	'attribute' => 'HORA_FECHAMENTO',
			//	'mask' => '99:99',
			//	'htmlOptions' => array('size' == 6)
			//));
		?>
		<?php echo $form->error($model,'HORA_FECHAMENTO'); ?>
	</div>

	<script language="javascript" type="text/javascript">

		function Hab() {
			if (document.getElementById("Academia_TIPOFUNCIONAMENTO_0").checked==true) {
				document.getElementById("Campo").disabled=false;
				//document.getElementById("CampoDI").disabled=false;
				//document.getElementById("CampoDF").disabled=false;
				//aparece com o dropdown
				document.getElementById("Campo").style.display='block';
				//document.getElementById("CampoDI").style.display='block';
				//document.getElementById("CampoDF").style.display='block';
				document.getElementById("labelDuracao").style.display='block';
				//document.getElementById("labelDI").style.display='block';
				//document.getElementById("labelDF").style.display='block';
			}
			else if (document.getElementById("Academia_TIPOFUNCIONAMENTO_1").checked==true) {
				document.getElementById("Campo").disabled=true;
				//document.getElementById("CampoDI").disabled=true;
				//document.getElementById("CampoDF").disabled=true;
				//some com o dropdown
				document.getElementById("Campo").style.display='none';
				//document.getElementById("CampoDI").style.display='none';
				//document.getElementById("CampoDF").style.display='none';
				document.getElementById("labelDuracao").style.display='none';
				//document.getElementById("labelDI").style.display='none';
				//document.getElementById("labelDF").style.display='none';

				document.getElementById("Campo").focus();
			}
			else{
				document.getElementById("Campo").disabled=true;
				//document.getElementById("CampoDI").disabled=true;
				//document.getElementById("CampoDF").disabled=true;
				//some com o dropdown
				document.getElementById("Campo").style.display='none';
				//document.getElementById("CampoDI").style.display='none';
				//document.getElementById("CampoDF").style.display='none';
				document.getElementById("labelDuracao").style.display='none';
				//document.getElementById("labelDI").style.display='none';
				//document.getElementById("labelDF").style.display='none';

			}
		}
	</script>

	<div class="row">
		<?php echo $form->labelEx($model,'TIPOFUNCIONAMENTO'); ?>
		<?php echo $form->radioButtonList($model,'TIPOFUNCIONAMENTO',
											array('normal'=>'Normal',
												'ferias'=>'Férias'),
											array(
												'onClick'=>'Hab()',
												'labelOptions'=>array('style'=>'display:inline'), // add this code
												'separator'=>'  ',
											)  ); ?>
		<?php //echo $form->textField($model,'TIPOFUNCIONAMENTO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'TIPOFUNCIONAMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DURACAO_PERIODO', array('id'=>'labelDuracao')); ?>
		<?php echo $form->dropDownList($model,'DURACAO_PERIODO',array('00:30:00'=>'30 minutos',
																			'01:00:00'=>'1 hora',
																			'01:30:00'=>'1 hora e 30 minutos',
																			'02:00:00'=>'2 horas'), array('id'=>'Campo',"disabled"=>"disabled")); ?>



	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'DATA_INICIO', array('id'=>'labelDI')); ?>
		<?php //echo $form->dateField($model,'DATA_INICIO', array('id'=>'CampoDI'/*,"disabled"=>"disabled"*/)); ?>
		<?php //echo $form->error($model,'DATA_INICIO'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'DATA_FIM', array('id'=>'labelDF')); ?>
		<?php //echo $form->dateField($model,'DATA_FIM', array('id'=>'CampoDF'/*,"disabled"=>"disabled"*/)); ?>
		<?php //echo $form->error($model,'DATA_FIM'); ?>
		<?php //echo "<script> Hab()</script>"; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATA_INICIO', array('id'=>'labelDI')); ?>
		<?php echo $form->textField($model,'DATA_INICIO', array('id'=>'CampoDI',
															 //'disabled'=>$varItemDisabled,
															 'readonly'=>true,
															 'size'=>11)); ?>
		<?php echo $form->error($model,'DATA_INICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATA_FIM', array('id'=>'labelDF')); ?>
		<?php echo $form->textField($model,'DATA_FIM', array('id'=>'CampoDF',
															 //'disabled'=>$varItemDisabled,
															 'readonly'=>true,
															 'size'=>11)); ?>
		<?php echo $form->error($model,'DATA_FIM'); ?>
		<?php echo "<script> Hab()</script>"; ?>
	</div>


	<div class="row">
		<?php if($acao=='create'): ?>
			<?php //echo $form->labelEx($model,'SITUACAO'); ?>
			<?php //echo $form->textField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
			<?php $model->SITUACAO = "inativo"; echo $form->hiddenField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'SITUACAO'); ?>
		<?php else: ?>
			<?php //echo $form->labelEx($model,'SITUACAO'); ?>
			<?php echo $form->hiddenField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
			<?php //$model->SITUACAO = "inativo"; echo $form->hiddenField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'SITUACAO'); ?>
		<?php endif; ?>
	</div>

	<?php

	?>

	<div class="row buttons" align="center">
		<input type="image" name="confirmar" src="images/accept.png" value="Submit" height="70" width="70" alt="Confirmar"></input>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=academia/manage"><image src="images/cancel.png" height="78" width="73" alt="Cancelar"/></a>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
