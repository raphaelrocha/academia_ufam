<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUser Usuario */

/*$situacao;
if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor"){
	$situacao = true;
}
else {
	$situacao = false;
}*/

$verifPat = new VerificaPatente;
$situacao = $verifPat->isGestorOrDiretor($modelCurrentUser->TIPO);
$funcionario = $verifPat->isFuncionario($modelCurrentUser->FUNCIONARIO);

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);



$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/configuracao')/*, 'visible'=>$situacao*/),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/new_user.png" width="50px" height="50px" alt="Novo Usuário" title="Adicionar novo usuário"/>', 'url'=>array('usuario/iniciocadastro&value=')/*, 'visible'=>$situacao*/),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados" title="Editar dados de usuário"/>', 'url'=>array('usuario/update&id='.Yii::app()->user->MATRICULA)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check-dir.png" width="50px" height="50px" alt="Arquivos de usuários" title="Arquivos de usuários"/>', 'url'=>array('arquivo/admin')/*, 'visible'=>$situacao*/),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cancel.png" width="50px" height="50px" alt="Ajuda"/>', 'url'=>array("site/configuracao&view=configuracao"), 'visible'=>$situacao)
	//array('label'=>'Logout', 'url'=>array('site/logout')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--<h1>Gerenciar Usuário</h1>-->

<?php
	$GLOBALS['nome'] = "Gerenciar Usuários";
?>


<p>
Nessa área você pode gerenciar os usuários. As operações disponíveis são: Atualizar, Pesquisar, Criar e Deletar usuário.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	//'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'MATRICULA',
		'NOME',
		'SOBRENOME',
		//'SEXO',
		//array(
		//	'name'=>'DATANASC',
		//	'value' => 'date("d-m-Y",strtotime($data->DATANASC))',
		//),
		'FUNCIONARIO',
		'ALUNO',
		//'CURSO',
		'TIPO',
		array(
			'name'=>'SITUACAO',
			'value'=>'$data->SITUACAO'
		),
		//'EMAIL',
		/*
		'SENHA',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
