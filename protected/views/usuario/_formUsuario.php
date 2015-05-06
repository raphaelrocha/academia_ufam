<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
if($modo=="create"){
	if(Yii::app()->params['sie_connect']=="sim"){
		$varItemDisabled=true;
	}else{
		$varItemDisabled=false;
	}

}else{
	$varItemDisabled=true;
}
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"/></script>

<script>
	$(function() {
		$("#cpf").mask("999.999.999-99",{placeholder:" "});
		//$("#datepicker").mask("00/00/0000",{placeholder:" "});
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			yearRange: '1910:2030',
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			//monthNamesShort: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});
	});
</script>

<script language="javascript" type="text/javascript">
	function selecionaAmbos(){
		document.getElementById("Usuario_ALUNO_2").checked=true
	}
	function Hab() {
		if (document.getElementById("Usuario_ALUNO_0").checked==true) {
			document.getElementById("CampoCurso").disabled=false;
			//aparece com o dropdown
			document.getElementById("CampoCurso").style.display='block';
			document.getElementById("labelCursoDropDown").style.display='block';

			document.getElementById("CampoUnidade").disabled=true;
			//some com o dropdown
			document.getElementById("CampoUnidade").style.display='none';
			document.getElementById("labelUnidadeDropDown").style.display='none';
		}
		else if (document.getElementById("Usuario_ALUNO_1").checked==true) {
			document.getElementById("CampoCurso").disabled=true;
			//some com o dropdown
			document.getElementById("CampoCurso").style.display='none';
			document.getElementById("labelCursoDropDown").style.display='none';
			document.getElementById("CampoCurso").focus();

			document.getElementById("CampoUnidade").disabled=false;
			//aparece com o dropdown
			document.getElementById("CampoUnidade").style.display='block';
			document.getElementById("labelUnidadeDropDown").style.display='block';
		}
		else if (document.getElementById("Usuario_ALUNO_2").checked==true) {
			document.getElementById("CampoCurso").disabled=false;
			//aparece com o dropdown
			document.getElementById("CampoCurso").style.display='block';
			document.getElementById("labelCursoDropDown").style.display='block';
			document.getElementById("CampoCurso").focus();

			document.getElementById("CampoUnidade").disabled=false;
			//aparece com o dropdown
			document.getElementById("CampoUnidade").style.display='block';
			document.getElementById("labelUnidadeDropDown").style.display='block';
		}
		else{
			//document.getElementById("Usuario_ALUNO_1").checked=true;
			document.getElementById("CampoCurso").disabled=true;
			//some com o dropdown
			document.getElementById("CampoCurso").style.display='none';
			document.getElementById("labelCursoDropDown").style.display='none';

			document.getElementById("CampoUnidade").disabled=true;
			//some com o dropdown
			document.getElementById("CampoUnidade").style.display='none';
			document.getElementById("labelUnidadeDropDown").style.display='none';
		}
	}
</script>

