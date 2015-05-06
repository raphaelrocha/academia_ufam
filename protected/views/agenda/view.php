<?php
/* @var $this AgendaController */
/* @var $model Agenda */

$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Agenda', 'url'=>array('index')),
	array('label'=>'Create Agenda', 'url'=>array('create')),
	array('label'=>'Update Agenda', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Agenda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agenda', 'url'=>array('admin')),
);
?>

<h1>View Agenda #<?php echo $model->ID; ?></h1>


<?php
	$GLOBALS['nome'] = "Detalhes da Agenda";
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'MAT_USUARIO',
		'ID_HORARIO',
		'DATA_SELECAO',
		'FALTA',
		'ID_RESP_MARC'
	),
)); ?>
