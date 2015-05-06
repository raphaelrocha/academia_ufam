<?php
/* @var $this ArquivoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arquivos',
);



if($modo=="geral"){
	$GLOBALS['nome'] = "Gerenciador de arquivos global.";
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/user.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/admin')/*, 'visible'=>$situacao*/),
	);
}else if($modo=="usuario"){
	$GLOBALS['nome'] = "Gerenciador de arquivos do usuário.";
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/update&id='.$id)/*, 'visible'=>$situacao*/),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/user.png" width="50px" height="50px" alt="Usuários" title="Gerenciar Usuários"/>', 'url'=>array('usuario/admin')/*, 'visible'=>$situacao*/),
	);


}

?>

<?php if(Yii::app()->user->hasFlash('uploadSucess')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('uploadSucess'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('uploadFail')): ?>
<div class="flash-erro">
	<?php echo Yii::app()->user->getFlash('uploadFail'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('uploadAlert')): ?>
<div class="flash-notice">
	<?php echo Yii::app()->user->getFlash('uploadAlert'); ?>
</div>

<?php else: ?>

<h1>Arquivos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php endif; ?>