<!--<h2>formUsuario</h2>-->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="display: inline">
		<?php echo $form->labelEx($model,'MATRICULA'); ?>
		<?php //echo $form->textField($model,'MATRICULA',array('id'=>'cpf','size'=>15,'maxlength'=>11,'disabled'=>$varItemDisabled)); ?>
		<?php echo $form->textField($model,'MATRICULA',array('id'=>'cpf','size'=>15,'maxlength'=>11,'disabled'=>'disabled')); ?>
		<!--<font size="2" color="red"><i>(Somente números)</i></font>-->
		<?php
		//$form->widget('CMaskedTextField', array(
		//	'model' => $model,
		//	'attribute' => 'MATRICULA',
		//	'mask' => '999.999.999-99',
		//	'htmlOptions' => array('size' == 11, 'disabled'=>$varItemDisabled)
		//));
		?>
		<?php echo $form->error($model,'MATRICULA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOME'); ?>
		<?php echo $form->textField($model,'NOME',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SOBRENOME'); ?>
		<?php echo $form->textField($model,'SOBRENOME',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SOBRENOME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SEXO'); ?>
		<?php echo $form->radioButtonList($model,'SEXO',
										  array('masculino'=>'Masculino',
												'feminino'=>'Feminino'),
										  array(
											  'labelOptions'=>array('style'=>'display:inline'),
											  'separator'=>'  ',
										  )); ?>
		<?php echo $form->error($model,'SEXO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATANASC'); ?>
		<?php echo $form->textField($model,'DATANASC', array('id'=>'datepicker',
															 'disabled'=>$varItemDisabled,
															 'readonly'=>true,
															 'size'=>11)); ?>
		<?php echo $form->error($model,'DATANASC'); ?>
	</div>


	<div class="row">
		<?php echo CHtml::label('Qual relação com a UFAM?<font size="1" color="red"><b><i>*</i></b></font>', '',array('id'=>'labelCurso')); ?>
		<?php echo $form->radioButtonList($model,'ALUNO',
										  array('sim'=>'Aluno',
												'nao'=>'Colaborador',
												'abs'=>'Aluno e colaborador'),/*ambos*/
										  array(
											  //'id' => 'aluno',
											  'onClick'=>'Hab()',
											  'labelOptions'=>array('style'=>'display:inline'),
											  'separator'=>'  ',
										  )  ); ?>
		<?php echo $form->error($model,'ALUNO'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Selecione um curso.<font size="1" color="red"><b><i>*</i></b></font>', '',array('id'=>'labelCursoDropDown')); ?>
		<?php echo $form->dropDownList($model,'CURSO',$cursosArray, array('id'=>'CampoCurso',"disabled"=>"disabled", 'empty' => '--- Escolha um curso ---')); ?>
	</div>

	<div class="row">
		<?php echo CHtml::label('Selecione uma unidade.<font size="1" color="red"><b><i>*</i></b></font>', '',array('id'=>'labelUnidadeDropDown')); ?>
		<?php echo $form->dropDownList($model,'UNIDADE',$unidadesArray, array('id'=>'CampoUnidade',"disabled"=>"disabled", 'empty' => '--- Escolha uma unidade ---')); ?>
	</div>

	<div class="row">
		<?php $form->labelEx($model,'TIPO'); ?>
		<?php $model->TIPO = "usuario"; echo $form->hiddenField($model,'TIPO',array('size'=>10,'maxlength'=>10)); ?>
		<?php $form->error($model,'TIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SENHA'); ?>
		<?php echo $form->passwordField($model,'SENHA',array('size'=>32,'maxlength'=>32)); ?>
		<font size="2" color="red"><i>(Mínimo 03 caracteres)</i></font>
		<?php echo CHtml::label('Repita sua senha<font size="1" color="red"><b><i>*</i></b></font>', '',array('id'=>'labelCurso')); ?>
		<?php echo $form->passwordField($model,'SENHA_REPETE',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'SENHA'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo CHtml::label('e-mail<font size="1" color="red"><b><i>*</i></b></font>', '',array('id'=>'labelCurso')); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>30,'maxlength'=>50, 'id'=>'email')); ?>
		<font size="2" color="red"><i>(Exemplo: seu-email@ufam.edu.br)</i></font>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<!--
	<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	-->

		<div class="row buttons" align="center">
			<input type="image" name="confirmar" src="images/accept.png" value="Submit" height="70" width="70" alt="Confirmar"></input>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=usuario/view&id=<?php echo $model->MATRICULA; ?>"><image src="images/cancel.png" height="78" width="73" alt="Cancelar"/></a>
	</div>



	<?php //if($modo=="update"):?>
		<?php if(($model->ALUNO=="sim")&&($model->FUNCIONARIO=="sim")):?>
			<?php echo "<script> selecionaAmbos()</script>"; ?>
		<?php endif;?>
	<?php //endif;?>

	<?php echo "<script> Hab()</script>"; ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
