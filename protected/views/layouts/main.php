<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="pt-br" />

	<!--	<link href='http://fonts.googleapis.com/css?family=Black+Ops+One' rel='stylesheet' type='text/css'> -->

		<!-- blueprint CSS framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
		<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<?php
		$verifPat = new VerificaPatente;
		$tipo = $verifPat->formataPatente(Yii::app()->user->getState('TIPO'));
		//$tipo = Yii::app()->user->getState('TIPO');
	?>
	<?php
	$verifPat = new VerificaPatente;
	$tipoVerificado = $verifPat->verificaTipo(Yii::app()->user->getState('TIPO'));
	?>


	<body>

		<div class="container" id="page">

			<div id="header">
				<div class="span-4" id="imagelogo"> <a href="http://www.ufam.edu.br/"><img src="images/ufam.png" width="110px "></a> </div>
				<div class="span-14" id="logo"><?php echo CHtml::encode(" "); ?></div>
				<div class="span-4" id="imagelogo"> <a href="http://www.icomp.ufam.edu.br/"><img src="images/icomp.png" width="170px" height="110px" style="margin-top:4px"></a> </div>
			</div><!-- header -->

			<div class="span-5 last">
				<?php if (!Yii::app()->user->isGuest):?>
					<div id="hi">
						<?php if(Yii::app()->user->SEXO=="masculino"):?>
							Olá <?php echo CHtml::encode(Yii::app()->user->name); ?>, bem vindo!<br/>
						<?php elseif(Yii::app()->user->SEXO=="feminino"):?>
							Olá <?php echo CHtml::encode(Yii::app()->user->name); ?>, bem vinda!<br/>
						<?php else:?>
							Olá <?php echo CHtml::encode(Yii::app()->user->name); ?>, bem vindo(a)!<br/>
						<?php endif?>
						Seu perfil atual é:<br> <b><?php echo $tipo ?></b><br/>
						Para sair clique <i><a href="index.php?r=/site/logout" ><b>aqui</b></a>.<br></i>
					</div>
				<?php endif; ?>

				<div id="mainmenu">
					<?php if (($tipoVerificado == "usuarioDiretor") || ($tipoVerificado == "usuarioGestor")):?>
						<?php $this->widget('zii.widgets.CMenu',array(
							'items'=>array(
								//array('label'=>'Principal', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Início', 'url'=>array('/site/configuracao', 'view'=>'configuracao'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Minha agenda', 'url'=>array('/agenda/agendamento'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Usuários', 'url'=>array('/usuario/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Cursos', 'url'=>array('/curso/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Unidades de Locação', 'url'=>array('/unidade/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Configurar Academia', 'url'=>array('/academia/manage'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Relatórios', 'url'=>array('/relatorio/filtro'), 'visible'=>!Yii::app()->user->isGuest),


							),
						));?>
					<?php elseif ($tipoVerificado == "soUsuario"):?>
						<?php $this->widget('zii.widgets.CMenu',array(
							'items'=>array(
								//array('label'=>'Principal', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Início', 'url'=>array('/site/configuracao', 'view'=>'configuracao'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Minha agenda', 'url'=>array('/agenda/agendamento'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Meus dados', 'url'=>array('usuario/view&id='.Yii::app()->user->MATRICULA), 'visible'=>!Yii::app()->user->isGuest),

						),
						));?>
					<?php elseif (($tipoVerificado == "soDiretor") || ($tipoVerificado == "soGestor")):?>
						<?php $this->widget('zii.widgets.CMenu',array(
							'items'=>array(
								//array('label'=>'Principal', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Início', 'url'=>array('/site/configuracao', 'view'=>'configuracao'), 'visible'=>!Yii::app()->user->isGuest),
								//array('label'=>'Agenda', 'url'=>array('/agenda/agendamento'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Usuários', 'url'=>array('/usuario/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Cursos', 'url'=>array('/curso/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Unidades de Locação', 'url'=>array('/unidade/admin'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Configurar Academia', 'url'=>array('/academia/manage'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Relatórios', 'url'=>array('/relatorio/filtro'), 'visible'=>!Yii::app()->user->isGuest),
								//array('label'=>'Configurações', 'url'=>array('/site/configuracao', 'view'=>'configuracao'), 'visible'=>!Yii::app()->user->isGuest)

							),
						));?>

					<?php endif; ?>
				</div><!-- mainmenu -->
			</div>

			<div class="span-19">
				<?php echo $content; ?>
			</div>

			<div class="clear"></div>

			<div id="footer">
				© ICOMP - Instituto de Computação <br/>
				Desenvolvido no contexto da disciplina ICC410 - 2014/02
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
