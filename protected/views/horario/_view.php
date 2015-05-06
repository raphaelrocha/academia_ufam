<?php
/* @var $this HorarioController */
/* @var $data Horario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ACADEMIA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_ACADEMIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIASEMANA')); ?>:</b>
	<?php echo CHtml::encode($data->DIASEMANA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERIODO')); ?>:</b>
	<?php echo CHtml::encode($data->PERIODO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->HORAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HORAFIM')); ?>:</b>
	<?php echo CHtml::encode($data->HORAFIM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_USO')); ?>:</b>
	<?php echo CHtml::encode($data->TOTAL_USO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAX_ALUNO')); ?>:</b>
	<?php echo CHtml::encode($data->MAX_ALUNO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAX_FUNC')); ?>:</b>
	<?php echo CHtml::encode($data->MAX_FUNC); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('MAX_ALUNO')); ?>:</b>
	<?php echo CHtml::encode($data->MAX_ALUNO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAX_FUNC')); ?>:</b>
	<?php echo CHtml::encode($data->MAX_FUNC); ?>
	<br />

	*/ ?>

</div>
