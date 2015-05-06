<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */

$this->breadcrumbs=array(
	'Arquivos'=>array('index'),
	'Manage',
);

$GLOBALS['nome'] = "Gerenciador de arquivos.";

$verifPat = new VerificaPatente;
$situacao = $verifPat->isGestorOrDiretor(Yii::app()->user->TIPO);
$funcionario = $verifPat->isFuncionario(Yii::app()->user->FUNCIONARIO);

if($modo=="geral"){
	//$GLOBALS['nome'] = "Todos os arquivos.";
	?>
	<h2>Todos os arquivos enviados.</h2>
	<?php $this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/admin'), 'visible'=>$situacao),
	);
}else if($modo=="usuario"){
	//$GLOBALS['nome'] = "Arquivos do usuário..";
	?>
	<h2>Arquivos do usuário.</h2>
	<?php
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/update&id='.$id)/*, 'visible'=>$situacao*/),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/user.png" width="50px" height="50px" alt="Usuários" title="Gerenciar Usuários"/>', 'url'=>array('usuario/admin'), 'visible'=>$situacao),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('usuario/ajuda')),
		
	);


}


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#arquivo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->


<!--<?php echo CHtml::link('Busca avançada','#',array('class'=>'search-button')); ?>-->
<!--<div class="search-form" style="display:none">-->
<?php
	//$this->renderPartial('_search',array('model'=>$model,));
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

<!--</div><!-- search-form -->

	<?php if($modo=="geral"): ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'arquivo-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			//'ID',
			'MAT_USUARIO',
			//'ID_ACADEMIA',
			'PERIODO',
			'DATAHORA',
			'DESCRICAO',
			//'NOMEARQUIVO',
			array(
				'name'=>'URL',
				'type'=>'raw',
				//'value' => 'CHtml::link($filter->URL,Yii::app()->createUrl("arquivo/UrlProcessing",array("URL"=>$filter->search()->URL)),array("target"=>"_blank"))',
				//'value' => 'CHtml::link($filter->URL,Yii::app()->createUrl("arquivo/UrlProcessing",array("URL"=>$filter->search()->URL)),array("target"=>"_blank"))',
				'value'=> 'CHtml::linkButton($data->NOMEARQUIVO, array(
					"href"=>array($data->URL),
					"target"=>"blank",
					"submit"=>array("arquivo/mostrarArquivo&url=".$data->URL, $_GET),
				))',
			),
			//'URL',
			//array(
			//	'class'=>'CButtonColumn',
			//),
		),
	)); ?>
	<?php elseif($modo=="usuario"): ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'arquivo-grid',
		'dataProvider'=>$dataProvider,
		//'filter'=>$model,
		'columns'=>array(
			//'ID',
			'MAT_USUARIO',
			//'ID_ACADEMIA',
			'PERIODO',
			'DATAHORA',
			'DESCRICAO',
			//'NOMEARQUIVO',
			array(
				'name'=>'URL',
				'type'=>'raw',
				//'value' => 'CHtml::link($filter->URL,Yii::app()->createUrl("arquivo/UrlProcessing",array("URL"=>$filter->search()->URL)),array("target"=>"_blank"))',
				//'value' => 'CHtml::link($filter->URL,Yii::app()->createUrl("arquivo/UrlProcessing",array("URL"=>$filter->search()->URL)),array("target"=>"_blank"))',
				'value'=> 'CHtml::linkButton($data->NOMEARQUIVO, array(
					"href"=>array($data->URL),
					"target"=>"blank",
					"submit"=>array("arquivo/mostrarArquivo&url=".$data->URL, $_GET),
				))',
			),
			//'URL',
			//array(
			//	'class'=>'CButtonColumn',
			//),
		),
	)); ?>
	<?php endif; ?>

<?php endif; ?>
