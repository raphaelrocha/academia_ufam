<?php
/* @var $this CursoController */
/* @var $model Curso */
/* @var $form CActiveForm */

$desabilitaCampo=false;
if($modo=="create"){
	$desabilitaCampo=false;
}elseif($modo=="update"){
	$desabilitaCampo=true;
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'curso-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_CURSO'); ?>
		<?php echo $form->textField($model,'ID_CURSO',array('size'=>10,'maxlength'=>10,'disabled'=>$desabilitaCampo)); ?>
		<?php echo $form->error($model,'ID_CURSO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOME_CURSO'); ?>
		<?php echo $form->textField($model,'NOME_CURSO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOME_CURSO'); ?>
	</div>

	<div class="row buttons" align="center">
		<input type="image" name="confirmar" src="images/accept.png" value="Submit" height="70" width="70" alt="Confirmar"></input>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=curso/admin"><image src="images/cancel.png" height="78" width="73" alt="Cancelar"/></a>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
