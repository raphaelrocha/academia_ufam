<?php
/* @var $this AgendaController */
/* @var $model Agenda */
/* @var $horarioDataProvider Agenda*/
/* @var $modelCurrentUser Agenda */

$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Marcar Horário', 'url'=>array('create')),
	array('label'=>'Desmarcar Horário', 'url'=>array('admin')),
	array('label'=>'Ajuda', 'url'=>array('')),
);
?>

<h1>Create Agenda</h1>


<?php
    $GLOBALS['nome'] = "Marcar Horário";
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'horarioDataProvider'=>$horarioDataProvider, 'modelCurrentUser'=>$modelCurrentUser)); ?>