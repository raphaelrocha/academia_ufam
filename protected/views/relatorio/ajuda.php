<?php
/* @var $this CursoController */
/* @var $model Curso */


$this->menu=array(

	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('filtro')),
);
?>

<?php
    $GLOBALS['nome'] = "Ajuda - Relatórios";
?>

<p align="justify" >Você está na área: Relatórios. Os únicos usuários permitidos aqui são gestores e diretores. </p>

<p style="font-size:16px;"> <b>FILTRO DOS RELATÓRIOS:</b>
</br>

<img src="images/ajudas/relatorios.jpg" width="700px" height="306px" > </img>

</br>
<p align="justify"> Esta tela tem como objetivo permitir que gestores e diretores possam gerar relatórios de dados do sistema.
      </br>Aqui há acesso às seguintes funcionalidades: 
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Opções de relatórios: </b>Mostra os relatórios disponíveis e quais dados são necessários para gerá-los.</p>
<p align="justify"><b>(3) Relatório de dados individual: </b>Gera um relatório com dados de uso do usuário cujo CPF for inserido.</p>
<p align="justify"><b>(4) Relatório estatístico por períodos: </b>Gera um relatório geral de dados referentes ao período escolhido.</p>
 </p></br>

