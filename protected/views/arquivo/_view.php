<?php
/* @var $this ArquivoController */
/* @var $data Arquivo */
?>

<div class="view">
	<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />
	-->
	<b><?php echo CHtml::encode($data->getAttributeLabel('MAT_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->MAT_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERIODO')); ?>:</b>
	<?php echo CHtml::encode($data->PERIODO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ACADEMIA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_ACADEMIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DATAHORA')); ?>:</b>
	<?php echo CHtml::encode($data->DATAHORA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRICAO')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRICAO); ?>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('URL')); ?>:</b>-->
	<b><?php echo CHtml::encode("Documento"); ?>:</b>
	<?php //echo CHtml::encode($data->URL); ?>
	<?php echo CHtml::linkButton($data->NOMEARQUIVO, array(
	//'href'=>array($data->URL),
	'href'=>array($data->URL),
	'target'=>'blank',
	'submit'=>array('arquivo/mostrarArquivo&url='.$data->URL, $_GET),
	));?>

	<br />


</div>
