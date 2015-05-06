<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

?>
<!--<script src="jquery/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
-->

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript" src="jquery/jquery.maskedinput-1.1.4.pack.js"/></script>

<script>

	$(function() {
		$("#cpf").mask("999.999.999-99",{placeholder:" "});
		//$("#datepicker").mask("00/00/0000",{placeholder:" "});
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

<!--<h2>formBuscaCpfNoSie</h2>-->


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

	<?php echo $form->errorSummary($modelBusca); ?>

	<div class="row" style="display: inline">
		<?php echo $form->labelEx($modelBusca,'MATRICULA'); ?>
		<?php echo $form->textField($modelBusca,'MATRICULA',array('id'=>'cpf','size'=>15,'maxlength'=>11)); ?>
		<font size="2" color="red"><i>(Somente números)</i></font>
		<?php echo $form->error($modelBusca,'MATRICULA'); ?>
	</div>

	<?php
	$verifPat = new VerificaPatente;

	$tipoVerificado = $verifPat->verificaTipo(Yii::app()->user->getState('TIPO'));
	?>
	<?php if(($tipoVerificado=="soDiretor")||($tipoVerificado=="usuarioDiretor")):?>
	<br>
		<?php echo CHtml::label('Marque a caixa para não validar no SIE.', '',array('id'=>'labelFlag')); ?>
		<?php echo $form->checkBox($modelBusca,'FLAG', array('value'=>'nao', 'uncheckValue'=>'sim')); ?>

	<?php else:?>
		<?php echo $form->hiddenField($modelBusca,'FLAG',array('value'=>'sim')); ?>
	<?php endif;?>





	<div class="row buttons" align="center">
		<input type="image" name="confirmar" src="images/accept.png" value="Submit" height="70" width="70" alt="Confirmar"></input>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=usuario/admin"><image src="images/cancel.png" height="78" width="73" alt="Cancelar"/></a>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->



