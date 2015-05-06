<?php
/* @var $this CursoController */
/* @var $data Curso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CURSO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CURSO), array('view', 'id'=>$data->ID_CURSO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOME_CURSO')); ?>:</b>
	<?php echo CHtml::encode($data->NOME_CURSO); ?>
	<br />


</div>