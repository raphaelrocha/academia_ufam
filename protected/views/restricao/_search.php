<?php
/* @var $this RestricaoController */
/* @var $model Restricao */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SITUACAO'); ?>
		<?php echo $form->textField($model,'SITUACAO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORAINICIO'); ?>
		<?php echo $form->textField($model,'HORAINICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HORAFIM'); ?>
		<?php echo $form->textField($model,'HORAFIM'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->