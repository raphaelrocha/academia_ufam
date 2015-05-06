<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUserTipo Usuario */
/*
$situacao;
if($modelCurrentUserTipo != null && ($modelCurrentUserTipo == "diretor" || $modelCurrentUserTipo == "gestor")) $situacao = true;
else $situacao = false;
*/
$this->breadcrumbs=array(

	'Usuarios'=>array('index'),
	'Create',
);

if(!Yii::app()->user->isGuest){
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
	//	array('label'=>'Gerenciar Períodos', 'url'=>array(''), 'visible'=>$situacao),
	//	array('label'=>'Gerar Relatórios', 'url'=>array(''), 'visible'=>$situacao),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
		//array('label'=>'Logout', 'url'=>array('site/logout')),

	);
}

?>

<?php if(Yii::app()->user->isGuest): ?>
<a href="/academia/index.php">Voltar</a></br></br>
<?php endif; ?>

<!--<h1>Criar Conta</h1>-->
<?php
	$GLOBALS['nome'] = "Criar nova conta";
?>
<!--Passando a variavel dono -->
<?php if($form=="diretor"):?>
	<?php $this->renderPartial('_formDiretor',
							   array('model'=>$model,
									 'dono'=>'create',
									 'cursosArray'=>$cursosArray,
									 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
									 'unidadesArray'=>$unidadesArray,
									 'modo'=>'create',
									 'flagDir'=>$flagDir
									)); ?>
<?php elseif($form=="gestor"):?>
	<?php $this->renderPartial('_formGestor',
							   array('model'=>$model,
									 'dono'=>'create',
									 'cursosArray'=>$cursosArray,
									 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
									 'unidadesArray'=>$unidadesArray,
									 'modo'=>'create',
									 'patenteModel' => ' ',
									 //'flagDir'=>null
									)); ?>
<?php elseif($form=="usuario"):?>
	<?php $this->renderPartial('_formUsuario',
							   array('model'=>$model,
									 'dono'=>'create',
									 'cursosArray'=>$cursosArray,
									 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
									 'unidadesArray'=>$unidadesArray,
									 'modo'=>'create',
									 //'flagDir'=>null
									)); ?>
<?php elseif($form=="public"):?>
	<?php $this->renderPartial('_formPublic',
							   array('model'=>$model,
									 'dono'=>'create',
									 'cursosArray'=>$cursosArray,
									 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
									 'unidadesArray'=>$unidadesArray,
									 'modo'=>'create',
									 //'flagDir'=>null
									)); ?>
<?php endif;?>
