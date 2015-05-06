<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'ID'); ?>
        <?php echo $form->textField($model,'ID'); ?>
    </div>
    <!--
    <div class="row">
        <?php echo $form->label($model,'DATADIA'); ?>
        <?php echo $form->textField($model,'DATADIA'); ?>
    </div>
    -->
    <div class="row">
        <?php echo $form->label($model,'DIASEMANA'); ?>
        <?php echo $form->textField($model,'DIASEMANA',array('size'=>15,'maxlength'=>15)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'PERIODO'); ?>
        <?php echo $form->textField($model,'PERIODO',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'HORAINICIO'); ?>
        <?php echo $form->textField($model,'HORAINICIO'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'HORAFIM'); ?>
        <?php echo $form->textField($model,'HORAFIM'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'TOTAL_USO'); ?>
        <?php echo $form->textField($model,'TOTAL_USO'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
