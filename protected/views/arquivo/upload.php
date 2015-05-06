<?php
$GLOBALS['nome'] = "Upload de arquivo";
//$path = 'C:\xampp\htdocs\academia\arquivos_upload\/';
$diretorio = dir(Yii::app()->params['uploadDir']);
//$link="http://localhost/academia/arquivos_upload/";

if($erro=="sim"){
	echo "
			<script type=\"text/javascript\">
				alert('O ARQUIVO JÁ EXISTE.');
			</script>
		";
}

$verifPat = new VerificaPatente;
$situacao = $verifPat->isGestorOrDiretor(Yii::app()->user->TIPO);
$funcionario = $verifPat->isFuncionario(Yii::app()->user->FUNCIONARIO);

$this->menu=array(
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar"/>', 'url'=>array('admin'), 'visible'=>$situacao),
	// array('label'=>'Gerenciar Períodos', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
	// array('label'=>'Gerar Relatórios', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/update&id='.$id)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="arquivos" title="Arquivos do usuário"/>', 'url'=>array('arquivo/adminUser&id='.$id)/*, 'visible'=>$situacao*/),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados"/>', 'url'=>array('usuario/update&id='.$id)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array("ajuda")),
	//array('label'=>'Logout', 'url'=>array('site/logout')),

);
?>

<?php if(Yii::app()->user->hasFlash('uploadSucess')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('uploadSucess'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('uploadFail')): ?>
<div class="flash-error">
	<?php echo Yii::app()->user->getFlash('uploadFail'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('uploadAlert')): ?>
<div class="flash-notice">
	<?php echo Yii::app()->user->getFlash('uploadAlert'); ?>
</div>

<?php else: ?>

<i><p class="note">Campos com <span class="required"><font size="2" color="red"><i>*</i></font></span> são obrigatórios.</p></i>

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));?>

	</br>
	<div  class="row">
		<?php echo CHtml::label('<b>Selecione um arquivo PDF<font size="1" color="red"><b><i>*</i></b></font></b>', '',array('id'=>'labelCurso')); ?><br/>
		<?php echo CHtml::activeFileField($model, 'ARQUIVO'); ?>
		<br>
		<font size="2" color="red">(Aceito apenas documento em PDF e o nome do arquivo não deve conter espaços ou caracteres especiais)</font>
	</div>
	</br>
	</br>
	<div  class="row">
		<?php echo CHtml::label('<b>Descrição do documento<font size="1" color="red"><b><i>*</i></b></font></b>', '',array('id'=>'labelCurso')); ?>
		<?php //echo CHtml::label('Descrição do arquivo', '',array('id'=>'labelDescricao')); ?>
		</br>
		<?php echo CHtml::activeTextArea($model, 'DESCRICAO',array('rows'=>6, 'cols'=>50)); ?>

	</div>

	</br>
	<?php echo CHtml::submitButton('Enviar', array('name' => 'submit')); ?>
<?php echo CHtml::endForm();?>
</br>

<?php
/*
echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
while($arquivo = $diretorio -> read()){
	echo "<a href='".$link.$arquivo."'  target='_blank'>".$arquivo."</a><br />";
	//echo "<a href='".$path.$arquivo."'  target='_blank'>".$arquivo."</a><br />";
}
$diretorio -> close();
*/
?>

<?php endif; ?>
