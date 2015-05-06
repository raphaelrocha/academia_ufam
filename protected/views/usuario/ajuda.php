
<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUser Usuario */

$situacao;
if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor") $situacao = true;
else $situacao = false;


$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    'Create',
);


$this->menu=array(

  array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin')),
);


if(!Yii::app()->user->isGuest){
	$tipo;
	if($modelCurrentUser->TIPO == "aluno") $tipo = "ajuda_aluno";
	else $tipo = "ajuda";
		
    $this->menu=array(
    	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('admin'), 'visible'=>$situacao),
    	//array('label'=>'Gerenciar Períodos', 'url'=>array(''), 'visible'=>$situacao),
    	//array('label'=>'Gerar Relatórios', 'url'=>array(''), 'visible'=>$situacao),
    	//array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array($tipo)),
    	//array('label'=>'Logout', 'url'=>array('site/logout')),
    );
}



?>

<?php
    $GLOBALS['nome'] = "Ajuda - Usuários";
?>
<p align="justify" >Você está na área: Usuário. Os únicos usuários permitidos aqui são gestores e diretores. </p>

<p style="font-size:16px;"> <b>TELA INICIAL:</b>
</br>

<img src="images/ajudas/usuarios.jpg" width="700px" height="433px" > </img>

</br>
<p align="justify"> Esta tela tem como objetivo permitir que gestores e diretores possam controlar os usuários do sistema e saber quantos
      usuários existem que estão frequentando a academia.
      Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Adicionar novo usuário: </b>Permite o usuário do sistema adicionar um novo usuário.</p>
<p align="justify"><b>(3) Editar perfil: </b>Permite o usuário da academia editar os seus próprios dados.</p>
<p align="justify"><b>(4) Botão de arquivos dos usuários: </b>Permite o gestor visualizar todos os arquivos que foram enviados para o sistema.</p>
<p align="justify"><b>(5) Tabela de usuários: </b>Lista todos os usuários da academia, permitindo o gestor ou diretor gerenciar os usuário da academia.</p>
<p align="justify"><b>(6) Ver dados do usuário: </b>Mostra os dados referente ao usuário da linha clicada.</p>
<p align="justify"><b>(7) Editar dados do usuário: </b>Permite editar os dados pessoais referente ao usuário da linha clicada.</p>

 </p></br>


 <p style="font-size:16px;"> <b>ADICIONAR NOVO USUÁRIO PARTE 1:</b>
</br>

<img src="images/ajudas/usuarios-1.jpg" width="700px" height="356px" > </img>

</br>
<p align="justify"> Esta tela tem como objetivo iniciar o processo de cadastro de um novo usuário através de seu CPF.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Campo de CPF: </b>Onde será inserido o CPF (deve ser válido) do usuário a ser adicionado no sistema.</p>
<p align="justify"><b>(3) Check box de validação no SIE: </b>Permite adicionar um usuário sem que ele esteja cadastrado no SIE.</p>
<p align="justify"><b>(4) Botão de confirmar: </b>Confirma o CPF e passa para a próxima tela.</p>
<p align="justify"><b>(5) Botão de cancelar: </b>Cancela o processo e retorna à tela anterior.</p>

 </p></br>


 <p style="font-size:16px;"> <b>ADICIONAR NOVO USUÁRIO PARTE 2:</b>
</br>

<img src="images/ajudas/usuarios-2.jpg" width="500px" height="524px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela, o cadastro do usuário continua, preenchendo os campos.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Campos de dados: </b>Onde será inserido os dados do usuário a ser adicionado no sistema.</p>
<p align="justify"><b>(3) Botão de confirmar: </b>Confirma o registro de novo usuário.</p>
<p align="justify"><b>(4) Botão de cancelar: </b>Cancela o processo de registro de novo usuário.</p>

 </p></br>

<p style="font-size:16px;"> <b>ATUALIZAR DADOS DO PERFIL:</b>
</br>

<img src="images/ajudas/usuarios-3.jpg" width="700px" height="461px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível editar os dados do usuário.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Enviar documento: </b>Onde é possivel o usuário servidor enviar documento para autorizar marcações na academia em períodos restritos para servidores.</p>
<p align="justify"><b>(3) Arquivos: </b>Mostra os documentos que o usuário enviou.</p>
<p align="justify"><b>(4) Agenda do usuário: </b>Mostra a agenda com os horários marcados pelo usuário.</p>
<p align="justify"><b>(5) Campos de dados: </b>Campos com a possibilidade de serem editados.</p>
<p align="justify"><b>(6) Botão de confirmar: </b>Confirma a atualização dos dados do usuário.</p>
<p align="justify"><b>(7) Botão de cancelar: </b>Cancela a atualização dos dados do usuário.</p>

 </p></br>

 <p style="font-size:16px;"> <b>GERENCIADOR DE ARQUIVOS:</b>
</br>

<img src="images/ajudas/usuarios-4.jpg" width="700px" height="297px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível visualizar todos os arquivos enviados por todos os usuários do sistema.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Tabela de arquivos enviados: </b>Onde são exibidos todos os arquivos enviados.</p>

 </p></br>

<p style="font-size:16px;"> <b>DADOS DO USUÁRIO</b>
</br>

<img src="images/ajudas/usuarios-5.jpg" width="700px" height="395px"  text-align="center"> </img>

</br>
<p align="justify"> Nesta tela é possível visualizar os dados do usuário solicitado.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Editar dados do usuário: </b>Permite editar os dados pessoais referente ao usuário em visualização.</p>
<p align="justify"><b>(3) Dados do usuário: </b>Onde são exibidos todos os dados permitidos do usuário selecionado.</p>

 </p></br>

