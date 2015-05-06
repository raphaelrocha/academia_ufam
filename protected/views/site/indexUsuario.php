<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name . ' - Configurações';
$this->breadcrumbs=array(
	'Configurações',
);
?>

<h1>Início</h1>


</br>

<div style="text-align:center" class="span-19" >
	<div class="span-6">
		<div class="span-6"><a href="index.php?r=agenda/agendamento"><img src="images/logo_calendario.png" width=110 height=110 alt="Minha agenda"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Minha Agenda</h></div>
	</div>
	<div class="span-6" >
		<div class="span-6"><a href="index.php?r=usuario/view&id=<?php echo Yii::app()->user->MATRICULA; ?>"<?php echo Yii::app()->user->MATRICULA; ?>><img src="images/myuser.png" width=110 height=110 alt="Meus dados" align="center"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Meus dados</h></div>
	</div>
</div>
<!--
<p>.<p/>

<div style="text-align:center" class="span-19" >

	<div class="span-18">
		<div class="span-18"><a href="index.php?r=academia/manage"><img src="images/config.png" width=120 height=120 alt="Configurar academia"></a></div>
		<div class="span-18"><h>Configurar Academia</h></div>
	</div>
</div>
-->

&nbsp;

<!-- <a href="index.php?r=usuario">Usuários</a><br>  -->
<!--<a href="index.php?r=curso">Cursos</a><br>-->
<!--<a href="index.php?r=usuario/diretor">Diretor</a><br>-->
<!--<a href="index.php?r=agenda">Agendas</a><br>-->
<!--<a href="index.php?r=horario">Horarios</a><br>-->
<!--<a href="index.php?r=academia/manage">Gerenciar perfís da academia</a><br>-->
