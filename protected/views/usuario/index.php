<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */
/* @var $modelCurrentUser Usuario */

$situacao;
if($modelCurrentUser->TIPO == "diretor") $situacao = true;
else $situacao = false;

$this->breadcrumbs=array(
    'Usuarios',
);

$this->menu=array(
//    array('label'=>'Listar Usuarios', 'url'=>array('usuario/index'), 'visible'=>$situacao),
//    array('label'=>'Criar novo Usuario', 'url'=>array('create')),
    array('label'=>'Gerenciar Usuarios', 'url'=>array('admin'), 'visible'=>$situacao),
    array('label'=>'Gerenciar Períodos', 'url'=>array(''), 'visible'=>$situacao),
    array('label'=>'Gerar Relatórios', 'url'=>array(''), 'visible'=>$situacao),
    array('label'=>'Ajuda', 'url'=>array('ajuda')),
    //array('label'=>'Logout', 'url'=>array('site/logout')),
);
?>

<?php
    $GLOBALS['nome'] = "Usuários";
?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
));

?>
