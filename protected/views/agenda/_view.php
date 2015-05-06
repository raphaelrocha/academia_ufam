<?php
/* @var $this AgendaController */
/* @var $data Agenda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAT_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->MAT_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_HORARIO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_HORARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DATA_SELECAO')); ?>:</b>
	<?php echo CHtml::encode($data->DATA_SELECAO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FALTA')); ?>:</b>
	<?php echo CHtml::encode($data->FALTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_RESP_MARC')); ?>:</b>
	<?php echo CHtml::encode($data->ID_RESP_MARC); ?>
	<br />


</div>
