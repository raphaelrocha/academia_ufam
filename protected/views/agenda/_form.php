<?php
/* @var $this AgendaController */
/* @var $model Agenda */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agenda-form',
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
		<?php echo $form->labelEx($model,'ID_HORARIO'); ?>
		<?php echo $form->textField($model,'ID_HORARIO'); ?>
		<?php echo $form->error($model,'ID_HORARIO'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'DATA_SELECAO'); ?>
		<?php echo $form->textField($model,'DATA_SELECAO'); ?>
		<?php echo $form->error($model,'DATA_SELECAO'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'FALTA'); ?>
		<?php echo $form->textField($model,'FALTA'); ?>
		<?php echo $form->error($model,'FALTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_RESP_MARC'); ?>
		<?php echo $form->textField($model,'ID_RESP_MARC'); ?>
		<?php echo $form->error($model,'ID_RESP_MARC'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Salvar' : 'Save'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
