<?php
/* @var $this CursoController */
/* @var $model Curso */

$this->breadcrumbs=array(
	'Cursos'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Curso', 'url'=>array('index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/configuracao')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/new_curso.png" width="50px" height="50px" alt="Adicionar Curso" title="Adicionar curso"/>', 'url'=>array('curso/create')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('curso/ajuda')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#curso-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h1>Manage Cursos</h1>-->

<?php
	$GLOBALS['nome'] = "Gerenciar Cursos";

$dataProvider=new CActiveDataProvider('Curso', array(
	'Pagination' => array (
		'PageSize' => 50 //edit your number items per page here
	),
));
?>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'curso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	//'htmlOptions'=>array('width'=>'20px'),
	'columns'=>array(
		'ID_CURSO',
		'NOME_CURSO',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>
