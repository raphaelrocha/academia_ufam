<?php
/* @var $this AcademiaController */
/* @var $model Academia */

$this->breadcrumbs=array(
	'Academias'=>array('index'),
	'Create',
);

$calendario = new Calendario;
$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));

$this->menu=array(
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('site/configuracao')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/list.png" width="50px" height="50px" alt="Listar Academia"/>', 'url'=>array('index')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/add.png" width="50px" height="50px" alt="Criar Perfil" title="Criar Novo Perfil"/>', 'url'=>array('create')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/cartao.png" width="50px" height="50px" alt="Configurar restricao" title="Configurar Restrições de Funcionários"/>', 'url'=>array('restricao/update&id=1')),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
);
?>

<!--<h1>Selecionar perfil de funcionamento da Academia</h1>-->

<?php if(Yii::app()->user->hasFlash('SUCESSO')): ?>

<div class="flash-success" align="center">
	<?php echo Yii::app()->user->getFlash('SUCESSO'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('FALHA')): ?>
<div class="flash-error" align="center">
	<?php echo Yii::app()->user->getFlash('FALHA'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('restricaoAlert')): ?>
<div class="flash-notice" align="center">
	<b>ATENÇÃO! </b><?php echo Yii::app()->user->getFlash('restricaoAlert'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('restricaoAlert2')): ?>
<div class="flash-notice" align="center">
	<b>ATENÇÃO!</b> A restrição de horário para funcionários, está ATIVADA. [<b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAINICIO); ?></b> às <b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAFIM); ?>]
	<br/>
	Horário de almoço está liberado para o uso.
</div>

<?php elseif(Yii::app()->user->hasFlash('restricaoAlert3')): ?>
<div class="flash-notice" align="center">
	<b>ATENÇÃO!</b> A restrição de horário para funcionários, está ATIVADA. [<b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAINICIO); ?></b> às <b><?php echo $calendario->getHoraFormatada($modelRestricao->HORAFIM); ?>]
	<br/>
	Horário de almoço não está liberado para o uso.
</div>

<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('erroDeleteAcademia')): ?>
	<div class="flash-error" align="center">
		<?php echo Yii::app()->user->getFlash('erroDeleteAcademia'); ?>
	</div>
<?php endif; ?>


<?php
	$GLOBALS['nome'] = "Selecionar Perfil de Funcionamento";
?>


<?php $this->renderPartial('_formManage', array('model'=>$model, 'dataProvider'=>$dataProvider)); ?>


<!--
</br></br>
<a href="index.php?r=site/page&view=testeData"> teste auto-preenchimento da tabela horário</a>
-->
