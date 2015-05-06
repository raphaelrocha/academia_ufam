<?php
/* @var $this CursoController */
/* @var $model Curso */


$this->menu=array(

	array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('agenda/agendamento')),
);
?>

<?php
    $GLOBALS['nome'] = "Ajuda - Agenda";
?>


<p style="font-size:16px;"> <b>AGENDA:</b>
</br>

<img src="images/ajudas/agenda.jpg" width="700px" height="772px" > </img>

</br>
<p align="justify"><b>(1) Voltar: </b>Permite o usuário do sistema a voltar para a tela anterior.</p>
<p align="justify"><b>(2) Observação sobre documentos: </b>Caso o usuário seja servidor, haverá essa observação caso o usuário não tenha enviado algum documento. Esta medida é para alertar o motivo da restrição.</p>
<p align="justify"><b>(3) Dados do perfil: </b>São mostrados dados do perfil da academia, como horário de abertura, de fechamento e a data que o perfil acaba.</p>
<p align="justify"><b>(4) Grid de horários: </b>Grid onde todos os horários semanais estão disponíveis, cada célula representa um horário e nele está exposto o número de vagas disponíveis.</p>
<p align="justify"><b>(5) Célula de horário: </b>Mostra o número de vagas. Clicando em uma célula, é possível marcar e desmarcar um horário.</br>Para marcar basta clicar em cima, que a pagina será atualizada e a cor da célula mudará e o número de vagas decrementará. Não é possível marcar dois horários em um mesmo dia.</br>Para desmarcar um horário, basta clicar novamente na célula indicada como marcada, após isso a página atualizará e a cor mudará e o número de vagas será incrementado.</p>
 </p></br>




