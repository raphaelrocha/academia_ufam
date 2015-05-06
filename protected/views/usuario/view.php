<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUser Usuario */

$verifPat = new VerificaPatente;
$situacao = $verifPat->isGestorOrDiretor($modelCurrentUser->TIPO);
$funcionario = $verifPat->isFuncionario($modelCurrentUser->FUNCIONARIO);

/*
if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor"){
	$situacao = true;

}
else{
	$situacao = false;

}*/


$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->MATRICULA,
);
if ($situacao==true){
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
		//array('label'=>'Gerenciar Períodos', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
		//array('label'=>'Gerar Relatórios', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento" title="Enviar documento"/>', 'url'=>array('arquivo/upload&id='.$model->MATRICULA), 'visible'=>$funcionario),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados" title="Editar dados do usuário"/>', 'url'=>array('usuario/update&id='.$model->MATRICULA)),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array("ajuda")),
		//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancel.png" width="50px" height="50px" alt="Cancelar"/>', 'url'=>array("site/configuracao&view=configuracao")),
		//array('label'=>'Logout', 'url'=>array('site/logout')),
	);
}
else{
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/index')),
		//array('label'=>'Gerenciar Períodos', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
		//array('label'=>'Gerar Relatórios', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento" title="Enviar Documento"/>', 'url'=>array('arquivo/upload&id='.$model->MATRICULA), 'visible'=>$funcionario),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="arquivos" title="Arquivos do Usuário"/>', 'url'=>array('arquivo/adminUser&id='.$model->MATRICULA), 'visible'=>$funcionario/*, 'visible'=>$situacao*/),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados" title="Editar dados do usuário"/>', 'url'=>array('usuario/update&id='.$model->MATRICULA)),
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array("ajuda")),
		//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancel.png" width="50px" height="50px" alt="Cancelar"/>', 'url'=>array("site/index")),
		//array('label'=>'Logout', 'url'=>array('site/logout')),
	);
}


?>

<h2>Visualização do Usuario: <?php echo $model->NOME; ?></h2>

<?php
	$GLOBALS['nome'] = "Dados do Usuário";
?>

<?php
$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
$calendario = new Calendario;
$model->DATANASC = $calendario->dataDbToDataForm($model->DATANASC); //FORMATA DATA DO FORM PRO BANCO

?>
<?php if($model->MATRICULA!=Yii::app()->params['root']):?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'MATRICULA',
			'NOME',
			'SOBRENOME',
			'SEXO',
			'DATANASC',
			'FUNCIONARIO',
			'UNIDADE',
			'ALUNO',
			'CURSO',
			'TIPO',
			'EMAIL',
		),
	)); ?>
<?php elseif($model->MATRICULA==Yii::app()->params['root']):?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'MATRICULA',
			'TIPO',
			'EMAIL',
		),
	)); ?>
<?php endif;?>
</br>



