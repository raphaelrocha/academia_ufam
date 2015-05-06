<?php
/* @var $this CursoController */
/* @var $model Curso */

$this->breadcrumbs=array(
	'Cursos'=>array('index'),
	$model->ID_CURSO=>array('view','id'=>$model->ID_CURSO),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Curso', 'url'=>array('index')),
//	array('label'=>'Create Curso', 'url'=>array('create')),
//	array('label'=>'View Curso', 'url'=>array('view', 'id'=>$model->ID_CURSO)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('curso/ajuda')),

);
?>

<h2>Editar Curso <?php echo $model->ID_CURSO; ?></h2>

<?php
	$GLOBALS['nome'] = "Editar Curso";
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modo'=>'update')); ?>
