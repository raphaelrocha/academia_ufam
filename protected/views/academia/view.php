<?php
/* @var $this AcademiaController */
/* @var $model Academia */

$this->breadcrumbs=array(
	'Academias'=>array('index'),
	$model->CODIGO_CONFIG,
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('manage')),
	// array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/list.png" width="50px" height="50px" alt="Listar Academia" title="Listar Perfis da Academia"/>', 'url'=>array('index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit.png" width="50px" height="50px" alt="Editar Perfil" title="Editar Perfil"/>', 'url'=>array('update', 'id'=>$model->CODIGO_CONFIG)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/delete.png" width="50px" height="50px" alt="Excluir Perfil" title="Excluir Perfil"/>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CODIGO_CONFIG),'confirm'=>'Deseja realmente excluir este perfil?')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),	
);
?>

<h2>Perfil da Academia #<?php echo $model->CODIGO_CONFIG; ?></h2>


<?php
    $GLOBALS['nome'] = "Perfil";
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CODIGO_CONFIG',
		'CAPACIDADE',
		'HORA_ABERTURA',
		'HORA_FECHAMENTO',
		'TIPOFUNCIONAMENTO',
		'DURACAO_PERIODO',
		'DATA_INICIO',
		'DATA_FIM',
		'SITUACAO',
	),
)); ?>
