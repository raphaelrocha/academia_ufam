<?php
/* @var $this AcademiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Academias',
);

$this->menu=array(
   array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('manage')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/add.png" width="50px" height="50px" alt="Criar Perfil" title="Criar Novo Perfil"/>', 'url'=>array('create')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/config.png" width="50px" height="50px" alt="Gerenciar Academia" title="Gerenciar Perfis"/>', 'url'=>array('admin')),
);
?>

<!--<h1>Academias</h1>-->


<?php
    $GLOBALS['nome'] = "Academias";
?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>


<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'my-grid_c0',
    'dataProvider'=>$dataProvider,
    'columns'=>array(

        array(
            'name'=>'Cod',
            'value'=>'$data->CODIGO_CONFIG'
        ),
        array(
            'name'=>'Capacidade',
            'value'=>'$data->CAPACIDADE'
        ),
        array(
            'name'=>'Abertura',
            'value'=>'$data->HORA_ABERTURA'
        ),
        array(
            'name'=>'Fechamento',
            'value'=>'$data->HORA_FECHAMENTO'
        ),
        array(
            'name'=>'Período',
            'value'=>'$data->TIPOFUNCIONAMENTO'
        ),
        array(
            'name'=>'Status',
            'value'=>'$data->SITUACAO'
        ),
        array(
            'id'=>'autoId',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '5',
            ),
    ),
));


?>
