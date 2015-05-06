<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $modelCurrentUser Usuario */

$situacao;
//if($modelCurrentUser->TIPO == "diretor" || $modelCurrentUser->TIPO == "gestor") $situacao = true;
//if ((strpos(Yii::app()->user->TIPO,"diretor") == false)||(strpos(Yii::app()->user->TIPO,"gestor") == false)) $situacao = true;
//else $situacao = false;


$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    'Create',
);



if(!Yii::app()->user->isGuest){
    $this->menu=array(
    	array('label'=>'Gerenciar Usuarios', 'url'=>array('admin')/*, 'visible'=>$situacao*/),
    	array('label'=>'Gerenciar Períodos', 'url'=>array('')/*, 'visible'=>$situacao*/),
    	array('label'=>'Gerar Relatórios', 'url'=>array('')/*, 'visible'=>$situacao*/),
    	array('label'=>'Ajuda', 'url'=>array('ajuda')),
    	//array('label'=>'Logout', 'url'=>array('site/logout')),
    );
}



?>


<h2>Essa área é dedicata para o diretor do sistema.
    Nessa área, é possível gerenciar usuários (inclusive gestores e diretores),
    gerenciar semestres e gerar relatórios</h2>

<?php
    $GLOBALS['nome'] = "Diretor";
?>
