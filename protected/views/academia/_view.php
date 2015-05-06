<?php
/* @var $this AcademiaController */
/* @var $data Academia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO_CONFIG')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CODIGO_CONFIG), array('view', 'id'=>$data->CODIGO_CONFIG)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAPACIDADE')); ?>:</b>
	<?php echo CHtml::encode($data->CAPACIDADE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORA_ABERTURA')); ?>:</b>
	<?php echo CHtml::encode($data->HORA_ABERTURA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORA_FECHAMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->HORA_FECHAMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPOFUNCIONAMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->TIPOFUNCIONAMENTO); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('DURACAO_PERIODO')); ?>:</b>
	<?php echo CHtml::encode($data->DURACAO_PERIODO); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('DATA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->DATA_INICIO); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('DATA_FIM')); ?>:</b>
	<?php echo CHtml::encode($data->DATA_FIM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SITUACAO')); ?>:</b>
	<?php echo CHtml::encode($data->SITUACAO); ?>
	<br />


</div>