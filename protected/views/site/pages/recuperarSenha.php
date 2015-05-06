<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Recuperar Senha';
$this->breadcrumbs=array(
	'Contato',
);
?>
<a href="/academia/index.php">Voltar</a><br/><br/>
<h1>Recuperar Senha</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Se você esqueceu sua senha, siga as instruções para recuperá-la.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'matricula'); ?>
		<?php $form->widget('CMaskedTextField', array(
			'model' => $model,
			'attribute' => 'matricula',
			'mask' => '999.999.999-99',
			'htmlOptions' => array('size' == 11)
		)); ?>
		<?php echo $form->error($model,'matricula'); ?>
	</div>
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	-->
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
			</br>
		<?php echo CHtml::label('O que você lê na imagem?', '',array('id'=>'labelCaptcha')); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Por favor, transcreva o que você lê na imagem.
		<br/>Não importa diferenciar Maiúsculas e Munúsculas.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar',array('confirm' => 'Uma mensagem será enviada para seu e-mail cadastrado.')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
