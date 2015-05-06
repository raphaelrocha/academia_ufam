<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUser Usuario */

$situacao;
if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor" || $modelCurrentUser->TIPO == "usuario;diretor" || $modelCurrentUser->TIPO == "usuario;gestor") $situacao = true;
else $situacao = false;


$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    'Create',
);



if(!Yii::app()->user->isGuest){
	
    $this->menu=array(
    	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('usuario/view&id='.Yii::app()->user->MATRICULA)),
    	//array('label'=>'Gerenciar Períodos', 'url'=>array(''), 'visible'=>$situacao),
    	//array('label'=>'Gerar Relatórios', 'url'=>array(''), 'visible'=>$situacao),
    	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Ajuda" title="Voltar"/>', 'url'=>array('configuracao'), 'visible'=>$situacao='false'),
    	//array('label'=>'Logout', 'url'=>array('site/logout')),
    );
}



?>

<?php
    $GLOBALS['nome'] = "Ajuda - Meus dados";
?>

<p style="font-size:16px;"> <b>DADOS DO USUÁRIO</b>
</br>

<img src="images/ajudas/usuarios-8.jpg" width="700px" height="397px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível visualizar os dados do usuário.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Enviar documentos: </b>Permite o usuário enviar documento para que possa utilizar a academia em horário restrito para funcionários.</p>
<p align="justify"><b>(3) Arquivos de dados: </b>Permite a visualização de todos os documentos enviados pelo usuário.</p>
<p align="justify"><b>(4) Editar dados: </b>Permite editar os dados pessoais.</p>
<p align="justify"><b>(5) Dados do usuário: </b>Onde são exibidos todos os dados permitidos do usuário.</p>

 </p></br>

<p style="font-size:16px;"> <b>EDITAR DADOS DO PERFIL:</b>
</br>

<img src="images/ajudas/usuarios-7.jpg" width="700px" height="625px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível editar os dados do usuário.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Campos de dados: </b>Campos com a possibilidade de serem editados.</p>
<p align="justify"><b>(3) Botão de confirmar: </b>Confirma a atualização dos dados do usuário.</p>
<p align="justify"><b>(4) Botão de cancelar: </b>Cancela a atualização dos dados do usuário.</p>

 </p></br>
