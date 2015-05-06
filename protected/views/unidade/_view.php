<?php
/* @var $this UnidadeController */
/* @var $data Unidade */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_UNIDADE')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_UNIDADE), array('view', 'id'=>$data->ID_UNIDADE)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOME_UNIDADE')); ?>:</b>
	<?php echo CHtml::encode($data->NOME_UNIDADE); ?>
	<br />


</div>