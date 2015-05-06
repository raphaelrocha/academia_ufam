<?php

class UsuarioController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create', 'iniciocadastro'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update'),
				  'actions'=>array('index','view','update','diretor','ajuda','admin','delete','gerenciarGrid'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete',"gerenciarGrid"),
				//'users'=>array('admin'),
					'users'=>array('@'),
			),*/
			array('deny',  // deny all users
				  'actions'=>array('index','view','update','diretor','ajuda','admin','delete','gerenciarGrid'),
				'users'=>array('*'),
				'deniedCallback' => function() { Yii::app()->controller->redirect(array ('site/login&value'));}
			),
		);
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		if(!Yii::app()->user->isGuest){
			$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));

			if((Yii::app()->user->getState('TIPO')=="aluno")&&(Yii::app()->user->getState('MATRICULA')!=$id)){
				//$model=$this->loadModel(Yii::app()->user->getState('MATRICULA'));
				$id = Yii::app()->user->getState('MATRICULA');
			}

			$this->render('view',array(
				'model'=>$this->loadModel($id), 'modelCurrentUser'=>$modelCurrentUser
			));
		}else{
			$this->redirect('index.php?r=site/login&value='.$id);
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionInicioCadastro($value){
		$cpfShow;
		$modelBusca=new UsuarioBuscaSieForm;
		$validador = new ValidaUsuario();
		if(isset($_POST['UsuarioBuscaSieForm']))
		{
			$modelBusca->attributes=$_POST['UsuarioBuscaSieForm'];
			$record = Usuario::model()->findByAttributes(array('MATRICULA'=>$modelBusca->MATRICULA));
			if($record === null){
				if($modelBusca->validate()){
					//echo $modelBusca->FLAG;
					if($modelBusca->FLAG == "sim"){
						$validaAluno = $validador->getDados($modelBusca->MATRICULA);
					}else{
						$validaAluno = "sieNao";
					}

					//var_dump($validaAluno);
					if ((sizeof($validaAluno)>0) && ($validaAluno!="sieNao")){
						if($validaAluno->MATR_ALUNO!=null){
							$validaAluno->MATR_ALUNO="sim";
						}else{
							$validaAluno->MATR_ALUNO=null;
						}
						if($validaAluno->SIAPE!=null){
							$validaAluno->SIAPE="sim";
						}else{
							$validaAluno->SIAPE=null;
						}
						//$model=new Usuario;
						$arr=array('cpf' => $modelBusca->MATRICULA,
								   'nome' => $validaAluno->NOME_PESSOA,
								   'mat' => $validaAluno->MATR_ALUNO,
								   'siape' => $validaAluno->SIAPE,
								   'sexo' => $validaAluno->SEXO,
								   'nasc' => $validaAluno->DT_NASCTO,
								   'curso' => $validaAluno->CURSO,
								   'email'=>$validaAluno->EMAIL,
								   'esp'=>null);
						$values = json_encode($arr);
						$this->redirect('index.php?r=usuario/create&values='.$values);
					}else{
						if(($validaAluno=="sieNao")&&($validador->validaCpf($modelBusca->MATRICULA)==true)){
							$arr=array('cpf' => $modelBusca->MATRICULA,
									   'esp'=>'dir');
							$values = json_encode($arr);
							$this->redirect('index.php?r=usuario/create&values='.$values);
						}
						else{
							$this->redirect('index.php?r=usuario/iniciocadastro&value=erro;'.$modelBusca->MATRICULA);
						}
					}
				}
			}else{
				$this->redirect('index.php?r=usuario/iniciocadastro&value=existe;'.$modelBusca->MATRICULA);
			}
		}
		$partesValue = explode(";", $value);

		foreach($partesValue as $chave => $valor){
			if($chave==0){
				$value = $valor;
			}else{
				$cpfShow = $valor;
			}
		}
		if ($value=="erro"){
			$modelBusca->MATRICULA = $cpfShow;
			$this->render('iniciocadastro',array(
				'modelBusca'=>$modelBusca,
				'alert'=>'sim',
			));
		}elseif ($value=="existe"){
			$modelBusca->MATRICULA = $cpfShow;
			$this->render('iniciocadastro',array(
				'modelBusca'=>$modelBusca,
				'alert'=>'existe',
			));
		}else{
			$this->render('iniciocadastro',array(
				'modelBusca'=>$modelBusca,
				'alert'=>'nao',
			));
		}


	}
	public function actionCreate($values)
	{
		if($values==""){
			$this->redirect('index.php?r=site/index&value');
		}
		$model=new Usuario;
		$json = json_decode($values);
		$model->MATRICULA = $json->cpf;
		$flagDiretorAuth=$json->esp;
		if((Yii::app()->params['sie_connect']=="sim")&&($flagDiretorAuth==null)){
			//$json = json_decode($values);
			//$model->MATRICULA = $json->cpf;

			$partesNome = explode(" ", $json->nome);
			foreach($partesNome as $chave => $valor){
				if($chave==0){
					$model->NOME = $valor;
				}else{
					$model->SOBRENOME = $model->SOBRENOME." ".$valor;
				}
			}
			$model->SOBRENOME = trim($model->SOBRENOME);
			//$model->NOME = $json->nome;
			//$model->SOBRENOME = $json->nome;
			$sexo = $json->sexo;
			if($sexo=="M"){
				$model->SEXO = "masculino";
			}else if($sexo=="F"){
				$model->SEXO = "feminino";
			}elseif($sexo=="m"){
				$model->SEXO = "masculino";
			}else if($sexo=="f"){
				$model->SEXO = "feminino";
			}
			$model->DATANASC = $json->nasc;
			//$model->ALUNO=$json->mat;
			//$model->FUNCIONARIO=$json->siape;
			if($json->mat!=null){
				$model->ALUNO="sim";
			}else{
				$model->ALUNO="nao";
			}
			if($json->siape!=null){
				$model->FUNCIONARIO="sim";
			}else{
				$model->FUNCIONARIO="nao";
			}
			if($json->curso!=null){
				$model->CURSO=$json->curso;
			}
			$model->EMAIL = $json->email;
			$model->SITUACAO = "ativo";
		}

		//echo $values;
		//$modelBusca = new UsuarioBuscaSieForm;

		// Usado para criptografia.
		//$salt = openssl_random_pseudo_bytes(22); // É necessário usar OpenSSL.
		//$salt = '$2a$%13$' . strtr(base64_encode($salt), array('_' => '.', '~' => '/'));

		/*
		Define o tipo de usuario como aluno. Isso permite que a tela de criação seja usada
		mesmo que nenhum usuário esteja logado, tornando possível a criação de novas contas pelo
		link na tela de login.
		*/
		if(!Yii::app()->user->isGuest){ //Usuário  está logado
			$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
			$modelCurrentUserTipo = $modelCurrentUser->TIPO;
		}else{ //Nenhum usuário logado.
			$modelCurrentUserTipo="aluno";
		}

		/* busca todos os cursos cadastrados e coloca em array, para que eles sejam listados
		no dropdown de cursos no form de create. Isso garante que todos os cursos estarão sempre
		disponíveis no form de create de usuarios.
		*/
		$models = Curso::model()->findAllbySql('SELECT ID_CURSO, CONCAT(NOME_CURSO, " - ", ID_CURSO) as NOME_CURSO FROM CURSO ORDER BY NOME_CURSO');
		$cursosArray = CHtml::listData($models, 'ID_CURSO', 'NOME_CURSO');
		$modelsUnidade = Unidade::model()->findAllbySql('SELECT ID_UNIDADE, CONCAT(NOME_UNIDADE, " - ", ID_UNIDADE) as NOME_UNIDADE FROM UNIDADE ORDER BY NOME_UNIDADE');
		$unidadesArray = CHtml::listData($modelsUnidade, 'ID_UNIDADE', 'NOME_UNIDADE');

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];

			if($flagDiretorAuth==null){
				$validador = new ValidaUsuario();
				$validaAluno = $validador->valida($model->MATRICULA);
			}else{
				$validaAluno = "ativo";
			}

			if($validaAluno == "ativo"){
				//           if(verificaDataNasc($model->DATANASC)){
				//            $model->DATANASC = strtotime ($model->DATANASC); //em teste para mudar o formato da data
				//            $model->DATANASC = date('d-m-Y', $model->DATANASC); //em teste para mudar o formato da data
				if($model->ALUNO=="sim"){
					$model->UNIDADE = "-";
					$model->FUNCIONARIO="nao";
				}
				else if($model->ALUNO=="nao"){
					$model->CURSO = "-";
					$model->FUNCIONARIO="sim";
				}
				else if($model->ALUNO=="abs"){/*ambos, aluno e colaborador*/
					$model->ALUNO="sim";
					$model->FUNCIONARIO="sim";
				}
				$calendario = new Calendario;
				$model->DATANASC = $calendario->dataFormToDataDb($model->DATANASC); //FORMATA DATA DO FORM PRO BANCO
				if(strlen($model->SENHA)>0){
					$crypt = new Criptografia;
					$senhaEncriptada = $crypt->encrypt($model->SENHA);
					$model->SENHA = $senhaEncriptada;
					$senhaEncriptadaRepete = $crypt->encrypt($model->SENHA_REPETE);
					$model->SENHA_REPETE = $senhaEncriptadaRepete;
				}
				//$model->SENHA = crypt($model->SENHA, $salt);
				if($model->save()){
					if(Yii::app()->user->isGuest){
						$this->redirect('index.php?r=site/login&value='.$model->MATRICULA);
					}
					$this->redirect(array('view','id'=>$model->MATRICULA, 'modelCurrentUserTipo' => $modelCurrentUserTipo));
				}

			}else if ($validaAluno == "inativo"){
				echo "
						<script type=\"text/javascript\">
							alert('SEU CPF ESTÁ BLOQUEADO NO SIE, FAVOR PROCURAR A PROCOMUN.');
						</script>
					";
			}else if ($validaAluno == "invalido"){
				echo "
						<script type=\"text/javascript\">
							alert('O NÚMERO DE CPF INFORMÁDO NÃO É VÁLIDO.');
						</script>
					";
			}else if ($validaAluno == "naoEncontrado"){
				echo "
						<script type=\"text/javascript\">
							alert('O NÚMERO DE CPF INFORMÁDO NÃO EXISTE NA BASE DE DADOS DO SIE.');
						</script>
					";
			}
		}
		if(!Yii::app()->user->isGuest){
			$verifPat = new VerificaPatente;
			$patente = $verifPat->isPatente(Yii::app()->user->TIPO);
			if($patente=="diretor"){
				$this->render('create',array(
					'model'=>$model,
					//'modelBusca'=>$modelBusca,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'diretor',
					'unidadesArray'=>$unidadesArray,
					'flagDir'=>$flagDiretorAuth,
					//'flag'=>'depoisBuscaSie'
				));
			}elseif($patente=="gestor"){
				$this->render('create',array(
					'model'=>$model,
					//'modelBusca'=>$modelBusca,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'gestor',
					'unidadesArray'=>$unidadesArray,
					//'flag'=>'depoisBuscaSie'
				));
			}else{
				$this->render('create',array(
					'model'=>$model,
					//'modelBusca'=>$modelBusca,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'usuario',
					'unidadesArray'=>$unidadesArray,
					//'flag'=>'depoisBuscaSie'
				));
			}
		}else{
			$this->render('create',array(
				'model'=>$model,
				//'modelBusca'=>$modelBusca,
				'modelCurrentUserTipo' => $modelCurrentUserTipo,
				'cursosArray'=>$cursosArray,
				'form'=>'public',
				'unidadesArray'=>$unidadesArray,
				//'flag'=>'antesBuscaSie'
			));
		}
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$modelCurrentUserTipo = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		$model=$this->loadModel($id);
		$calendario = new Calendario;
		$model->DATANASC = $calendario->dataDbToDataForm($model->DATANASC); //FORMATA DATA DO BANCO PRO FORM
		$model->SENHA_REPETE = $model->SENHA;
		$senhaAntiga=$model->SENHA;

		$models = Curso::model()->findAllbySql('SELECT ID_CURSO, CONCAT(NOME_CURSO, " - ", ID_CURSO) as NOME_CURSO FROM CURSO ORDER BY NOME_CURSO');
		$cursosArray = CHtml::listData($models, 'ID_CURSO', 'NOME_CURSO');
		$modelsUnidade = Unidade::model()->findAllbySql('SELECT ID_UNIDADE, CONCAT(ID_UNIDADE, " - ", NOME_UNIDADE) as NOME_UNIDADE FROM UNIDADE ORDER BY NOME_UNIDADE');
		$unidadesArray = CHtml::listData($modelsUnidade, 'ID_UNIDADE', 'NOME_UNIDADE');

		if((Yii::app()->user->getState('TIPO')=="aluno")&&(Yii::app()->user->getState('MATRICULA')!=$id)){
			$model=$this->loadModel(Yii::app()->user->getState('MATRICULA'));
			//$id = Yii::app()->user->getState('MATRICULA');
		}

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];

			//$validador = new ValidaUsuario();
			//$validaAluno = $validador->valida($model->MATRICULA);
			$validaAluno="ativo";

			if(($validaAluno == "ativo")||($id==Yii::app()->params['root'])){

				if($model->ALUNO=="sim"){
					$model->UNIDADE = "-";
					$model->FUNCIONARIO="nao";
				}
				else if($model->ALUNO=="nao"){
					$model->CURSO = "-";
					$model->FUNCIONARIO="sim";
				}
				else if($model->ALUNO=="abs"){/*ambos, aluno e colaborador*/
					$model->ALUNO="sim";
					$model->FUNCIONARIO="sim";
				}
				//$calendario = new Calendario;
				$model->DATANASC = $calendario->dataFormToDataDb($model->DATANASC);//FORMATA DATA DO FORM PRO BANCO

				if(strlen($model->SENHA)>0){
					if($model->SENHA!=$senhaAntiga){
						$crypt = new Criptografia;
						$senhaEncriptada = $crypt->encrypt($model->SENHA);
						$model->SENHA = $senhaEncriptada;
						$senhaEncriptadaRepete = $crypt->encrypt($model->SENHA_REPETE);
						$model->SENHA_REPETE = $senhaEncriptadaRepete;
					}
				}

				if($model->save()){
					$this->redirect(array('view','id'=>$model->MATRICULA, 'modelCurrentUserTipo'=>$modelCurrentUserTipo->TIPO));
				}
			}else if ($validaAluno == "inativo"){
				echo "
						<script type=\"text/javascript\">
							alert('SEU CPF ESTÁ BLOQUEADO NO SIE, FAVOR PROCURAR A PROCOMUN.');
						</script>
					";
			}else if ($validaAluno == "invalido"){
				echo "
						<script type=\"text/javascript\">
							alert('O NÚMERO DE CPF INFORMÁDO NÃO É VÁLIDO.');
						</script>
					";
			}else if ($validaAluno == "naoEncontrado"){
				echo "
						<script type=\"text/javascript\">
							alert('O NÚMERO DE CPF INFORMÁDO NÃO EXISTE NA BASE DE DADOS DO SIE.');
						</script>
					";
			}
		}

		if(!Yii::app()->user->isGuest){
			$verifPat = new VerificaPatente;
			$patente = $verifPat->isPatente(Yii::app()->user->TIPO);
			$patenteModel = $verifPat->isPatente($model->TIPO);

			//$crypt = new Criptografia;
			//$senhaDecriptada = $crypt->decrypt($model->SENHA);
			//$model->SENHA = $senhaDecriptada;
			//$model->SENHA_REPETE = $senhaDecriptada;

			if($model->MATRICULA==Yii::app()->params['root']){
				$this->render('update',array(
					'model'=>$model,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'root',
					'unidadesArray'=>$unidadesArray
				));

			}else if($patente=="diretor"){
				$this->render('update',array(
					'model'=>$model,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'diretor',
					'unidadesArray'=>$unidadesArray
				));
			}elseif($patente=="gestor"){
				$this->render('update',array(
					'model'=>$model,
					'modelCurrentUserTipo' => $modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'form'=>'gestor',
					'unidadesArray'=>$unidadesArray,
					'patenteModel' => $patenteModel //ENVIA PATENTE DO MODELO QUE ESTÁ SENDO EDITADO.
				));
			}else{
				if(Yii::app()->user->MATRICULA==$model->MATRICULA){
					$this->render('update',array(
						'model'=>$model,
						'modelCurrentUserTipo' => $modelCurrentUserTipo,
						'cursosArray'=>$cursosArray,
						'form'=>'usuario',
						'unidadesArray'=>$unidadesArray
					));
				}else{
					$this->redirect('index.php?r=site/index&value');
				}

			}
		}else{
			//$this->render('update',array(
			//	'model'=>$model,
			//	'modelCurrentUserTipo' => $modelCurrentUserTipo,
			//	'cursosArray'=>$cursosArray,
			//	'form'=>'public',
			//	'unidadesArray'=>$unidadesArray
			//));
			$this->redirect('index.php?r=site/login');
		}
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));

		if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor"){

		    $this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
		        	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else{
			echo "Você não tem permissão de para fazer essa operação";
		}
	}

	/**
	* Lists all models.
	*/
 /*   public function actionIndex()
	{
		/*$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		)); //


		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider, 'modelCurrentUser'=>$modelCurrentUser
		));

	} */

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		$model = new Usuario('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
			'modelCurrentUser'=>$modelCurrentUser,
		));
	}

	public function actionDiretor(){

		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));

		//if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor"){
		if ((strpos(Yii::app()->user->TIPO,"diretor") == false)||(strpos(Yii::app()->user->TIPO,"gestor") == false)){

			$this->render('welcome_diretor', array('modelCurrentUser'=>$modelCurrentUser));
		}
		else{
			echo "Você não tem permissão de acessar essa página";
		}
	}

	public function actionAjuda(){

		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));

		if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor"){

			$this->render('ajuda', array('modelCurrentUser'=>$modelCurrentUser));
		}
		else if($modelCurrentUser->ALUNO == "sim"){
			$this->render('ajuda_aluno', array('modelCurrentUser'=>$modelCurrentUser));
		}
		else{
			$this->render('ajuda_funcionario', array('modelCurrentUser'=>$modelCurrentUser));
		}

	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Usuario the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Usuario $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	protected function verificaDataNasc($data){
		$t=time();
		$dataAtual= date("Y-m-d",$t);
		echo $data;
		if($data > '1900-01-01' && $data < ($dataAtual - 10)){
			return true;
		}
		else{
			return false;
		}
	}

	public function actionGerenciarGrid($id){
		$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
		$model=$this->loadModel($id);
		$verifPat = new VerificaPatente;
		//$patenteUserCurr = $verifPat->isPatente(Yii::app()->user->TIPO);
		$tipoVerificado = $verifPat->verificaTipo(Yii::app()->user->getState('TIPO'));

		//if ((strpos(Yii::app()->user->TIPO,"diretor") == false)||(strpos(Yii::app()->user->TIPO,"gestor") == false)){
		if ($tipoVerificado!="soUsuario"){
			//$modelIsUsuario = $verifPat->isUsuario($model->TIPO);
			$modelTipoVerificado = $verifPat->verificaTipo($model->TIPO);
			if (($modelTipoVerificado!="soGestor")&&($modelTipoVerificado!="soDiretor")){
				//echo $modelTipoVerificado;
				$this->render('manageGrid',array('academiaRecord'=>$academiaRecord,'id'=>$id));
			}else{
				echo "
					<script type=\"text/javascript\">
						alert('ESTE USUARIO NÃO POSSUI AGENDA');
					</script>
				";
				$modelCurrentUserTipo = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
				$models = Curso::model()->findAllbySql('SELECT ID_CURSO, CONCAT(NOME_CURSO, " - ", ID_CURSO) as NOME_CURSO FROM CURSO ORDER BY NOME_CURSO');
				$cursosArray = CHtml::listData($models, 'ID_CURSO', 'NOME_CURSO');
				$modelsUnidade = Unidade::model()->findAllbySql('SELECT ID_UNIDADE, CONCAT(NOME_UNIDADE, " - ", ID_UNIDADE) as NOME_UNIDADE FROM UNIDADE ORDER BY NOME_UNIDADE');
				$unidadesArray = CHtml::listData($modelsUnidade, 'ID_UNIDADE', 'NOME_UNIDADE');

				//$this->redirect("index.php?r=usuario/update&id=".$id);
				if($id==Yii::app()->params['root']){
					$this->render('update',array(
						'model'=>$model,
						'modelCurrentUserTipo' => $modelCurrentUserTipo,
						'cursosArray'=>$cursosArray,
						'form'=>'root',
						'unidadesArray'=>$unidadesArray
					));
				}else{
					$this->render('update',array(
					'model'=>$model,
					'modelCurrentUserTipo'=>$modelCurrentUserTipo,
					'cursosArray'=>$cursosArray,
					'unidadesArray'=>$unidadesArray,
					'form'=>'diretor',
					));
				}
			}
			//$this->redirect('index.php?r=site/manageGrid',array('academiaRecord'=>$academiaRecord));
		}else{
			$this->redirect('index.php?r=site/index');
		}


	}

}
