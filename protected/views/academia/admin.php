<?php
/* @var $this AcademiaController */
/* @var $model Academia */

$this->breadcrumbs=array(
    'Academias'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/back.png" width="50px" height="50px" alt="Voltar" title="Voltar"/>', 'url'=>array('manage')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/list.png" width="50px" height="50px" alt="Listar Academia" title="Listar Perfis da Academia"/>', 'url'=>array('index')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/add.png" width="50px" height="50px" alt="Criar Perfil" title="Criar Novo Perfil"/>', 'url'=>array('create')),
    array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/help.png" width="50px" height="50px" alt="Ajuda" title="Ajuda"/>', 'url'=>array('ajuda')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#academia-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<!--<h1>Manage Academias</h1>-->


<?php
    $GLOBALS['nome'] = "Gerenciar Academia";
?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
    //'model'=>$model,
//));
    ?>
</div>
<!-- search-form -->


<?php echo CHtml::ajaxLink("Show Selected",
                           $this->createUrl('/academia/DoChacked'),
                           array("type" => "post",
                                 "data" => "js:{chk:$.fn.yiiGridView.getSelection('gridcust')}",
                                 "update" => "#output")); ?>

<div id="output"></div>


<?php echo CHtml::beginForm()?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'academia-grid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'columns'=>array(
        'CODIGO_CONFIG',
        'CAPACIDADE',
        'HORA_ABERTURA',
        'HORA_FECHAMENTO',
        'TIPOFUNCIONAMENTO',
    	'DURACAO_PERIODO',
    	'DATA_INICIO',
    	'DATA_FIM',
        'SITUACAO',
        array(
            'class'=>'CButtonColumn',
        ),
        array(
            'id'=>'selectedRow',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '1',
        ),

    ),
));

?>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Salvar':''); ?>
<?php echo CHtml::endForm();?>
