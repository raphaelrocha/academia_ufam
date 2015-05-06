<?php
/* @var $this AgendaController */
/* @var $model Agenda */
/* @var $horarioDataProvider Agenda*/
/* @var $modelCurrentUser Agenda */

$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'Marcar Horário', 'url'=>array('create')),
	array('label'=>'Desmarcar Horário', 'url'=>array('admin')),
	array('label'=>'Ajuda', 'url'=>array('')),
);
?>

<h1>Update Agenda <?php echo $model->ID; ?></h1>


<?php
    $GLOBALS['nome'] = "Editar Agenda";
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'horarioDataProvider'=>$horarioDataProvider, 'modelCurrentUser'=>$modelCurrentUser)); ?>