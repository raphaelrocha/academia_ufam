<?php
/* @var $this UnidadeController */
/* @var $model Unidade */

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
);
?>

<?php
$GLOBALS['nome'] = "Criar nova unidade";
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modo'=>'create')); ?>
