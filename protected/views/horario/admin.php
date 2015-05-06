<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs=array(
    'Horarios'=>array('index'),
    'Manage',
);

$this->menu=array(
//	array('label'=>'List Horario', 'url'=>array('index')),
    array('label'=>'Gerenciar Horário', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#horario-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Gerenciar Horarios</h1>


<?php
    $GLOBALS['nome'] = "Gerenciar Horários";
?>

<p>
Nessa área você pode gerenciar os horários (inserir novos horários, editar, pesquisar e remover horários).
</p>

<?php
echo CHtml::button('Novo Horário',
    array(
        'submit'=>array('horario/create'),
    )
);
?>
<?php
/*
Define o numero de linhas do Grid.
*/
$dataProvider=new CActiveDataProvider('Horario', array(
    'Pagination' => array (
        'PageSize' => 50 //edit your number items per page here
    ),
));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'horario-grid',
    //'dataProvider'=>$model->search(),
    'dataProvider'=>$dataProvider,
    'filter'=>$model,
    'pager'=>array(
        'class'=>'CLinkPager',
        'pageSize' => 100,
        'firstPageLabel'=>'Primeira',
        'lastPageLabel'=>'Última',
        'nextPageLabel'=>'Próxima',
        'prevPageLabel'=>'Anterior',
        'header'=>'',
    ),
    'columns'=>array(
        'ID',
        'ID_ACADEMIA',
        //'DATADIA',
        'DIASEMANA',
        'PERIODO',
        'HORAINICIO',
        'HORAFIM',
        'TOTAL_USO',
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
