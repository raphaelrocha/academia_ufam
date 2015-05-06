<?php



$verificaPatente = new VerificaPatente;
$tipo = $verificaPatente->verificaTipo(Yii::app()->user->TIPO);
if($tipo!="soUsuario"){
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/admin')),
	);
}elseif($tipo=="soUsuario"){
	$this->menu=array(
		array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/view&id='.Yii::app()->user->MATRICULA)),
	);
}





?>

<?php
	$GLOBALS['nome'] = "Ajuda - Arquivos";
?>

<p style="font-size:16px;"> <b>ENVIAR DOCUMENTO</b>
</br>

<img src="images/ajudas/arquivos-1.jpg" width="700px" height="397px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível enviar documentos para acesso à horários restritos para servidores.
		</br>Aqui há acesso às seguintes funcionalidades:
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Arquivos de dados: </b>Permite a visualização de todos os documentos enviados pelo usuário.</p>
<p align="justify"><b>(3) Selecionar o arquivo PDF: </b>Onde o usuário faz o upload do documento em formato PDF.</p>
<p align="justify"><b>(4) Descrição do documento: </b>Onde o usuário informa a descrição do documento quanto ao seu conteúdo.</p>
<p align="justify"><b>(5) Botão de enviar: </b>Ao clicar, o documento será enviado para o sistema e os horários restritos serão liberados.</p>

 </p></br>
