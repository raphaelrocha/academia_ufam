<?php
/* @var $this CursoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cursos',
);

$this->menu=array(
//	array('label'=>'Create Curso', 'url'=>array('create')),
	array('label'=>'Gerenciar Cursos', 'url'=>array('admin')),
);
?>

<!--<h1>Cursos</h1>-->

<?php
    $GLOBALS['nome'] = "Cursos";
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
