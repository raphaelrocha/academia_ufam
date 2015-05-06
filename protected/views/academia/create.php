<?php
/* @var $this AcademiaController */
/* @var $model Academia */

$this->breadcrumbs=array(
	'Academias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('manage')),
);
?>

<!--<h1>Criar novo perfil de funcionamento da Academia</h1>-->


<?php
	$GLOBALS['nome'] = "Novo Perfil de Funcionamento";
?>

<?php if(Yii::app()->user->hasFlash('academiaCreateSucess')): ?>

<div class="flash-success" align="center">
	<?php echo Yii::app()->user->getFlash('academiaCreateSucess'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('academiaCreateError')): ?>
<div class="flash-error" align="center">
	<?php echo Yii::app()->user->getFlash('academiaCreateError'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('academiaCreateAlert')): ?>
<div class="flash-notice" align="center">
	<?php echo Yii::app()->user->getFlash('academiaCreateAlert'); ?>
</div>

<?php endif; ?>

<?php $this->renderPartial('_form', array('model'=>$model,'acao'=>'create')); ?>
