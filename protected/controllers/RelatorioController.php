<?php

class RelatorioController extends Controller
{
	public $layout='//layouts/column2';


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
				  'actions'=>array('filtro','relatorio', 'ajuda'),
				  'users'=>array('@'),
				 ),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				  'actions'=>array('filtro','index','relatorio', 'ajuda'),
				  'users'=>array('*'),
				  'deniedCallback' => function() { Yii::app()->controller->redirect(array ('site/login&value'));}
				 ),
		);
	}



	/*public function actionIndex()
	{
		if(!Yii::app()->user->isGuest){
			$this->render('index');
		}else{
			$this->redirect('index.php');
		}

	}*/

	public function actionAjuda()
	{
		$this->render('ajuda');
	}

	public function actionFiltro()
	{
		$modelRelatorioCpf = new RelatorioCpfForm;
		$modelRelatorioPeriodo = new RelatorioPeriodoForm;

		// Recupera todos os cursos.
		$cursos = Curso::model()->findAllbySql('SELECT ID_CURSO, CONCAT(NOME_CURSO, " - ", ID_CURSO) as NOME_CURSO FROM CURSO ORDER BY NOME_CURSO');
		$cursosArray = CHtml::listData($cursos, 'ID_CURSO', 'NOME_CURSO');

		// Recupera as unidades.
		$unidade = Unidade::model()->findAllbySql('SELECT ID_UNIDADE, CONCAT(ID_UNIDADE, " - ", NOME_UNIDADE) as NOME_UNIDADE FROM UNIDADE ORDER BY NOME_UNIDADE');
		$unidadesArray = CHtml::listData($unidade, 'ID_UNIDADE', 'NOME_UNIDADE');

		// Recupera os períodos.
		$periodos = Academia::model()->findAllbySql('SELECT PERIODO FROM ACADEMIA ORDER BY PERIODO DESC');
		$periodosArray = CHtml::listData($periodos, 'PERIODO','PERIODO');

		// Verificar os dados que foram inseridos
		if(isset($_POST['RelatorioCpfForm'])) {

			$modelRelatorioCpf->attributes = $_POST['RelatorioCpfForm'];
			$record = Usuario::model()->findByAttributes(array('MATRICULA'=>$modelRelatorioCpf->CPF));
			if($record){
				$arr=array('cpf' => $modelRelatorioCpf->CPF,
						   'tipo' => "usuario");
				$values = json_encode($arr);
				$this->redirect('index.php?r=relatorio/relatorio&values='.$values);
			}
			Yii::app()->user->setFlash('erroRelatorioCpf','CPF não encontrado.');
		}

		if(isset($_POST['RelatorioPeriodoForm'])) {
			$modelRelatorioPeriodo->attributes = $_POST['RelatorioPeriodoForm'];
			if($modelRelatorioPeriodo->PERIODO){
				$arr=array('periodo' => $modelRelatorioPeriodo->PERIODO,
						   'tipo' => "estatistico");
				$values = json_encode($arr);
				$this->redirect('index.php?r=relatorio/relatorio&values='.$values);
			}
			Yii::app()->user->setFlash('erroRelatorioPeriodo','Informe um período.');
		}

		$this->render('filtro',array(
			'modelRelatorioCpf'=>$modelRelatorioCpf,
			'modelRelatorioPeriodo'=>$modelRelatorioPeriodo,
			'cursosArray'=>$cursosArray,
			'unidadesArray'=>$unidadesArray,
			'periodosArray'=>$periodosArray,
		));

	}


	public function actionRelatorio($values)
	{
		$trata = new TrataString();
		$pdf = new Pdf("P", "pt", "A4");

		$json = json_decode($values);

		$tipo = $json->tipo;
		//$cpf = $json->cpf;



		if($tipo == "curso"){

			if(!Yii::app()->user->isGuest){
				$models = Curso::model()->findAllbySql('SELECT ID_CURSO, NOME_CURSO FROM CURSO ORDER BY NOME_CURSO');

				$pdf->AliasNbPages();
				$pdf->AddPage();



				$pdf->SetFont("arial", "B", "18");
				$pdf->Cell(0, 5, $trata->converte("Cursos"), 0, 1, "C");
				$pdf->Ln(20);

				$pdf->SetFont("arial", "B", 14);
				$pdf->Cell(80, 20, 'ID Curso', 1, 0, "C");
				$pdf->Cell(460, 20, 'Nome', 1, 1, "C");

				$pdf->SetFont("arial", "", 12);

				foreach($models as $record) {
					$pdf->Cell(80, 20, $trata->converte($record->ID_CURSO), 1, 0,"C");
					$pdf->Cell(460, 20, $trata->converte($record->NOME_CURSO), 1, 1,"C");
				}

				//while($linha = mysqli_fetch_array($cursosArray ))
				//{
				//	$pdf->Cell(80, 20, $linha["ID_CURSO"], 1, 0,"C");
				//	$pdf->Cell(460, 20, $linha["NOME_CURSO"], 1, 1,"C");
				//}

				$pdf->Output();
				//$pdfName = "cursos.pdf";
				//$dir = Yii::app()->params['relatorioDir']; // full path like C:/xampp/htdocs/file/file/
				//$pdf->Output($dir.$pdfName,'F');
				//$pdfLink = Yii::app()->params['relatorioBaseLink'].$pdfName;
				//echo $dir;
				//$this->render('relatorios',array('link'=>$pdfLink));

			}
		}
		elseif($tipo == "estatistico"){

			if(!Yii::app()->user->isGuest){

				$periodo = $json->periodo;

				//pega o numero de udsuarios ativos
				$total = Yii::app()->db->createCommand('SELECT COUNT(DISTINCT U.MATRICULA) AS COU FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal";')->queryAll();

				//pega os numeros e porcentagens de cada sexo
				$sexo = Yii::app()->db->createCommand('SELECT SEXO, COUNT(DISTINCT U.MATRICULA) AS QTDE_SEXO, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) AS COU FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" ) AS PORC_SEXO FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" GROUP BY SEXO ORDER BY QTDE_SEXO DESC;')->queryAll();

				//pega o numero de alunos
				$n_alunos = Yii::app()->db->createCommand('SELECT COUNT(DISTINCT U.MATRICULA) AS QTDE_ALUNO, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) AS COU FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal") AS PORC_ALUNO FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND ALUNO = "sim";')->queryAll();

				//pega os numeros de funcionarios
				$n_funcionarios = Yii::app()->db->createCommand('SELECT COUNT(DISTINCT U.MATRICULA) AS QTDE_FUNC, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) AS COU FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal") AS PORC_FUNC FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND FUNCIONARIO = "sim";')->queryAll();

				//pega os numeros e porcentagens de cada sexo por alunos
				$sexo_aluno = Yii::app()->db->createCommand('SELECT SEXO, COUNT(DISTINCT U.MATRICULA) AS QTDE_SEXO, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND ALUNO = "sim") AS PORC_SEXO FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND ALUNO = "sim" GROUP BY SEXO ORDER BY QTDE_SEXO DESC;')->queryAll();

				//pega os numeros e porcentagens de cada sexo por funcionarios
				$sexo_funcionario = Yii::app()->db->createCommand('SELECT SEXO, COUNT(DISTINCT U.MATRICULA) AS QTDE_SEXO, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND FUNCIONARIO = "sim") AS PORC_SEXO FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND FUNCIONARIO = "sim" GROUP BY SEXO ORDER BY QTDE_SEXO DESC;')->queryAll();

				//pega a lista de dias e o número de usuários nela
				$usuarios_dia = Yii::app()->db->createCommand('SELECT DIASEMANA, SUM((SELECT CAPACIDADE FROM ACADEMIA WHERE PERIODO = "' . $periodo . '" AND TIPOFUNCIONAMENTO = "normal") - TOTAL_USO) AS N_USU, SUM((SELECT CAPACIDADE FROM ACADEMIA WHERE PERIODO = "' . $periodo . '" AND TIPOFUNCIONAMENTO = "normal") - TOTAL_USO)/(SELECT COUNT(DISTINCT U.MATRICULA) AS COU FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal") AS PORC_USU FROM HORARIO AS H JOIN ACADEMIA AS A ON H.ID_ACADEMIA = A.CODIGO_CONFIG WHERE A.PERIODO = "' . $periodo . '" AND A.TIPOFUNCIONAMENTO = "normal" GROUP BY DIASEMANA ORDER BY N_USU DESC;')->queryAll();

				//pega lista de dias e numero de alunos nela
				$alunos_dia = Yii::app()->db->createCommand('SELECT HORARIO.DIASEMANA AS DIASEMANA, COUNT(USUARIO.ALUNO) AS N_ALUNO, COUNT(USUARIO.ALUNO)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND ALUNO = "sim") AS PORC_ALUNO_DIA FROM ((USUARIO INNER JOIN AGENDA ON(USUARIO.MATRICULA=AGENDA.MAT_USUARIO)) INNER JOIN HORARIO ON (AGENDA.ID_HORARIO=HORARIO.ID)) INNER JOIN ACADEMIA ON (HORARIO.ID_ACADEMIA=ACADEMIA.CODIGO_CONFIG) WHERE USUARIO.ALUNO="sim" AND ACADEMIA.PERIODO = "' . $periodo . '" AND ACADEMIA.TIPOFUNCIONAMENTO = "normal" GROUP BY DIASEMANA ORDER BY N_ALUNO DESC;')->queryAll();

				//pega lista de dias e numero de funcionarios nela
				$funcionarios_dia = Yii::app()->db->createCommand('SELECT HORARIO.DIASEMANA AS DIASEMANA, COUNT(USUARIO.ALUNO) AS N_FUNC, COUNT(USUARIO.ALUNO)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND FUNCIONARIO = "sim") AS PORC_FUNC_DIA FROM ((USUARIO INNER JOIN AGENDA ON(USUARIO.MATRICULA=AGENDA.MAT_USUARIO)) INNER JOIN HORARIO ON (AGENDA.ID_HORARIO=HORARIO.ID)) INNER JOIN ACADEMIA ON (HORARIO.ID_ACADEMIA=ACADEMIA.CODIGO_CONFIG) WHERE USUARIO.FUNCIONARIO="sim" AND ACADEMIA.PERIODO = "' . $periodo . '" AND ACADEMIA.TIPOFUNCIONAMENTO = "normal" GROUP BY DIASEMANA ORDER BY N_FUNC DESC;')->queryAll();

				//pega o numero de usuarios pra cada curso
				$usuarios_curso = Yii::app()->db->createCommand('SELECT ID_CURSO, NOME_CURSO, COUNT(DISTINCT U.MATRICULA) AS N_USU, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND ALUNO = "sim") AS PORC_CURSO FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG JOIN CURSO AS C ON U.CURSO = C.ID_CURSO WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" GROUP BY NOME_CURSO ORDER BY N_USU DESC;')->queryAll();

				//pega o numero de usuarios pra cada unidade
				$usuarios_unidade = Yii::app()->db->createCommand('SELECT ID_UNIDADE, NOME_UNIDADE, COUNT(DISTINCT U.MATRICULA) AS N_USU, COUNT(DISTINCT U.MATRICULA)/(SELECT COUNT(DISTINCT U.MATRICULA) FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG WHERE TIPO != "diretor" AND TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND FUNCIONARIO = "sim") AS PORC_UNIDADE FROM USUARIO AS U JOIN AGENDA AS A ON U.MATRICULA = A.MAT_USUARIO JOIN HORARIO AS H ON A.ID_HORARIO = H.ID JOIN ACADEMIA AS AC ON H.ID_ACADEMIA = AC.CODIGO_CONFIG JOIN UNIDADE AS UN ON U.UNIDADE = UN.ID_UNIDADE WHERE U.TIPO != "diretor" AND U.TIPO != "gestor" AND AC.PERIODO = "' . $periodo . '" AND AC.TIPOFUNCIONAMENTO = "normal" AND AC.TIPOFUNCIONAMENTO = "normal" GROUP BY NOME_UNIDADE ORDER BY N_USU DESC;')->queryAll();



				$pdf->AliasNbPages();
				$pdf->AddPage();


				//titulo
				$pdf->SetFont("arial", "B", "16");
				$pdf->Cell(0, 5, $trata->converte("Estatísticas de Usuários"), 0, 1, "C");
				$pdf->Ln(15);


				//subtitulo dados gerais
				$pdf->SetFont("arial", "BU", 14);
				$pdf->Cell(0, 15, $trata->converte("                                                                                                                                                    "), 0, 1, "C");
				$pdf->Cell(0, 20, $trata->converte("                                                               Dados Gerais                                                              "), 0, 1, "C");
				$pdf->Ln(10);


				//numero total de usuarios
				$pdf->SetFont("arial", "", 10);
				foreach ($total as $tot) {
					$pdf->Cell(370, 15, $trata->converte("Número de Usuários"), 1, 0,"C");
					$pdf->Cell(170, 15, $trata->converte($tot["COU"]), 1, 1,"C");
				}
				$pdf->Ln(10);


				$pdf->Cell(280, 20, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Usuários"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach($sexo as $record) {
					$pdf->Cell(280, 15, $trata->converte("   Número de usuários do sexo " . strtoupper($record["SEXO"])), 1, 0,"L");
					$pdf->Cell(130, 15, $trata->converte($record["QTDE_SEXO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($record["PORC_SEXO"])*100 . "%", 1, 1,"C");

				}
				$pdf->Ln(10);

				//numero total de funcionarios
				$pdf->SetFont("arial", "", 10);
				foreach ($n_funcionarios as $nfun) {
					$pdf->Cell(280, 15, $trata->converte("   Número de Servidores que utilizam a academia"), 1, 0,"L");
					$pdf->Cell(130, 15, $trata->converte($nfun["QTDE_FUNC"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($nfun["PORC_FUNC"])*100 . "%", 1, 1,"C");
				}

				//numero total de alunos
				$pdf->SetFont("arial", "", 10);
				foreach ($n_alunos as $nal) {
					$pdf->Cell(280, 15, $trata->converte("   Número de Alunos que utilizam a academia"), 1, 0,"L");
					$pdf->Cell(130, 15, $trata->converte($nal["QTDE_ALUNO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($nal["PORC_ALUNO"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(15);


				//subtitulo dados dos dias
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(0, 20, $trata->converte("Usuários por Dia"), 0, 1, "C");
				$pdf->Ln(10);

				//dias da semana e numero de usuarios
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Usuários"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach ($usuarios_dia as $usudia) {
					$pdf->Cell(280, 15, $trata->converte($usudia["DIASEMANA"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usudia["N_USU"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usudia["PORC_USU"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(25);


				//subtitulo dados alunos
				$pdf->SetFont("arial", "BU", 14);
				$pdf->Cell(0, 15, $trata->converte("                                                                                                                                                    "), 0, 1, "C");
				$pdf->Cell(0, 20, $trata->converte("                                                       Estatísticas de Alunos                                                      "), 0, 1, "C");
				$pdf->Ln(10);


				//numero total de alunos
				$pdf->SetFont("arial", "", 10);
				foreach ($n_alunos as $nal) {
					$pdf->Cell(370, 15, $trata->converte("Número total de usuários alunos"), 1, 0,"C");
					$pdf->Cell(170, 15, $trata->converte($nal["QTDE_ALUNO"]), 1, 1,"C");
				}
				$pdf->Ln(15);

				//sexo por alunos
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Alunos"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach($sexo_aluno as $record) {
					$pdf->Cell(280, 15, $trata->converte("   Número de alunos do sexo " . strtoupper($record["SEXO"])), 1, 0,"L");
					$pdf->Cell(130, 15, $trata->converte($record["QTDE_SEXO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($record["PORC_SEXO"])*100 . "%", 1, 1,"C");

				}
				$pdf->Ln(10);

				//subtitulo dados dos dias por alunos
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(0, 20, $trata->converte("Alunos por Dia"), 0, 1, "C");
				$pdf->Ln(10);

				//dias da semana e numero de alunos
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Alunos"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach ($alunos_dia as $aldia) {
					$pdf->Cell(280, 15, $trata->converte($aldia["DIASEMANA"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($aldia["N_ALUNO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($aldia["PORC_ALUNO_DIA"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(15);


				//subtitulo alunos por curso
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(0, 20, $trata->converte("Alunos por Curso"), 0, 1, "C");
				$pdf->Ln(10);

				//alunos por curso
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Alunos"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach ($usuarios_curso as $usucurso) {
					$pdf->Cell(280, 15, $trata->converte($usucurso["ID_CURSO"] . " - " . $usucurso["NOME_CURSO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usucurso["N_USU"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usucurso["PORC_CURSO"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(15);


				//subtitulo dados servidores
				$pdf->SetFont("arial", "BU", 14);
				$pdf->Cell(0, 15, $trata->converte("                                                                                                                                                    "), 0, 1, "C");
				$pdf->Cell(0, 20, $trata->converte("                                                   Estatísticas de Servidores                                                    "), 0, 1, "C");
				$pdf->Ln(10);


				//numero total de funcionarios
				$pdf->SetFont("arial", "", 10);
				foreach ($n_funcionarios as $nfun) {
					$pdf->Cell(370, 15, $trata->converte("Número total de usuários servidores"), 1, 0,"C");
					$pdf->Cell(170, 15, $trata->converte($nfun["QTDE_FUNC"]), 1, 1,"C");
				}
				$pdf->Ln(15);

				//sexo por funcionarios
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Servidores"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach($sexo_funcionario as $record) {
					$pdf->Cell(280, 15, $trata->converte("   Número de servidores do sexo " . strtoupper($record["SEXO"])), 1, 0,"L");
					$pdf->Cell(130, 15, $trata->converte($record["QTDE_SEXO"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($record["PORC_SEXO"])*100 . "%", 1, 1,"C");


				}
				$pdf->Ln(10);

				//dias da semana e numero de funcionarios
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Servidores"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach ($funcionarios_dia as $fundia) {
					$pdf->Cell(280, 15, $trata->converte($fundia["DIASEMANA"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($fundia["N_FUNC"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($fundia["PORC_FUNC_DIA"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(15);

				//subtitulo funcionarios por unidade
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(0, 20, $trata->converte("Servidores por Unidade"), 0, 1, "C");
				$pdf->Ln(10);

				//funcionarios por unidade
				$pdf->Cell(280, 15, " ", 0, 0, "C");
				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(130, 15, $trata->converte("Nº de Servidores"), 1, 0, "C");
				$pdf->Cell(130, 15, $trata->converte("%"), 1, 1, "C");
				$pdf->SetFont("arial", "", 10);
				foreach ($usuarios_unidade as $usuuni) {
					$pdf->Cell(280, 15, $trata->converte($usuuni["ID_UNIDADE"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usuuni["N_USU"]), 1, 0,"C");
					$pdf->Cell(130, 15, $trata->converte($usuuni["PORC_UNIDADE"])*100 . "%", 1, 1,"C");
				}
				$pdf->Ln(25);


				$pdf->Output();
			}

		}
		elseif($tipo == "usuario"){

			$cpf = $json->cpf;

			if(!Yii::app()->user->isGuest){

				$models = Yii::app()->db->createCommand('CALL DADOS_USUARIO("'.$cpf.'");')->queryAll();
				if($models == null) $this->redirect("index.php?r=relatorio/filtro");

				$agenda = Yii::app()->db->createCommand('CALL AGENDA_USUARIO("'.$cpf.'");')->queryAll();

				$pdf->AliasNbPages();
				$pdf->AddPage();



				$pdf->SetFont("arial", "B", "14");
				foreach($models as $record) {
					$pdf->Cell(0, 5, $trata->converte("Dados do Usuário: ") . $trata->converte($record["NOME"]) . " " . $trata->converte($record["SOBRENOME"]), 0, 1, "C");
					$pdf->Ln(20);
				}

				$pdf->SetFont("arial", "B", 12);
				$pdf->Cell(0, 20, 'Dados Pessoais', 0, 1, "C");
				$pdf->Ln(10);

				foreach($models as $record) {
					$pdf->SetFont("arial", "B", 10);
					$pdf->Cell(280, 20, $trata->converte("Tipo de usuário"), 1, 0,"C");
					$pdf->SetFont("arial", "", 10);
					$pdf->Cell(260, 20, $trata->converte($record["TIPO"]), 1, 1,"C");
					$pdf->Ln(5);

					$pdf->SetFont("arial", "B", 10);
					$pdf->Cell(280, 20, $trata->converte("Aluno"), 1, 0,"C");
					$pdf->SetFont("arial", "", 10);
					$pdf->Cell(260, 20, $trata->converte($record["ALUNO"]), 1, 1,"C");
					$pdf->Ln(5);

					$pdf->SetFont("arial", "B", 10);
					$pdf->Cell(280, 20, $trata->converte("Servidor"), 1, 0,"C");
					$pdf->SetFont("arial", "", 10);
					$pdf->Cell(260, 20, $trata->converte($record["FUNCIONARIO"]), 1, 1,"C");
					$pdf->Ln(10);

					if ($record["ALUNO"] == "sim"){
						$pdf->SetFont("arial", "B", 10);
						$pdf->Cell(280, 20, $trata->converte("Curso"), 1, 0,"C");
						$pdf->SetFont("arial", "", 10);
						$pdf->Cell(260, 20, $trata->converte($record["ID_CURSO"]) . " - " . $trata->converte($record["NOME_CURSO"]), 1, 1,"C");
						$pdf->Ln(10);
					}

					if ($record["FUNCIONARIO"] == "sim"){
						$pdf->SetFont("arial", "B", 10);
						$pdf->Cell(280, 20, $trata->converte("Unidade de Locação"), 1, 0,"C");
						$pdf->SetFont("arial", "", 10);
						$pdf->Cell(260, 20, $trata->converte($record["UNIDADE"]), 1, 1,"C");
						$pdf->Ln(10);
					}

				}
				$pdf->Ln(20);



				//AGENDA
				$pdf->SetFont("arial", "B", 12);
				$pdf->Cell(0, 5, $trata->converte("Agenda"), 0, 1, "C");
				$pdf->Ln(10);

				$pdf->SetFont("arial", "B", 10);
				$pdf->Cell(160, 20, $trata->converte("Dia"), 1, 0, "C");
				$pdf->Cell(170, 20, $trata->converte("Horário"), 1, 0, "C");
				$pdf->Cell(70, 20, $trata->converte("Faltas"), 1, 0, "C");
				$pdf->Cell(140, 20, $trata->converte("Quem marcou"), 1, 1, "C");

				$pdf->SetFont("arial", "", 10);
				foreach($agenda as $record) {
					$pdf->Cell(160, 20, $trata->converte($record["DIASEMANA"]), 1, 0,"C");
					$pdf->Cell(170, 20, $trata->converte($record["HORAINICIO"]) . " - " . $trata->converte($record["HORAFIM"]), 1, 0,"C");
					$pdf->Cell(70, 20, $trata->converte($record["FALTA"]), 1, 0,"C");
					$pdf->Cell(140, 20, $trata->converte($record["MARC"]), 1, 1,"C");
				}


				$pdf->Output();

			}
		}

	}
}
