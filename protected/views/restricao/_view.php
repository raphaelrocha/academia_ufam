<?php
/* @var $this RestricaoController */
/* @var $data Restricao */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SITUACAO')); ?>:</b>
	<?php echo CHtml::encode($data->SITUACAO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->HORAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORAFIM')); ?>:</b>
	<?php echo CHtml::encode($data->HORAFIM); ?>
	<br />


</div>