<?php
/* @var $this AgendaController */
/* @var $model Agenda */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MAT_USUARIO'); ?>
		<?php echo $form->textField($model,'MAT_USUARIO',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_HORARIO'); ?>
		<?php echo $form->textField($model,'ID_HORARIO'); ?>
	</div>
>

	<div class="row">
		<?php echo $form->label($model,'DATA_SELECAO'); ?>
		<?php echo $form->textField($model,'DATA_SELECAO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FALTA'); ?>
		<?php echo $form->textField($model,'FALTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_RESP_MARC'); ?>
		<?php echo $form->textField($model,'ID_RESP_MARC'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
