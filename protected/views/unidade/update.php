<?php
/* @var $this UnidadeController */
/* @var $model Unidade */

$GLOBALS['nome'] = "Editar unidade";

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->ID_UNIDADE=>array('view','id'=>$model->ID_UNIDADE),
	'Update',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modo'=>'update')); ?>
