<?php

class AgendaController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update','index','view','admin','delete','agendamento', 'ajuda'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('@'),
			),*/
			array('deny',  // deny all users
				  'actions'=>array('create','update','index','view','admin','delete','agendamento', 'ajuda'),
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
		$model=new Agenda;
		$horarioDataProvider=new CActiveDataProvider('Horario', array('criteria'=>array('order'=>'HORAINICIO ASC')));
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['confirmar']))
		{
			if (isset($_POST['selectedIds']))
			{
				$count = 0;
				foreach ($_POST['selectedIds'] as $id)
				{
					$count++;
					//	$comment = $this->loadModel($id);
				//	$comment->is_published = 1;
				//	$comment->update(array('is_published'));
				}
				echo $count;
			}
		}

		$this->render('create',array(
			'model'=>$model, 'horarioDataProvider'=>$horarioDataProvider, 'modelCurrentUser'=>$modelCurrentUser
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$horarioDataProvider=new CActiveDataProvider('Horario', array('criteria'=>array('order'=>'HORAINICIO ASC')));
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Agenda']))
		{
			$model->attributes=$_POST['Agenda'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model, 'horarioDataProvider'=>$horarioDataProvider, 'modelCurrentUser'=>$modelCurrentUser
		));
	}

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



	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Agenda');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Agenda('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Agenda']))
			$model->attributes=$_GET['Agenda'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAjuda()
	{
		$this->render('ajuda');
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Agenda the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Agenda::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Agenda $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='agenda-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAgendamento(){
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$dao = new Dao;
		if(!Yii::app()->user->isGuest){
			$verificaPatente = new VerificaPatente;
			$patente = $verificaPatente->isPatente(Yii::app()->user->getState('TIPO'));
			//echo $patente;
			if (strpos(Yii::app()->user->TIPO,'usuario') !== false){
				//if (($patente!="diretor")&&($patente!="gestor")){
				//echo "entrou no if";
				$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
				if($academiaRecord){
					if(Yii::app()->user->FUNCIONARIO=="sim"){
						$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));
						$models = Arquivo::model()->findAllbySql("SELECT COUNT(MAT_USUARIO) AS MAT_USUARIO FROM ARQUIVO WHERE MAT_USUARIO='".Yii::app()->user->MATRICULA."'");
						$qtdeDoc=0;
						if($modelRestricao){
							$time = strtotime($modelRestricao->HORAINICIO);
							$inicio = date('H:i',$time);
							$time = strtotime($modelRestricao->HORAFIM);
							$fim = date('H:i',$time);
							//$qtdeDoc=0;
							//$models = Arquivo::model()->findAllbySql("SELECT COUNT(MAT_USUARIO) AS MAT_USUARIO FROM ARQUIVO WHERE MAT_USUARIO='".Yii::app()->user->MATRICULA."'");
							//foreach($models as $record) {
							//	$qtdeDoc = $record->MAT_USUARIO;
							//}
							$qtdeDoc = $dao->contaDocAcadAtv(Yii::app()->user->MATRICULA,$academiaRecord->CODIGO_CONFIG);
							//echo $qtdeDoc;
							if($qtdeDoc==0){
								Yii::app()->user->setFlash('gridAlert',"ATENÇÃO: Você é um funcionário e não deve usar a academia das ".$inicio." ás ".$fim.". Para usar neste horário, você deve enviar um documento de autorização.");
								$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'sim','infoDocOk'=>'nao'));
							}else{
								$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'nao','infoDocOk'=>'sim'));
							}
						}else{
							//foreach($models as $record) {
							//	$qtdeDoc = $record->MAT_USUARIO;
							//}
							$qtdeDoc = $dao->contaDocAcadAtv(Yii::app()->user->MATRICULA,$academiaRecord->CODIGO_CONFIG);
							if($qtdeDoc==0){
								Yii::app()->user->setFlash('gridAlert2',"ATENÇÃO: Você é um funcionário e não deve usar a academia em horário de expediente. Para usar neste horário, você deve enviar um documento de autorização.");
								$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'nao','infoDocOk'=>'nao'));
							}else{
								$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'nao','infoDocOk'=>'sim'));
							}
							//$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'nao'));
						}
					}else if (Yii::app()->user->FUNCIONARIO=="nao"){
						$this->render('index',array('academiaRecord'=>$academiaRecord,'semDoc'=>'nao','infoDocOk'=>'semdoc'));
					}
				}else{
					$this->render('indexSemAcad',array('wtvr'=>'wtvr'));
				}

			}else if (strpos(Yii::app()->user->TIPO,'usuario') == false) {
				//}else  {
				$academiaRecord = Academia::model()->findByAttributes(array('SITUACAO'=>'ativo'));
				//$this->redirect(array('configuracao','academiaRecord'=>$academiaRecord));
				$this->redirect('index.php?r=site/configuracao',array('academiaRecord'=>$academiaRecord));
				//$this->render('configuracao',array('academiaRecord'=>$academiaRecord));
			}
		}
		else{
			//echo 'nÃ£o esta logado';
			$this->redirect('index.php?r=site/login&value');
		}


	}
}
