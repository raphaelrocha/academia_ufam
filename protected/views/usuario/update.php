<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $$modelCurrentUserTipo Usuario */

$verifPat = new VerificaPatente;
$situacao = $verifPat->isGestorOrDiretor(Yii::app()->user->TIPO);
$funcionario = $verifPat->isFuncionario(Yii::app()->user->FUNCIONARIO);

//if(strpos(Yii::app()->user->TIPO,"diretor")) $exibeMenuDiretor=true;

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->MATRICULA=>array('view','id'=>$model->MATRICULA),
	'Update',
);

if(!Yii::app()->user->isGuest){
	if ($situacao==true){
		/*$this->menu=array(
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar"/>', 'url'=>array('usuario/admin')),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/new_user.png" width="50px" height="50px" alt="Novo Usuário"/>', 'url'=>array('usuario/create')),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento"/>', 'url'=>array('arquivo/upload&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="Arquivos"/>', 'url'=>array('arquivo/indexUser&id='.$model->MATRICULA)),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados"/>', 'url'=>array('usuario/update&id='.Yii::app()->user->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/agenda.png" width="50px" height="50px" alt="gerenciarGrid"/>', 'url'=>array('gerenciarGrid&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda"/>', 'url'=>array('ajuda')),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancel.png" width="50px" height="50px" alt="Ajuda"/>', 'url'=>array("site/configuracao&view=configuracao"), 'visible'=>$situacao)
			//array('label'=>'Logout', 'url'=>array('site/logout')),
		);*/
		$this->menu=array(
			// array('label'=>'Gerenciar Períodos', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
			// array('label'=>'Gerar Relatórios', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/admin')),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento" title="Enviar documento"/>', 'url'=>array('arquivo/upload&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="arquivos" title="Arquivos"/>', 'url'=>array('arquivo/adminUser&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/logo_calendario.png" width="50px" height="50px" alt="gerenciarGrid" title="Agenda do usuário"/>', 'url'=>array('gerenciarGrid&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/user.png" width="50px" height="50px" alt="Voltar"/>', 'url'=>array('admin')),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda"/>', 'url'=>array('ajuda')),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancel.png" width="50px" height="50px" alt="Ajuda"/>', 'url'=>array("site/configuracao&view=configuracao"))
			//array('label'=>'Logout', 'url'=>array('site/logout')),
		);
	}
	else{

		$this->menu=array(
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/view&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento" title="Enviar Documento"/>', 'url'=>array('arquivo/upload&id='.$model->MATRICULA),'visible'=>$funcionario),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="arquivos" title="Arquivos"/>', 'url'=>array('arquivo/adminUser&id='.$model->MATRICULA),'visible'=>$funcionario),
			//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/logo_calendario.png" width="50px" height="50px" alt="gerenciarGrid" title="Agenda do Usuário"/>', 'url'=>array('gerenciarGrid&id='.$model->MATRICULA)),
			array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
		);
	}
}
?>

<h2>Atualização do Usuario: <?php echo $model->NOME; ?></h2>

<?php
	$GLOBALS['nome'] = "Atualizar Dados";
?>

<!--Passando a variavel dono -->
<?php if($form=="diretor"):?>
<?php $this->renderPartial('_formDiretor',
						   array('model'=>$model,
								 'dono'=>'create',
								 'cursosArray'=>$cursosArray,
								 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 'unidadesArray'=>$unidadesArray,
								 'modo'=>'update',
								 'flagDir'=>null
								)); ?>
<?php elseif($form=="gestor"):?>
<?php $this->renderPartial('_formGestor',
						   array('model'=>$model,
								 'dono'=>'create',
								 'cursosArray'=>$cursosArray,
								 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 'unidadesArray'=>$unidadesArray,
								 'modo'=>'update',
								 'patenteModel' => $patenteModel
								)); ?>
<?php elseif($form=="usuario"):?>
<?php $this->renderPartial('_formUsuario',
						   array('model'=>$model,
								 'dono'=>'create',
								 'cursosArray'=>$cursosArray,
								 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 'unidadesArray'=>$unidadesArray,
								 'modo'=>'update'
								)); ?>
<?php elseif($form=="public"):?>
<?php $this->renderPartial('_formPublic',
						   array('model'=>$model,
								 'dono'=>'create',
								 'cursosArray'=>$cursosArray,
								 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 'unidadesArray'=>$unidadesArray,
								 'modo'=>'update'
								)); ?>
<?php elseif($form=="root"):?>
<?php $this->renderPartial('_formRoot',
						   array('model'=>$model,
								 'dono'=>'create',
								 'cursosArray'=>$cursosArray,
								 'modelCurrentUserTipo'=>$modelCurrentUserTipo,
								 'unidadesArray'=>$unidadesArray,
								 'modo'=>'update',
								)); ?>
<?php endif;?>
<?php //$this->renderPartial('_form', array('model'=>$model,'dono'=>'update','cursosArray'=>$cursosArray, 'modelCurrentUserTipo'=>$modelCurrentUserTipo->TIPO)); ?>
