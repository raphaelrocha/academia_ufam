<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name . ' - Configurações';
$this->breadcrumbs=array(
	'Configurações',
);
?>

<h1>início</h1>


</br>

<div style="text-align:center" class="span-19" >

	<div class="span-6" >
		<div class="span-6"><a href="index.php?r=usuario/admin"><img src="images/user.png" width=110 height=110 alt="Usuários" align="center"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Usuários</h></div>
	</div>
	<div class="span-6">
		<div class="span-6"><a href="index.php?r=curso/admin"><img src="images/curso.png" width=110 height=110 alt="Cursos"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Cursos</h></div>
	</div>
	<div class="span-6">
		<div class="span-6"><a href="index.php?r=academia/manage"><img src="images/config.png" width=110 height=110 alt="Configurar academia"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Configurar </br> Academia</h></div>
	</div>
	<div class="span-6">
		<div class="span-6"><a href="index.php?r=relatorio/filtro"><img src="images/relat.png" width=110 height=110 alt="Relatórios"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Relatórios</h></div>
	</div>
	<div class="span-6">
		<div class="span-6"><a href="index.php?r=unidade/admin"><img src="images/unidades.png" width=110 height=110 alt="Unidades de Locação"></a></div>
		<div class="span-6"><h style="font-size:16px; font-weight:bold;">Unidades de </br> Locação</h></div>
	</div>
	<?php if($agenda=="sim"):?>
		<div class="span-6">
			<div class="span-6"><a href="index.php?r=agenda/agendamento"><img src="images/logo_calendario.png" width=110 height=110 alt="Minha agenda"></a></div>
			<div class="span-6"><h style="font-size:16px; font-weight:bold;">Minha Agenda</h></div>
		</div>
	<?php endif;?>
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
