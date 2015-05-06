<?php
/* @var $this UnidadeController */
/* @var $model Unidade */

$GLOBALS['nome'] = "Detalhes da unidade";

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->ID_UNIDADE,
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'Create Unidade', 'url'=>array('create')),
);
?>

<h1>Dados da unidade #<?php echo $model->NOME_UNIDADE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_UNIDADE',
		'NOME_UNIDADE',
	),
)); ?>
