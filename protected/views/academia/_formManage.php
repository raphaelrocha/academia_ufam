<?php
/* @var $this AcademiaController */
/* @var $model Academia */
/* @var $form CActiveForm */
/* @var $dataProvider Academia*/
?>

<?php echo CHtml::beginForm(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'selectableRows' => 1,
	'columns' => array(
		array(
			'id' => 'selectedIds',
			'class' => 'CCheckBoxColumn',
			'checked'=>'$data->SITUACAO=="ativo"'
		),
		array(
			'name' => 'Período',
			'value' => '$data->PERIODO'
		),
		/*array(
			'name' => 'Situação',
			'value' => '$data->SITUACAO'
		),*/
		/*array(
			'name' => 'Código',
			'value' => '$data->CODIGO_CONFIG'
		),*/
		array(
			'name' => 'Vagas',
			'value' => '$data->CAPACIDADE'
		),
		array(
			'name' => 'Cota',
			'value' => '$data->COTA'
		),
		array(
			'name' => 'Abertura',
			'value' => '$data->HORA_ABERTURA'
		),
		array(
			'name' => 'Fechamento',
			'value' => '$data->HORA_FECHAMENTO'
		),
		array(
			'name' => 'Modo',
			'value' => '$data->TIPOFUNCIONAMENTO'
		),
		array(
				'name' => 'Intervalo',
				'value' => '$data->DURACAO_PERIODO'
		),
		array(
				'name' => 'Início',
				'value' => '$data->DATA_INICIO'
		),
		array(
				'name' => 'Término',
				'value' => '$data->DATA_FIM'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
<div>												<!-- Nome que o controlador usa para identificar o botÃ£o clicado -->
	<?php echo CHtml::submitButton('Confirmar', array('name' => 'confirmar','confirm' => 'ALERTA! '."\n".'[1] Ao mudar o perfil ativo todos os horários marcados pelos usuários ficarão indisponíveis, sendo necessária uma nova marcação para o novo perfil. '."\n".'[2] Caso o perfil antigo seja selecionado, as agendas serão disponibilizadas novamente. '."\n".'[3] Deseja realmente continuar?')); ?>
	<?php echo CHtml::submitButton('Cancelar', array('name' => 'cancelar'));
	?>
</div>

<?php echo CHtml::endForm(); ?>
