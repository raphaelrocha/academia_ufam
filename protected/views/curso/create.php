<?php
/* @var $this CursoController */
/* @var $model Curso */

$this->breadcrumbs=array(
	'Cursos'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Curso', 'url'=>array('index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('curso/ajuda')),

);
?>

<!--<h1>Create Curso</h1>-->
<?php
	$GLOBALS['nome'] = "Cadastrar Curso";
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modo'=>'create')); ?>
