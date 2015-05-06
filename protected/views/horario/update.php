<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs=array(
	'Horarios'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);



$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('horario/index&value='.$model->ID_ACADEMIA)),
	//array('label'=>'List Horario', 'url'=>array('index')),
	//array('label'=>'Create Horario', 'url'=>array('create')),
	//array('label'=>'View Horario', 'url'=>array('view', 'id'=>$model->ID)),
	//array('label'=>'Manage Horario', 'url'=>array('admin')),
);
?>

<?php
$GLOBALS['nome'] = "Ajustar cotas";
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //$this->renderPartial('_form', array('model'=>$model, 'diasArray'=>$diasArray, 'turnoArray'=>$turnoArray)); ?>

