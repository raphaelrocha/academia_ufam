<?php

class AcademiaController extends Controller
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
				  'actions'=>array('create','update','index','view','manage','admin','delete','ajuda'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),*/
			array('deny',  // deny all users
				  'actions'=>array('create','update','index','view','manage','admin','delete','ajuda'),
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
		$model=new Academia;
		$calendario = new Calendario;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Academia']))
		{
			$model->attributes=$_POST['Academia'];
			if($model->TIPOFUNCIONAMENTO == "ferias"){
				$model->DURACAO_PERIODO = "00:00:00";
				$model->PERIODO = $calendario->getPeriodo($model->DATA_INICIO);
			}else{
				$model->PERIODO = $calendario->getPeriodo($model->DATA_INICIO);
			}

			try{
				if($model->save()){
					//echo "foi";
					//$this->redirect(array('view','id'=>$model->CODIGO_CONFIG));
					//$gravaHorario = new CriaHorario();
					//$status = $gravaHorario->gravaHorarios($model->CODIGO_CONFIG);
					$this->redirect('index.php?r=academia/manage');
					//$this->redirect('index.php?r=horario/index');
				}
			}
			catch(Exception $e){
				echo "
					<script type=\"text/javascript\">
						alert('ERRO AO SALVAR: Só é permitido um perfil por perído do ano.');
					</script>
				";
			}
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$calendario = new Calendario;
		$dao = new Dao;

		$model->DATA_INICIO = $calendario->dataDbToDataForm($model->DATA_INICIO);
		$model->DATA_FIM = $calendario->dataDbToDataForm($model->DATA_FIM);

		/*
		Salva todos os dados do modelo no objeto editControl
		Estes dados serão comparados com o _POST do form.
		*/
		$editControl = new AcademiaEditControl;
		$calendario = new Calendario;
		$editControl->setCapacidade($model->CAPACIDADE);
		$editControl->setCota($model->COTA);
		$editControl->setHoraAbertura($calendario->getHoraFormatada($model->HORA_ABERTURA));
		$editControl->setHoraFechamento($calendario->getHoraFormatada($model->HORA_FECHAMENTO));
		$editControl->setTipoFuncionamento($model->TIPOFUNCIONAMENTO);
		$editControl->setDuracaoPeriodo($model->DURACAO_PERIODO);
		$editControl->setDataInicio(md5($model->DATA_INICIO));
		$editControl->setDataFim(md5($model->DATA_FIM));


		//$model->DATA_INICIO = $calendario->dataDbToDataForm($model->DATA_INICIO);
		//$model->DATA_FIM = $calendario->dataDbToDataForm($model->DATA_FIM);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Academia']))
		{
			$model->attributes=$_POST['Academia'];
			if($model->TIPOFUNCIONAMENTO == "ferias"){
				$model->DURACAO_PERIODO = "00:00:00";
			}
			//try{
			//$model->DATA_INICIO = $calendario->dataFormToDataDb($model->DATA_INICIO);//FORMATA DATA DO FORM PRO BANCO
			//$model->DATA_FIM = $calendario->dataFormToDataDb($model->DATA_FIM);//FORMATA DATA DO FORM PRO BANCO

			/*
			COMPARA OS DADOS COLETADOS NO _POST COM OS DADOS ARMAZENADOS NO EDITCONTROL
			ESSE OBJETO GARENTE A AUTORIZAÇÃO DE EDIÇÃO DO PERFIL COM MARCAÇÕES, APENAS PARA
			MUDANÇAS NO VALOR DA DATA FINAL.
			*/
			$atthMudanca = $editControl->autorizaMudanca($model->CAPACIDADE,
														 $model->COTA,
														 $calendario->getHoraFormatada($model->HORA_ABERTURA),
														 $calendario->getHoraFormatada($model->HORA_FECHAMENTO),
														 $model->TIPOFUNCIONAMENTO,
														 $model->DURACAO_PERIODO,
														 md5($model->DATA_INICIO),
														 md5($model->DATA_FIM));

			$dao = new Dao;
			$ret;
			if($atthMudanca=="sim"){
				$model->DATA_INICIO = $calendario->dataFormToDataDb($model->DATA_INICIO);//FORMATA DATA DO FORM PRO BANCO
				$model->DATA_FIM = $calendario->dataFormToDataDb($model->DATA_FIM);//FORMATA DATA DO FORM PRO BANCO

				if($model->save()){
					$this->redirect('index.php?r=academia/manage');
					$ret=1;
				}
				$model->DATA_INICIO = $calendario->dataDbToDataForm($model->DATA_INICIO);
				$model->DATA_FIM = $calendario->dataDbToDataForm($model->DATA_FIM);
				//$this->render('update',array(
				//	'model'=>$model,
				//));
			}elseif($atthMudanca=="nadaMudou"){
				$this->redirect('index.php?r=academia/manage');
			}else{
				$model->DATA_INICIO = $calendario->dataFormToDataDb($model->DATA_INICIO);//FORMATA DATA DO FORM PRO BANCO
				$model->DATA_FIM = $calendario->dataFormToDataDb($model->DATA_FIM);//FORMATA DATA DO FORM PRO BANCO

				$ret = $dao->contaMarcacoesDaAcademia($model->CODIGO_CONFIG);
				if($ret==0){
					if($model->save()){
						/*$sqlCommand = Yii::app()->db->createCommand("UPDATE HORARIO
												   SET TOTAl_USO = (SELECT CAPACIDADE
																	FROM ACADEMIA
																	WHERE CODIGO_CONFIG='".$model->CODIGO_CONFIG."')
												   WHERE ID_ACADEMIA = '".$model->CODIGO_CONFIG."'");


						$sqlCommand->execute();*/
						$dao->deletaHorarios($model->CODIGO_CONFIG);
						$gravaHorario = new CriaHorario();
						$status = $gravaHorario->gravaHorarios($model->CODIGO_CONFIG);
						$dao->desativaAcademia($model->CODIGO_CONFIG);
						//$dao->atualizaCapHorarios($model->CODIGO_CONFIG);//atualiza a capcidade nos resgistros de horario.
						//$this->redirect('index.php?r=horario/index&value='.$model->CODIGO_CONFIG);
						$this->redirect('index.php?r=academia/manage');
					}
					//$this->redirect('index.php?r=academia/update&id='.$id);
				}else{
					Yii::app()->user->setFlash('erroHorario','Este perfil já possui marcações e não pode ser alterado.');
					$this->redirect('index.php?r=academia/update&id='.$id);
				}
			}
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		$dao = new Dao;
		$marcacoes = $dao->contaMarcacoesDaAcademia($id);
		$result=null;

		if($marcacoes==0){
			$dao->deletaHorarios($id);
			$result = $this->loadModel($id)->delete();
			//$this->redirect('index.php?r=site/configuracao&view=configuracao');
			//$this->redirect('index.php?r=academia/manage');
		}

		if (Yii::app()->request->isAjaxRequest)
		{
			if ($result!=null)
			{
				echo "Data has been deleted.";
				Yii::app()->end();
			}
			else
			{
				//echo "<script type=\"text/javascript\"> alert('ATENÇÃO! Este perfil possui marcações e não pode ser deletado.');</script>";
				throw new CHttpException(500, "\nEste perfil possui marcações e não pode ser excluído.");
			}
		}
		///else{
			//echo "
			//		<script type=\"text/javascript\">
			//			alert('ATENÇÃO! Este perfil possui marcações e não pode ser deletado.');
			//		</script>
			//		";

			//Yii::app()->user->setFlash('erroDeleteAcademia',"ATENÇÃO! Este perfil possui marcações e não pode ser deletado.");
			//$this->redirect(array('academia/admin'), true);
		//}
		//$this->redirect('index.php?r=site/configuracao&view=configuracao');

		//else{
		//echo 'delete';
		//	$model=new Academia;
		//	$dataProvider=new CActiveDataProvider('Academia',array('criteria'=>array('order'=>'CODIGO_CONFIG DESC',)));
		//	Yii::app()->user->setFlash('erroDeleteAcademia',"ATENÇÃO! Este perfil possui marcações e não pode ser deletado.");
		//$this->redirect('index.php?r=horario/admin');
		//$this->render('admin',array(
		//		'model'=>$model, 'dataProvider'=>$dataProvider,
		//	));
		//}

		//Yii::app()->user->setFlash('erroDeleteAcademia',"ATENÇÃO! Este perfil possui marcações e não pode ser deletado");
		//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax'])){
			$this->redirect('index.php?r=academia/manage');
		}else{
			$this->redirect('index.php?r=academia/manage');
		}*/
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAjuda()
	{
		$this->render('ajuda');

	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		//$dataProvider=new CActiveDataProvider('Academia');
		$dataProvider=new CActiveDataProvider('Academia', array('criteria'=>array('order'=>'SITUACAO ASC')));


		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Academia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Academia']))
			$model->attributes=$_GET['Academia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Academia the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Academia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Academia $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='academia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionManage()
	{
		$modelCurrentUser = Usuario::model()->findByPk(Yii::app()->user->getState('MATRICULA'));
		$modelRestricao = Restricao::model()->findByAttributes(array('SITUACAO'=>'ativo'));
		$calendario = new Calendario;

		if($modelRestricao){
			$time = strtotime($modelRestricao->HORAINICIO);
			$inicio = date('H:i',$time);
			$time = strtotime($modelRestricao->HORAFIM);
			$fim = date('H:i',$time);
			if($modelRestricao->LIBERA_ALMOCO=="ativo"){
				Yii::app()->user->setFlash('restricaoAlert2',"ATENÇÃO! A restrição de horário para funcionários, está ATIVADA. [".$inicio." ás ".$fim."]");
			}else{
				Yii::app()->user->setFlash('restricaoAlert3',"ATENÇÃO! A restrição de horário para funcionários, está ATIVADA. [".$inicio." ás ".$fim."]");
			}

		}else{
			Yii::app()->user->setFlash('restricaoAlert',"A restrição de horário para funcionários, está DESATIVADA.");
		}
		if($modelCurrentUser->TIPO != "usuario"){

			$model=new Academia;
			$dataProvider=new CActiveDataProvider('Academia',array('criteria'=>array('order'=>'CODIGO_CONFIG DESC',)));

			if (isset($_POST['confirmar']))
			{
			    if (isset($_POST['selectedIds']))
			    {
			        $count = 0;
			        foreach ($_POST['selectedIds'] as $id)
			        {
			            $config = $this->loadModel($id);
						if($calendario->comparaDataComDataAtual($config->DATA_FIM)=="true"){
							//$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$config->CODIGO_CONFIG.')');
							//$command->execute();
							$gravaHorario = new CriaHorario();
							if($config->TIPOFUNCIONAMENTO!="ferias"){
								//$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$config->CODIGO_CONFIG.')');
								//$command->execute();
								$status = $gravaHorario->gravaHorarios($config->CODIGO_CONFIG);
								$dao = new Dao;
								$ret = $dao->contaMarcacoesDaAcademia($config->CODIGO_CONFIG);
								if($ret==0){
									if($config->COTA=="sim"){
										$this->redirect('index.php?r=horario/index&value='.$config->CODIGO_CONFIG);
									}else{
										$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$config->CODIGO_CONFIG.')');
										$command->execute();
										//$status=1;
									}
								}else{
									$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$config->CODIGO_CONFIG.')');
									$command->execute();
									$status=1;
								}
							}else{
								$command = Yii::app()->db->createCommand('CALL UPDATE_ACADEMIA_SITUACAO ('.$config->CODIGO_CONFIG.')');
								$command->execute();
								$status=2;
							}
						}else{
							$status=4;
						}
					}
					//$this->redirect("index.php?r=academia/manage");
				}else{
					$command = Yii::app()->db->createCommand("UPDATE ACADEMIA SET SITUACAO ='inativo' WHERE CODIGO_CONFIG>=0");
					$command->execute();
					$status=3;
				}
			}elseif(isset($_POST['cancelar'])){
				$this->redirect('index.php?r=site/configuracao&view=configuracao');
			}
			$iterator = new CDataProviderIterator($dataProvider);
			foreach($iterator as $row) {
				$row->DATA_INICIO = $calendario->dataDbToDataForm($row->DATA_INICIO);
				$row->DATA_FIM = $calendario->dataDbToDataForm($row->DATA_FIM);
				$row->HORA_ABERTURA = $calendario->formataHora($row->HORA_ABERTURA);
				$row->HORA_FECHAMENTO = $calendario->formataHora($row->HORA_FECHAMENTO);
				$row->DURACAO_PERIODO = $calendario->formataHora($row->DURACAO_PERIODO);
			}
			$this->render('manage',array(
				'model'=>$model, 'dataProvider'=>$dataProvider,
			));


			/*
			PARA QUE NÃO OCORRA ERRO NA RENDERIZAÇÃO DA TELA, TIVE QUE COLOCAR
			ESTAS MENSAGENS APÓS O RENDER DA TELA MANGE
			*/
			if (isset($_POST['confirmar']))
			{
				if($status==1){
					echo '
						<script>
							alert("AVISO! \nA grade de para marcação de horários neste período foi RE-ATIVADA.");
						</script>
						';
				}else if ($status==0){
					echo '
						<script>
							alert("AVISO! \nA grade de para marcação de horários neste período foi CRIADA");
						</script>
						';
				}else if ($status==2){
					echo '
						<script>
							alert("AVISO! \nEm período de férias a grade de marcação de horários não é criada.");
						</script>
						';
				}
				else if ($status==3){
					echo '
						<script>
							alert("ALERTA! \n[1] SISTEMA DA ACADEMIA, SEM PERFIL DE FUNCIONAMENTO ATIVADO. \n[2] ISTO PODE OCASIONAR UM FUNCIONAMENTO INSTÁVEL DO SISTEMA. \n[3] SE VOCÊ ESTÁ COM PROBLEMAS PARA ATIVAR UM PERFIL, ENTRE EM CONTATO COM SUPORTE.");
						</script>
						';
				}
				else if ($status==4){
					echo '
						<script>
							alert("ERRO! \n[1] A data final deste perfil não é mais válida. \n[2] Impossível ativar este perfil.");
						</script>
						';
				}
				else if ($status==5){
					echo '
						<script>
							alert("ERRO! \n[1] A capacidade dever ser expresso com um valor par.");
						</script>
						';
				}
			}

		}
		else{
			$this->redirect('index.php?r=site/index');
		}
	}


}
