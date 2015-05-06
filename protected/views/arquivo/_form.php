<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arquivo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'MAT_USUARIO'); ?>
		<?php echo $form->textField($model,'MAT_USUARIO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'MAT_USUARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_ACADEMIA'); ?>
		<?php echo $form->textField($model,'ID_ACADEMIA'); ?>
		<?php echo $form->error($model,'ID_ACADEMIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATAHORA'); ?>
		<?php echo $form->textField($model,'DATAHORA'); ?>
		<?php echo $form->error($model,'DATAHORA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PERIODO'); ?>
		<?php echo $form->textField($model,'PERIODO'); ?>
		<?php echo $form->error($model,'PERIODO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NEMEARQUIVO'); ?>
		<?php echo $form->textField($model,'NOMEARQUIVO',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'NOMEARQUIVO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRICAO'); ?>
		<?php echo $form->textField($model,'DESCRICAO',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'DESCRICAO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'URL'); ?>
		<?php echo $form->textField($model,'URL',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'URL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
