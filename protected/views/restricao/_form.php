<?php
/* @var $this RestricaoController */
/* @var $model Restricao */
/* @var $form CActiveForm */

$calendario = new Calendario;
$arrayHora = $calendario->getArrayHora();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'restricao-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<script language="javascript" type="text/javascript">

		function Hab() {
			if (document.getElementById("Restricao_SITUACAO_0").checked==true) {
				document.getElementById("CampoHI").disabled=false;
				document.getElementById("CampoHF").disabled=false;
				document.getElementById("almoco").disabled=false;
				//document.getElementById("cota").disabled=false;
				//aparece com o dropdown
				//document.getElementById("Campo").style.display='block';
				//document.getElementById("labelCurso1").style.display='block';
			}
			else if (document.getElementById("Restricao_SITUACAO_1").checked==true) {
				document.getElementById("CampoHI").disabled=true;
				document.getElementById("CampoHF").disabled=true;
				document.getElementById("almoco").disabled=true;
				document.getElementById("almoco").checked=false;
				//document.getElementById("cota").disabled=true;
				///document.getElementById("cota").checked=false;
				//some com o dropdown
				//document.getElementById("Campo").style.display='none';
				//document.getElementById("labelCurso1").style.display='none';

				//document.getElementById("Campo").focus();
			}
			else{
				//document.getElementById("Usuario_ALUNO_1").checked=true;
				document.getElementById("CampoHI").disabled=true;
				document.getElementById("CampoHF").disabled=true;
				document.getElementById("almoco").disabled=true;
				document.getElementById("almoco").checked=false;
				//document.getElementById("cota").disabled=true;
				//document.getElementById("cota").checked=false;
				//some com o dropdown
				//document.getElementById("Campo").style.display='none';
				//document.getElementById("labelCurso1").style.display='none';
			}
		}
	</script>

	<div class="row">
		<?php echo $form->labelEx($model,'SITUACAO'); ?>
		<?php echo $form->radioButtonList($model,'SITUACAO',
										  array('ativo'=>'Ativo',
												'inativo'=>'Inativo',),
										  array(
											  'onClick'=>'Hab()',
											  'labelOptions'=>array('style'=>'display:inline'), // add this code
											  'separator'=>'  ',
										  )  ); ?>
		<?php echo $form->error($model,'SITUACAO'); ?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORAINICIO'); ?>
		<?php echo $form->dropDownList($model,'HORAINICIO',$arrayHora, array('id'=>'CampoHI',/*"disabled"=>"disabled", 'empty' => '--- Selecione  ---'*/)); ?>
		<?php //echo $form->textField($model,'HORAINICIO',array('id'=>'CampoHI')); ?>
		<?php
		//$form->widget('CMaskedTextField', array(
		//	'model' => $model,
		//	'attribute' => 'HORAINICIO',
		//	'mask' => '99:99',
		//	'htmlOptions' => array('size' == 6,'maxlength'=>6),
		//	'id'=>'CampoHI'
		//));
		?>
		<?php echo $form->error($model,'HORAINICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORAFIM'); ?>
		<?php //echo $form->textField($model,'HORAFIM',array('id'=>'CampoHF')); ?>
		<?php echo $form->dropDownList($model,'HORAFIM',$arrayHora, array('id'=>'CampoHF',/*"disabled"=>"disabled", 'empty' => '--- Selecione  ---'*/)); ?>
		<?php
		//$form->widget('CMaskedTextField', array(
		//	'model' => $model,
		//	'attribute' => 'HORAFIM',
		//	'mask' => '99:99',
		//	'htmlOptions' => array('size' == 6,'maxlength'=>6),
		//	'id'=>'CampoHF'
		//));
		?>
		<?php echo $form->error($model,'HORAFIM'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Ativar liberação para almoço.', '',array('id'=>'labelAlmoco')); ?>
		<?php echo $form->checkBox($model,'LIBERA_ALMOCO', array('id'=>'almoco','value'=>'ativo', 'uncheckValue'=>'inativo')); ?>
		<?php //echo CHtml::CheckBox('f_n',true, array ('id'=>'almoco','value'=>'on',)); ?>
	</div>


		<?php //echo CHtml::label('Ativar cotas.', '',array('id'=>'labelCota')); ?>
		<?php //echo $form->checkBox($model,'COTA', array('id'=>'cota','value'=>'ativo', 'uncheckValue'=>'inativo')); ?>
		<br>





	<?php echo "<script> Hab()</script>"; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Salvar'); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->




