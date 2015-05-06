<?php
/* @var $this AcademiaController */
/* @var $model Academia */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CODIGO_CONFIG'); ?>
		<?php echo $form->textField($model,'CODIGO_CONFIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CAPACIDADE'); ?>
		<?php echo $form->textField($model,'CAPACIDADE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORA_ABERTURA'); ?>
		<?php echo $form->textField($model,'HORA_ABERTURA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORA_FECHAMENTO'); ?>
		<?php echo $form->textField($model,'HORA_FECHAMENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIPOFUNCIONAMENTO'); ?>
		<?php echo $form->textField($model,'TIPOFUNCIONAMENTO',array('size'=>20,'maxlength'=>20)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'DURACAO_PERIODO'); ?>
		<?php echo $form->textField($model,'DURACAO_PERIODO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DATA_INICIO'); ?>
		<?php echo $form->textField($model,'DATA_INICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DATA_FIM'); ?>
		<?php echo $form->textField($model,'DATA_FIM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SITUACAO'); ?>
		<?php echo $form->textField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->