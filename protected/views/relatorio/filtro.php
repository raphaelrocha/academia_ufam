<?php
/* @var $this RelatorioController */
/* @var $model RelatorioController */
/* @var $cursosArray Curso*/
/* @var $periodosArray RelatorioController*/



$this->breadcrumbs=array(
/*		'Relatorios'=>array('index'),
		$model->ID=>array('filtro','id'=>$model->ID),
		'Relatorio',*/
);

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/configuracao')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),

);
?>

<h2> Escolha do filtro </h2>

<?php
	$GLOBALS['nome'] = "Relatórios";
?>

<div style="border: 1px solid #c2c2c2;">
	<?php  $this->renderPartial('_formCpf', array( 'model'=>$modelRelatorioCpf/*, 'cursosArray'=>$cursosArray, 'unidadesArray'=>$unidadesArray, 'periodosArray'=>$periodosArray, 'diasArray'=>$diasArray, 'turnoArray'=>$turnoArray */)); ?>
</div>

<br/>
<div style="border: 1px solid #c2c2c2;">
	<?php  $this->renderPartial('_formPeriodo', array( 'model'=>$modelRelatorioPeriodo,/* 'cursosArray'=>$cursosArray, 'unidadesArray'=>$unidadesArray, */'periodosArray'=>$periodosArray/*, 'diasArray'=>$diasArray, 'turnoArray'=>$turnoArray */)); ?>
</div>