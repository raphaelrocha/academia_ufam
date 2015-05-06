<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$sessionTimeout = 60;
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'defaultController' => 'site/login',
	'name'=>'Academia UFAM',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	'language'=>'pt_br',
	// application components
	'components'=>array(
		//'messages'=>array(
		//	'basePath'=>Yiibase::getPathOfAlias('application.messages'),
		//),
		'user'=>array(
			'class'=>'application.components.UserLevel',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'image'=>array(
			'class'=>'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver'=>'GD',
			// ImageMagick setup path
			'params'=>array('directory'=>'/opt/local/bin'),
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ACADEMIA_DB',
			'emulatePrepare' => true,
			//'username' => 'root',
			//'password' => 'mysql',
			'username' => 'academia_user',
			'password' => 'mysqlPAPS2015',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'Host'=>'smtp.gmail.com',
			'Username'=>'sistemas@icomp.ufam.edu.br',
			'Password'=>'Si102030',
			'Mailer'=>'smtp',
			'Port'=>465,
			'SMTPSecure'=>'ssl',
			'SMTPAuth'=>true,
		),
		/*'session'=>array(
			'class'=>'CDbHttpSession',
			'timeout'=> $sessionTimeout,
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'rlr@icomp.ufam.edu.br',

		//path absoluto para o diretório de uploads.
		'uploadDir'=>'C:\xampp\htdocs\academia\arquivos_upload\/',
		//'uploadDir'=>'/var/www/academia/arquivos_upload/',

		//link base para geração da url do arquivo novo.
		//Este link referencia o diretório referenciado em uploadDir
		'uploadBaseLink'=>'http://localhost/academia/arquivos_upload/',
		//'uploadBaseLink'=>'http://200.222.36.120/academia/arquivos_upload/',

		'relatorioDir'=>'C:\xampp\htdocs\academia\relat_gerados\/',
		//'relatorioDir'=>'/var/www/academia/relat_gerados/',

		'relatorioBaseLink'=>'http://localhost/academia/relat_gerados/',
		//'relatorioBaseLink'=>'http://200.222.36.120/academia/relat_gerados/',

		//TimeZone usado pelo sistema.
		//Usado em:
		//* components/RegistraEntrada
		'academiaTimeZone'=>'America/Manaus',

		//CONFIGURAÇÕES DO SIE
		//URL SIE
		'sie_url'=>'http://200.129.163.9:8080/ecampus/servicos/getPessoaValidaSIE?cpf=',

		//ESTE CONTROLE OCORRE NA CLASSE USERIOCONTROLE
		//sim = ativa a checagem do sie
		//nao = desativa a checagem do sie
		'sie_connect'=>'sim',

		//ESTE CONTROLE OCORRE NA CLASSE USERIDENTIFY
		//sim = ativa a checagem do sie no login
		//nao = desativa a checagem do sie no login
		'sie_login_auth'=>'sim',

		//USUARIO ROOT
		'root'=>'222.222.222-22',

		//'loginTeclado'=>'totem',
		//'senhaTeclado'=>'PAPS2015',
	),
);

