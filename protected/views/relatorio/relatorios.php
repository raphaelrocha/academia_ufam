<?php
$GLOBALS['nome'] = "Relatórios";

$this->menu=array(
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar"/>', 'url'=>array('admin'), 'visible'=>$situacao),
	// array('label'=>'Gerenciar Períodos', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
	// array('label'=>'Gerar Relatórios', 'url'=>array('diretor'), 'visible'=>$situacao), //Link temporário
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('relatorio/index')),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file_add.png" width="50px" height="50px" alt="Enviar documento"/>', 'url'=>array('arquivo/upload&id=')/*, 'visible'=>$funcionario*/),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/file-check.png" width="50px" height="50px" alt="arquivos"/>', 'url'=>array('arquivo/adminUser&id=')/*, 'visible'=>$situacao*/),
	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/edit_user.png" width="50px" height="50px" alt="Editar dados"/>', 'url'=>array('usuario/update&id='.$id)),
	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array("ajuda")),
	//array('label'=>'Logout', 'url'=>array('site/logout')),

);

?>

<div>
	<?php echo $link ?>

	<br/>
	<?php echo "<a href='".$link."'  target='_blank'>Relatório de Cursos</a><br />"; ?>
</div>




