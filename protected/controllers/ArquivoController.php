<?php

class ArquivoController extends Controller
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
				  'actions'=>array('index','view','indexUser','create','update','upload','mostrarArquivo', 'admin','delete','adminUser', 'ajuda'),
				'users'=>array('@'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				  'actions'=>array('create','update','upload','mostrarArquivo', 'admin','delete','adminUser'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','adminUser'),
				'users'=>array('@'),
			),*/
			array('deny',  // deny all users
				  'actions'=>array('index','view','indexUser','create','update','upload','mostrarArquivo', 'admin','delete','adminUser', 'ajuda'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));

	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Arquivo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Arquivo']))
		{
			$model->attributes=$_POST['Arquivo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Arquivo']))
		{
			$model->attributes=$_POST['Arquivo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAjuda()
	{
		$this->render('ajuda');

	}

	/**
	* Lists all models.
	*/
	/*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Arquivo');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,'modo'=>'geral',
		));
	}
	*/

	/*public function actionIndexUser($id)
	{
		$modelCurrentUser = Usuario::model()->findByPk($id);
		if ($modelCurrentUser->FUNCIONARIO=='sim'){
			//$id=Yii::app()->user->MATRICULA;
			$criteria=new CDbCriteria(array(
				//'order'=>'status desc',
				//'with'   => array('Arquivo'=>array('alias'=>'root')),
				'condition'=>"MAT_USUARIO='".$id."'",

			));
			//$dataProvider=new CActiveDataProvider('Arquivo');
			$dataProvider=new CActiveDataProvider('Arquivo',array('criteria'=>$criteria));

			$this->render('index',array(
				'dataProvider'=>$dataProvider,'modo'=>'usuario','id'=>$id,
			));
		}else{
			Yii::app()->user->setFlash('uploadAlert','Somente funcionários e possuem arquivos.');
			$this->render('index', array('erro'=>'nao','modo'=>'usuario','id'=>$id));
		}
	}*/

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Arquivo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Arquivo']))
			$model->attributes=$_GET['Arquivo'];

		$this->render('admin',array(
			'model'=>$model,'modo'=>'geral',
		));
	}

	public function actionAdminUser($id)
	{
		$modelCurrentUser = Usuario::model()->findByPk($id);
		if ($modelCurrentUser->FUNCIONARIO=='sim'){
			//$model=new Arquivo('search');
			//$model->unsetAttributes();
			//$id=Yii::app()->user->MATRICULA;
			$criteria=new CDbCriteria(array(
				//'order'=>'status desc',
				//'with'   => array('Arquivo'=>array('alias'=>'root')),
				'condition'=>"MAT_USUARIO='".$id."'",

			));
			//$dataProvider=new CActiveDataProvider('Arquivo');
			$dataProvider=new CActiveDataProvider('Arquivo',array('criteria'=>$criteria));

			$this->render('admin',array(
				'dataProvider'=>$dataProvider,'modo'=>'usuario','id'=>$id,
			));
		}else{
			Yii::app()->user->setFlash('uploadAlert','Somente funcionários e possuem arquivos.');
			$this->render('admin', array('erro'=>'nao','modo'=>'usuario','id'=>$id));
		}
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Arquivo the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Arquivo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Arquivo $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='arquivo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionUpload($id) {
		date_default_timezone_set(Yii::app()->params['academiaTimeZone']);
		$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
		$modelCurrentUser = Usuario::model()->findByPk($id);
		if(!Yii::app()->user->isGuest){
			$formUploadModel = new UploadForm;
			$verifPat = new VerificaPatente;
			$ehDiretorOuGestor = $verifPat->isGestorOrDiretor(Yii::app()->user->TIPO);
			if ((Yii::app()->user->MATRICULA!=$id)&&($ehDiretorOuGestor==false)){
				Yii::app()->user->setFlash('uploadAlert','Acesso negado.');
				$this->render('upload', array('model'=>$formUploadModel, 'erro'=>'nao', 'id'=>$id));
			}elseif ($modelCurrentUser->FUNCIONARIO=='sim'){
				if ($academiaRecord){
					$model = new Arquivo;
					$modelCurrentUser = Usuario::model()->findByPk($id);
					if(isset($_POST['UploadForm'])) {
						$formUploadModel->attributes=$_POST['UploadForm'];
						$formUploadModel->ARQUIVO=CUploadedFile::getInstance($formUploadModel,'ARQUIVO');
						$url = Yii::app()->params['uploadBaseLink'].$formUploadModel->ARQUIVO;
						if($formUploadModel->validate()) {
							try{
								$model->MAT_USUARIO = $modelCurrentUser->MATRICULA;
								$model->ID_ACADEMIA = $academiaRecord->CODIGO_CONFIG;
								$model->PERIODO = $academiaRecord->PERIODO;
								$model->DATAHORA = date("Y-m-d H:i:s");
								$model->DESCRICAO = $formUploadModel->DESCRICAO;
								$model->NOMEARQUIVO = $formUploadModel->ARQUIVO;
								$model->URL = $url;
								$model->save();
								$path = Yii::app()->params['uploadDir'].$formUploadModel->ARQUIVO;
								$formUploadModel->ARQUIVO->saveAs($path);
								Yii::app()->user->setFlash('uploadSucess','Obrigado por enviar seu documento, em breve ele será analisado.');
								$this->refresh();
							}catch(CDbException $e){
								Yii::app()->user->setFlash('uploadFail','Este arquivo já existe no sistema, favor entrar em contato com a PROCOMUM.');
								$this->refresh();
							}
						}else{
							Yii::app()->user->setFlash('uploadFail','Você deve inserir um arquivo e uma descrição.');
							$this->refresh();
							//$this->render('upload', array('model'=>$formUploadModel, 'erro'=>'nao','id'=>$id));
						}
					}
					$this->render('upload', array('model'=>$formUploadModel, 'erro'=>'nao', 'id'=>$id));
				}else{
					$this->redirect('index.php?r=academia/manage');
				}
			}else{
				Yii::app()->user->setFlash('uploadAlert','Somente funcionários e servidores podem enviar arquivos.');
				$this->render('upload', array('model'=>$formUploadModel, 'erro'=>'nao','id'=>$id));
			}
		}
		else{
			$this->redirect('index.php?r=site/login');
		}
	}
	public function actionMostrarArquivo($url) {
		$this->redirect($url);
	}
}
