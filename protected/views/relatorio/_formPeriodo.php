<?php
/* @var $this RelatorioController */
/* @var $model Relatorio */
/* @var $form CActiveForm */
/* @var $unidadesArray RelatorioController */

?>

<?php if(Yii::app()->user->hasFlash('erroRelatorioPeriodo')): ?>
<div class="flash-error" align="center">
	<?php echo Yii::app()->user->getFlash('erroRelatorioPeriodo'); ?>
</div>
<?php endif; ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"/></script>


<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatorio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>-->

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo CHtml::label('Relatório estatístico do período', '',array('id'=>'labelPeriodoDropDown')); ?>
		<?php echo CHtml::label('Selecione um período', '',array('id'=>'labelPeriodoDropDown')); ?>
		<?php //echo $form->checkBox($model,'PERIODO', array('id'=>'periodo_option', 'onClick' => 'enable_periodo_field()')); ?>
		<?php echo $form->dropDownList($model,'PERIODO',$periodosArray, array('id'=>'CampoPeriodo',"disabled"=>false, 'empty' => '--- Escolha um período ---')); ?>
		<input type='submit' value='Gerar' onclick="this.form.target='_blank';return true;">
	</div>



	<div class="row buttons">

	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->
