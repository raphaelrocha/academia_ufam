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

<?php if(!Yii::app()->user->isGuest): ?>
	<?php if($alert=="existe"):?>
		<div class="flash-notice" align="center">
			<b>AVISO!</b> Já existe um cadastro na academia.

		</div>
	<?php endif;?>
<?php else:?>
	<?php if($alert=="existe"):?>
		<div class="flash-notice" align="center">
			<b>AVISO!</b> Já existe um cadastro na academia.<br/>
			Para entrar no sistema clique <a href="/academia/index.php?r=site/login&value=<?php echo $modelBusca->MATRICULA; ?>">aqui</a>.<br/>
			Para recuperar a sua senha clique <a href="/academia/index.php?r=site/recuperarSenha&value=<?php echo $modelBusca->MATRICULA; ?>">aqui</a>.
		</div>
	<?php endif;?>
<?php endif;?>

<?php if($alert=="sim"): ?>
	<div class="flash-error" align="center">
		<b>ERRO!</b> Verifique se o CPF informado está correto.
	</div>
<?php endif;?>





<!--<h1>Criar Conta</h1>-->
<?php
$GLOBALS['nome'] = "Iniciando cadastro";
?>

<p>Por favor, informe seu CPF para validação no sistema.</p>

<?php $this->renderPartial('_formBuscaSie',
						   array('modelBusca'=>$modelBusca,
								 //'dono'=>'create',
								 //'cursosArray'=>$cursosArray,
								 //'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 //'unidadesArray'=>$unidadesArray,
								 //'modo'=>'create'
								)); ?>
