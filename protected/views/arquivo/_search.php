<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */
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
		<?php echo $form->label($model,'MAT_USUARIO'); ?>
		<?php echo $form->textField($model,'MAT_USUARIO',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_ACADEMIA'); ?>
		<?php echo $form->textField($model,'ID_ACADEMIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PERIODO'); ?>
		<?php echo $form->textField($model,'PERIODO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DATAHORA'); ?>
		<?php echo $form->textField($model,'DATAHORA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMEARQUIVO'); ?>
		<?php echo $form->textField($model,'NOMEARQUIVO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRICAO'); ?>
		<?php echo $form->textField($model,'DESCRICAO',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'URL'); ?>
		<?php echo $form->textField($model,'URL',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
