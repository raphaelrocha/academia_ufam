<?php
/* @var $this UnidadeController */
/* @var $model Unidade */

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/configuracao')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/create_unidade.png" width="50px" height="50px" alt="Adicionar Unidade" title="Adicionar Unidade	"/>', 'url'=>array('create')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unidade-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$GLOBALS['nome'] = "Gerenciar Unidades";
?>





<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unidade-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_UNIDADE',
		'NOME_UNIDADE',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>
