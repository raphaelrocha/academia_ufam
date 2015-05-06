<?php
/* @var $this RestricaoController */
/* @var $model Restricao */

$GLOBALS['nome'] = "Ajustar restrição";

$this->breadcrumbs=array(
	'Restricaos'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('academia/manage')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/list.png" width="50px" height="50px" alt="Listar Perfis"/>', 'url'=>array('index')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/delete.png" width="50px" height="50px" alt="Excluir Perfil"/>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CODIGO_CONFIG),'confirm'=>'Deseja realmente excluir este perfil?')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>
