<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */

$this->breadcrumbs=array(
	'Arquivos'=>array('index'),
	$model->ID,
);

$GLOBALS['nome'] = "Gerenciador de arquivos.";

$this->menu=array(
	array('label'=>'List Arquivo', 'url'=>array('index')),
	array('label'=>'Create Arquivo', 'url'=>array('create')),
	array('label'=>'Update Arquivo', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Arquivo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Arquivo', 'url'=>array('admin')),
);
?>

<h1>View Arquivo #<?php //echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'MAT_USUARIO',
		'ID_ACADEMIA',
		'DATAHORA',
		'DESCRICAO',
		'NOMEARQUIVO',
		'URL',
		'PERIODO',
	),
)); ?>
