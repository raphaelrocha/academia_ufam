<?php
/* @var $this AcademiaController */
/* @var $model Academia */

$this->breadcrumbs=array(
	'Academias'=>array('index'),
	$model->CODIGO_CONFIG=>array('view','id'=>$model->CODIGO_CONFIG),
	'Update',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('manage')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/list.png" width="50px" height="50px" alt="Listar Perfis"/>', 'url'=>array('index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/delete.png" width="50px" height="50px" alt="Excluir Perfil" title="Ecluir Perfil"/>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CODIGO_CONFIG),'confirm'=>'Deseja realmente excluir este perfil?')),
);
?>
<!--
<h2>Editar Perfil <?php echo $model->CODIGO_CONFIG; ?></h2>
-->

<?php
	$GLOBALS['nome'] = "Editar perfil de funcionamento";
?>

<?php $this->renderPartial('_form', array('model'=>$model,'acao'=>'update')); ?>
