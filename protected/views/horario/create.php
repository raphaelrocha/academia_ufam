<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $diasArray Horario */
/* @var $turnoArray Horario */

$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Horario', 'url'=>array('index')),
	array('label'=>'Gerenciar Horario', 'url'=>array('admin')),
);
?>

<h1>Create Horario</h1>


<?php
    $GLOBALS['nome'] = "Adicionar Horário";
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'diasArray'=>$diasArray, 'turnoArray'=>$turnoArray)); ?>