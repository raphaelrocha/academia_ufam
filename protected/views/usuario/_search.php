<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'MATRICULA'); ?>
        <?php echo $form->textField($model,'MATRICULA',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'NOME'); ?>
        <?php echo $form->textField($model,'NOME',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'SOBRENOME'); ?>
        <?php echo $form->textField($model,'SOBRENOME',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'SEXO'); ?>
        <?php echo $form->textField($model,'SEXO',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'DATANASC'); ?>
        <?php echo $form->textField($model,'DATANASC'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'CURSO'); ?>
        <?php echo $form->textField($model,'CURSO',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'TIPO'); ?>
        <?php echo $form->textField($model,'TIPO',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'EMAIL'); ?>
        <?php echo $form->textField($model,'EMAIL',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'SENHA'); ?>
        <?php echo $form->textField($model,'SENHA',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
