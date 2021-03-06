<?php
/* @var $this HorarioController */
/* @var $model Horario */
/* @var $form CActiveForm */
?>

<head>
	<!--MICROSOFT-->
	<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>-->
	<!--GOOGLE-->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<!--LOCAL-->
	<script src="jquery/jquery-1.11.2.min.js"></script> <!--usando o jquery local no diretório raiz do projeto-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css" />
</head>

<script>
	$(document).ready(function(){
		$(function(){
			$("#btEsquerda").click(function(e){
				e.preventDefault();
				var maxAluno = parseInt($("#maxaluno").val());
				var maxFunc = parseInt($("#maxfunc").val());
				if(maxAluno>=0 && maxFunc>0){
					maxAluno++;
					maxFunc--;
				}

				$("#maxaluno").val(maxAluno);
				$("#maxfunc").val(maxFunc);
				//alert("FUN ESQ ");
				/*$.ajax({
					type: "POST",
					url: "get_login.php",
					data: {'getmessage': getmessage},
					dataType: "json",
					success: function(data) {
						$("#message_ajax").html("<div class='successMessage'>" + data.message +"</div>");
					}
				});*/
			});
			$("#btDireita").click(function(e){
				e.preventDefault();
				var maxAluno = parseInt($("#maxaluno").val());
				var maxFunc = parseInt($("#maxfunc").val());
				if(maxAluno>0 && maxFunc>=0){
					maxAluno--;
					maxFunc++;
				}
				$("#maxaluno").val(maxAluno);
				$("#maxfunc").val(maxFunc);

				//alert("FUN DIR");
				/*$.ajax({
					type: "POST",
					url: "get_login.php",
					data: {'getmessage': getmessage},
					dataType: "json",
					success: function(data) {
						$("#message_ajax").html("<div class='successMessage'>" + data.message +"</div>");
					}
				});*/
			});
		});
	});
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'horario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>-->

	<?php $calendario = new Calendario;
	$nomeDia = $calendario->converteNomeDia($model->DIASEMANA);
	$horaIni = $calendario->getHoraFormatada($model->HORAINICIO);
	$horaFim = $calendario->getHoraFormatada($model->HORAFIM);
	?>
	<b>
		<?php echo $nomeDia; ?>
		&nbspdas&nbsp
		<?php echo $horaIni; ?>
		&nbspàs&nbsp
		<?php echo $horaFim; ?>
	</b>
	<br><br>
	<font size="2" ><b>TOTAL DE VAGAS DISPONÍVEIS = <?php echo $model->TOTAL_USO?></b></font>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'ID_ACADEMIA'); ?>
		<?php //echo $form->textField($model,'ID_ACADEMIA',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'ID_ACADEMIA'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'DIASEMANA'); ?>
		<?php //echo $form->textField($model,'DIASEMANA',array('size'=>15,'maxlength'=>15)); ?>
		<?php //echo $form->error($model,'DIASEMANA'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'PERIODO'); ?>
		<?php //echo $form->textField($model,'PERIODO',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'PERIODO'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'HORAINICIO'); ?>
		<?php //echo $form->textField($model,'HORAINICIO'); ?>
		<?php //echo $form->error($model,'HORAINICIO'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'HORAFIM'); ?>
		<?php //echo $form->textField($model,'HORAFIM'); ?>
		<?php //echo $form->error($model,'HORAFIM'); ?>
	</div>

	<div class="row">
		<br>
		<?php //echo $form->labelEx($model,'TOTAL_USO'); ?>
		<?php echo $form->hiddenField($model,'TOTAL_USO',array('readonly'=>true)); ?>
		<?php //echo $form->error($model,'TOTAL_USO'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'MAX_ALUNO'); ?>
		<?php //echo $form->textField($model,'MAX_ALUNO'); ?>
		<?php //echo $form->error($model,'MAX_ALUNO'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'MAX_FUNC'); ?>
		<?php //echo $form->textField($model,'MAX_FUNC'); ?>
		<?php //echo $form->error($model,'MAX_FUNC'); ?>
	</div>

	<div style="border: 1px solid #c2c2c2;">
	<?php echo CHtml::label('Calibrar cota de vagas para o dia e hora selecionados', '',array('id'=>'labelAjuste')); ?>
	<br>
	<teble style="width:100%">
		<tr>
			<td>&nbsp&emsp;&emsp;&emsp;&nbsp</td>
			<td><?php echo CHtml::label('Alunos', '',array('id'=>'labelAlunos','style'=>'display:inline')); ?></td>
			&emsp;&nbsp&nbsp
			<td><?php echo CHtml::label('Servidores', '',array('id'=>'labelServidores','style'=>'display:inline')); ?></td>
			<td>&nbsp</td>
		</tr>
		<br>
		<tr>
			<td><?php echo CHtml::button('<<',array('id'=>'btEsquerda')); ?></td>

			&nbsp
			<td><?php echo $form->textField($model,'MAX_ALUNO',array('id'=>'maxaluno','size'=>5,'maxlength'=>5,'style'=>'display:inline','readonly'=>true)); ?></td>
			&nbsp&nbsp
			<td><?php echo $form->textField($model,'MAX_FUNC',array('id'=>'maxfunc','size'=>5,'maxlength'=>5,'style'=>'display:inline','readonly'=>true)); ?></td>
			&nbsp
			<td><?php echo CHtml::button('>>',array('id'=>'btDireita', 'onClick'=>'Hab()')); ?></td>
		</tr>
	</teble>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
