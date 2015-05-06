<?php

class SiteController extends Controller
{

	/**
	* Declares class-based actions.
	*/

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	* This is the default 'index' action that is invoked
	* when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest){
			$this->redirect('index.php?r=site/login&value');
		}
		$this->redirect('index.php?r=site/configuracao&view=configuracao');
	}

	/**
	* This is the action to handle external exceptions.
	*/
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	* Displays the contact page
	*/
	public function actionContact()
	{
		if(!Yii::app()->user->isGuest){
			$model=new ContactForm;
			if(isset($_POST['ContactForm']))
			{
				$model->attributes=$_POST['ContactForm'];
				if($model->validate())
				{
					$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
					$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
					$headers="From: $name <{$model->email}>\r\n".
						"Reply-To: {$model->email}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-Type: text/plain; charset=UTF-8";

					mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
					Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
					$this->refresh();
				}
			}
			$this->render('contact',array('model'=>$model));
		}
		else{
			$this->redirect('/academia/index.php');
		}
	}

	/**
	* Displays the login page
	*/
	public function actionLogin($value)
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect('index.php?r=site/index');
		}
		$model=new LoginForm;
		$model->username=$value;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('index.php?r=site/index');//redireciona para a tela principal apÃ³s o login.

		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	* Logs out the current user and redirect to homepage.
	*/
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/*
	Garante que a tela de configuraÃ§Ã£o nÃ£o serÃ¡ acessada por usuÃ¡rios nÃ£o logados.
	*/
	public function actionConfiguracao()
	{
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));


		if(!Yii::app()->user->isGuest){
			$verifPat = new VerificaPatente;
			$tipoVerificado = $verifPat->verificaTipo(Yii::app()->user->TIPO);

			//echo $tipoVerificado;
			if ($tipoVerificado=="soUsuario"){
				$this->render('indexUsuario',array('academiaRecord'=>$academiaRecord));
			}else{
				if(($tipoVerificado=="soGestor")||($tipoVerificado=="soDiretor")){
					$this->render('index',array('academiaRecord'=>$academiaRecord,'agenda'=>'nao'));
				}else{
					$this->render('index',array('academiaRecord'=>$academiaRecord,'agenda'=>'sim'));
				}
			}
		}
		else{
			$this->redirect('/academia/index.php');
		}

	}
	public function actionRecuperarSenha($value){

		$model=new RecuperaSenhaForm;
		$model->matricula=$value;
		if(isset($_POST['RecuperaSenhaForm']))
		{
			$model->attributes=$_POST['RecuperaSenhaForm'];
			if($model->validate())
			{
				//$novaSenha = "Hsnc5369kd";
				$modelUsuario = Usuario::model()->findByPk($model->matricula);
				if($modelUsuario){
					$calendario = new Calendario;
					$geradorDeSenha = new GeraSenha();
					$crypt = new Criptografia;


					$novaSenha = $geradorDeSenha->geraSenha(10);

					$senhaEncriptada = $crypt->encrypt($novaSenha);

					$modelUsuario->SENHA = $senhaEncriptada;
					$modelUsuario->SENHA_REPETE = $senhaEncriptada;

					$modelUsuario->save();

					$nome = $modelUsuario->NOME;
					$data = $calendario->getData();
					$hora = $calendario->getHora();

					$to = $modelUsuario->EMAIL;
					$from = "sistemas@icomp.ufam.edu.br";
					$subject = "ACADEMIA UFAM - NOVA SENHA";
					$message = "<html>
							<h2>Academia UFAM</h2>
							Olá $nome.
							<br/>
							Esta é uma menssagem automática, não responda.
							<br/>
							<br/>
							Você solicitou a mudança da sua senha em $data ás $hora.
							<br/>
							Sua nova senha é: <b>$novaSenha</b>
							<br/>
							<br/>
							Clique <a href='http://sistemas.icomp.ufam.edu.br/academia/index.php?r=site/login&value=$modelUsuario->MATRICULA'>aqui</a> para acessar o sistema.
							<br/>
							Ou cole esse link no seu navegador. [http://sistemas.icomp.ufam.edu.br/academia/index.php?r=site/login&value=$modelUsuario->MATRICULA]
							<br/>
							<br/>
							Obrigado.
							<br/>
							<br/>
						</html>";
					$mail=Yii::app()->Smtpmail;
					$mail->SetFrom($from, 'no-reply - Academia UFAM');
					$mail->Subject = $subject;
					$mail->MsgHTML($message);
					$mail->AddAddress($to, "");
					if(!$mail->Send()) {
						//echo 'alert("AVISO!\nUma mensagem foi enviada para o email cadastrado.")';
						$this->redirect('index.php?r=site/erroMail',array('erro' => $mail->ErrorInfo));
						//echo "Mailer Error: " . $mail->ErrorInfo;
					}else{
						//echo 'alert("AVISO!\nUma mensagem foi enviada para o email cadastrado.")';
						$this->redirect('index.php?r=site/login&value='.$modelUsuario->MATRICULA);
					}
				}else{
					$this->redirect('/academia/index.php');
				}
			}
		}
		else{
			$this->render('pages/recuperarSenha',array('model'=>$model));
		}
	}
	public function actionErroMail(){
		$this->render('erroMail');
	}

	public function actionTeste(){
		$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
		$modelsAgendaV = AgendaV::model()->findAllByAttributes(array("MAT_USUARIO"=>Yii::app()->user->getState('MATRICULA'),"ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$modelsGrid = Grid::model()->findAllByAttributes(array("ID_ACADEMIA"=>$academiaRecord->CODIGO_CONFIG));
		$calendario = new Calendario;
		$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));

		echo $calendario->comparaDataComDataAtual('2014-02-10');

	}

	public function actionAjax()
	{
		if(isset($_POST['ACAO']))
		{
			$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
			if ($_POST['ACAO']=="decrementa_vaga"){
				$ref_cota='nao';
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						$ref_cota='func';
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$ref_cota='aluno';
					}
				}
				date_default_timezone_set('America/Manaus');
				$date = new DateTime();
				$data = $date->format("Y-m-d");
				//$matricula = Yii::app()->user->getState('MATRICULA');
				$matricula = $_POST['MAT'];
				$idCel = $_POST['IDCEL'];
				$idAcademia = $_POST['IDACADEMIA'];
				$matResp = Yii::app()->user->MATRICULA;
				list($diaSemana, $horario) = split(';',$_POST['MAP']);
				$stringCommand = "CALL MARCA_HORA_DECREMENTA_VAGA('".$matricula."',".$idAcademia.",'".$diaSemana."','".$horario."','".$idCel."','".$data."','".$matResp."','".$ref_cota."')";
				$command = Yii::app()->db->createCommand($stringCommand);
				$command->execute();

			}else if ($_POST['ACAO']=="incrementa_vaga"){
				$ref_cota='nao';
				if($academiaRecord->COTA=="sim"){
					if(Yii::app()->user->getState('FUNCIONARIO')=="sim"){
						$ref_cota='func';
					}elseif(Yii::app()->user->getState('ALUNO')=="sim"){
						$ref_cota='aluno';
					}
				}
				$matricula = $_POST['MAT'];
				$idAcademia = $_POST['IDACADEMIA'];
				list($diaSemana, $horario) = split(';',$_POST['MAP']);
				$stringCommand = "CALL DESMARCA_HORA_INCREMENTA_VAGA('".$matricula."',".$idAcademia.",'".$diaSemana."','".$horario."','".$ref_cota."')";
				$command = Yii::app()->db->createCommand($stringCommand);
				$command->execute();
			}

		}
	}
}
