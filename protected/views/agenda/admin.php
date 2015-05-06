<?php
/* @var $this AgendaController */
/* @var $model Agenda */

$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Marcar Horário', 'url'=>array('create')),
	array('label'=>'Desmarcar Horário', 'url'=>array('admin')),
	array('label'=>'Ajuda', 'url'=>array('')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#agenda-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Agendas</h1>

<?php
	$GLOBALS['nome'] = "Gerenciar Agendas";
?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'agenda-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'MAT_USUARIO',
		'ID_HORARIO',
		'DATA_SELECAO',
		'FALTA',
		'ID_RESP_MARC',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
