<?php
/* @var $this RelatorioController */
/* @var $model Relatorio */
/* @var $form CActiveForm */
/* @var $unidadesArray RelatorioController */

?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"/></script>

<script language="javascript" type="text/javascript">

	function enable_cpf_field(){

		//alert("entrou nessa merda");

		if(document.getElementById("cpf_field_cb").checked==true) {
			//alert("entrou nessa merda if");
			document.getElementById("cpf_field").disabled=false;

		} else {
			//alert("entrou nessa merda else");
			document.getElementById("cpf_field").disabled=true;
		}
	}
	function enable_date_field() {

	/*	if(document.getElementById("cpf_field_cb").checked==true) {
			document.getElementById("cpf_field").disable=false;
		} else {
			document.getElementById("cpf_field").disable=true;
		} */

		if(document.getElementById("data_option").checked==true) {
			document.getElementById("data_ini_field").disabled=false;
			document.getElementById("data_fim_field").disabled=false;
		} else {
			document.getElementById("data_ini_field").disabled=true;
			document.getElementById("data_fim_field").disabled=true;
		}
	}

	function enable_course_field() {
		if(document.getElementById("course_option").checked==true) {
			document.getElementById("CampoCurso").disabled=false;
		} else {
			document.getElementById("CampoCurso").disabled=true;
		}
	}

	function enable_unidade_field() {
		if(document.getElementById("unidade_option").checked==true) {
			document.getElementById("CampoUnidade").disabled=false;
		} else {
			document.getElementById("CampoUnidade").disabled=true;
		}
	}

	function enable_periodo_field() {
		if(document.getElementById("periodo_option").checked==true) {
			document.getElementById("CampoPeriodo").disabled=false;
		} else {
			document.getElementById("CampoPeriodo").disabled=true;
		}
	}

</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'relatorio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Relatório de usuário (individual)'); ?>
		<?php //echo $form->checkBox($model,'CPF', array('id'=>'cpf_field_cb', 'onClick' => 'enable_cpf_field()')); ?>
		<?php echo $form->labelEx($model,'CPF'); ?>
		<?php echo $form->checkBox($model,'CPF', array('id'=>'cpf_field_cb', 'onClick' => 'enable_cpf_field()')); ?>
		<?php //echo $form->textField($model,'CPF', array("id"=>"2cpf_field","disabled"=>true)); ?>
		<?php echo $form->textField($model,'CPF', array("id"=>"cpf_field", "disabled"=>true)); ?>
	</div>
	

	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'Data'); ?>
		<?php echo $form->checkBox($model,'DATAINI', array('id'=>'data_option', 'onClick' => 'enable_date_field()')); ?>
	</div>

		<table style="width:50%">
		<tr>
			<td>

			</td>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'Data de Inicio'); ?>
					<?php echo $form->textField($model,'DATAINI', array("id"=>"data_ini_field", "disabled"=>true)); ?>
					<?php echo $form->error($model,'DATAINI'); ?>
				</div>
			</td>
			<td>
				<div class="row">
					<?php echo $form->labelEx($model,'Data de fim'); ?>
					<?php echo $form->textField($model,'DATAFIM', array("id"=>"data_fim_field", "disabled"=>true)); ?>
					<?php echo $form->error($model,'DATAFIM'); ?>
				</div>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

	</table>
	



	<div class="row">
		<?php echo $form->labelEx($model,'Curso'); ?>
		<?php echo $form->checkBox($model,'CURSO', array('id'=>'course_option', 'onClick' => 'enable_course_field()')); ?>
		<?php echo $form->dropDownList($model,'CURSO',$cursosArray, array('id'=>'CampoCurso',"disabled"=>true, 'empty' => '--- Escolha um curso ---')); ?>
	</div>


	<div class="row">
		<?php echo CHtml::label('Unidade', '',array('id'=>'labelUnidadeDropDown')); ?>
		<?php echo $form->checkBox($model,'UNIDADE', array('id'=>'unidade_option', 'onClick' => 'enable_unidade_field()')); ?>
		<?php echo $form->dropDownList($model,'UNIDADE',$unidadesArray, array('id'=>'CampoUnidade',"disabled"=>true, 'empty' => '--- Escolha uma unidade ---')); ?>
	</div>
	-->

	<div class="row">
		<?php echo CHtml::label('Relatório estatístico do período', '',array('id'=>'labelPeriodoDropDown')); ?>
		<?php echo CHtml::label('Selecione um período', '',array('id'=>'labelPeriodoDropDown')); ?>
		<?php echo $form->checkBox($model,'PERIODO', array('id'=>'periodo_option', 'onClick' => 'enable_periodo_field()')); ?>
		<?php echo $form->dropDownList($model,'PERIODO',$periodosArray, array('id'=>'CampoPeriodo',"disabled"=>true, 'empty' => '--- Escolha um período ---')); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Gerar relatório'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
