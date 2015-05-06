<?php
/* @var $this CursoController */
/* @var $model Curso */

$this->breadcrumbs=array(
	'Cursos'=>array('index'),
	$model->ID_CURSO,
);

$this->menu=array(
//	array('label'=>'List Curso', 'url'=>array('index')),
//	array('label'=>'Create Curso', 'url'=>array('create')),
//	array('label'=>'Update Curso', 'url'=>array('update', 'id'=>$model->ID_CURSO)),
//	array('label'=>'Delete Curso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CURSO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_curso.png" width="50px" height="50px" alt="Editar curso" title="Editar dados do curso"/>', 'url'=>array('curso/update&id='.$model->ID_CURSO)),
);
?>

<h2>Dados do Curso #<?php echo $model->ID_CURSO; ?></h2>

<?php
    $GLOBALS['nome'] = "Detalhes do Curso";
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CURSO',
		'NOME_CURSO',
	),
)); ?>
