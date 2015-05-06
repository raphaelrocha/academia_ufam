<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */

$this->breadcrumbs=array(
    'Arquivos'=>array('index'),
    $model->ID=>array('view','id'=>$model->ID),
    'Update',
);

$GLOBALS['nome'] = "Gerenciador de arquivos.";

$this->menu=array(
    array('label'=>'List Arquivo', 'url'=>array('index')),
    array('label'=>'Create Arquivo', 'url'=>array('create')),
    array('label'=>'View Arquivo', 'url'=>array('view', 'id'=>$model->ID)),
    array('label'=>'Manage Arquivo', 'url'=>array('admin')),
);
?>

<h1>Update Arquivo <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
