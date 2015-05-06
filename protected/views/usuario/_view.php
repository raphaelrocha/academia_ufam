<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('MATRICULA')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->MATRICULA), array('view', 'id'=>$data->MATRICULA)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('NOME')); ?>:</b>
    <?php echo CHtml::encode($data->NOME); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('SOBRENOME')); ?>:</b>
    <?php echo CHtml::encode($data->SOBRENOME); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('SEXO')); ?>:</b>
    <?php echo CHtml::encode($data->SEXO); ?>
    <br />
array(
    		'name'=>'DATANASC',
    		'value' => 'date("d-m-Y",strtotime($data->DATANASC))',
        ),
    <b><?php echo CHtml::encode($data->getAttributeLabel('DATANASC')); ?>:</b>
    <?php echo CHtml::encode($data->DATANASC);?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('CURSO')); ?>:</b>
    <?php echo CHtml::encode($data->CURSO); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
    <?php echo CHtml::encode($data->TIPO); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL')); ?>:</b>
    <?php echo CHtml::encode($data->EMAIL); ?>
    <br />

    <!--
    <b><?php echo CHtml::encode($data->getAttributeLabel('SENHA')); ?>:</b>
    <?php echo CHtml::encode($data->SENHA); ?>
    <br />
    -->


</div>
