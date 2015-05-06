<?php
/* @var $this RestricaoController */
/* @var $model Restricao */

	$GLOBALS['nome'] = "Restição de horário";


$this->breadcrumbs=array(
	'Restricaos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Restricao', 'url'=>array('index')),
	array('label'=>'Create Restricao', 'url'=>array('create')),
);

?>


<!--<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>-->
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'restricao-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'ID',
		'SITUACAO',
		'HORAINICIO',
		'HORAFIM',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}'
		),
	),
)); ?>
