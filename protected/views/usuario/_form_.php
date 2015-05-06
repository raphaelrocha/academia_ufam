<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
/* @var $modelCurrentUserTipo Usuario */

    //verifica quem eh o dono do form
    if ($dono == 'create'){
        $varItemDisabled=false;
    }else{
        $varItemDisabled=true;
    }
?>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'usuario-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    //'enableAjaxValidation'=>false,
                      'enableAjaxValidation'=>true,
                      //'enableClientValidation'=>true,
                      'focus'=>array($model,'MATRICULA',
                                    ))); ?>

    <p class="note">Campos com <span class="required">*</span> são necessários.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row" style="display: inline">
        <?php echo $form->labelEx($model,'MATRICULA'); ?>
        <?php
         $form->widget('CMaskedTextField', array(
            'model' => $model,
            'attribute' => 'MATRICULA',
            'mask' => '999.999.999-99',
             'htmlOptions' => array('size' == 11, 'disabled'=>$varItemDisabled)
        ));
        ?>
        <?php echo $form->error($model,'MATRICULA'); ?>
    </div>

    <div class="row" style="display: inline">
        <?php echo $form->labelEx($model,'EMAIL'); ?>
        <?php echo $form->textField($model,'EMAIL',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'EMAIL'); ?>
    </div>

    <div class="row" style="display: inline">
        <?php echo $form->labelEx($model,'NOME'); ?>
        <?php echo $form->textField($model,'NOME',array('size'=>50,'maxlength'=>50, 'disabled'=>$varItemDisabled)); ?>
        <?php echo $form->error($model,'NOME'); ?>
    </div>

     <div class="row">
        <?php echo $form->labelEx($model,'SOBRENOME'); ?>
        <?php echo $form->textField($model,'SOBRENOME',array('size'=>50,'maxlength'=>50, 'disabled'=>$varItemDisabled)); ?>
        <?php echo $form->error($model,'SOBRENOME'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATANASC'); ?>
        <?php echo $form->dateField($model,'DATANASC', array('disabled'=>$varItemDisabled)); ?>
        <?php echo $form->error($model,'DATANASC'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'SEXO'); ?>
        <?php echo $form->radioButtonList($model,'SEXO',
                                    array('masculino'=>'Masculino',
                                          'feminino'=>'Feminino'),
                                    array(
                                        'labelOptions'=>array('style'=>'display:inline'),
                                        'separator'=>'  ',
                                    )  ); ?>
        <?php echo $form->error($model,'SEXO'); ?>
    </div>

    <!---------------- CODIGO ORIGINAL ---------------->
    <script language="javascript" type="text/javascript">

        /*function Hab() {
            if (document.getElementById("Travar").checked==false) {
                document.getElementById("Campo").disabled=true;
                document.getElementById("labelCurso").style.display='block';
            } else {
                document.getElementById("Campo").disabled=false;
                document.getElementById("labelCurso").style.display='none';
                document.getElementById("Campo").focus();
            }
        }*/
    </script>

    <?php //echo $form->labelEx($model,'ALUNO_FORM', array('id'=>'labelCurso')); ?>
    <?php //echo $form->checkBox($model,'ALUNO', array('value'=>'sim','uncheckValue'=>'nao','id'=>'Travar','onClick'=>'Hab()')); ?>
    <?php //echo $form->dropDownList($model,'CURSO',$cursosArray, array('id'=>'Campo',"disabled"=>"desabled")); ?>
    <?php //echo "<script> Hab()</script>"; ?>

    <!--------------- FIM CODIGO ORIGINAL -------------->
    <!--
    <div class="row">
        <br/>
        <?php echo CHtml::label('Funcionário da UFAM?.', '',array('id'=>'labelFuncionario')); ?>
        <?php echo $form->radioButtonList($model,'FUNCIONARIO',
                                          array('sim'=>'Sim',
                                                'nao'=>'Não'),
                                          array(
                                              'labelOptions'=>array('style'=>'display:inline'), // add this code
                                              'separator'=>'  ',
                                          )  ); ?>
        <?php echo $form->error($model,'FUNCIONARIO'); ?>
    </div>
    -->
    <!---------------- SUGESTAO -------------->

    <script language="javascript" type="text/javascript">

        function Hab() {
            if (document.getElementById("Usuario_ALUNO_0").checked==true) {
                document.getElementById("Campo").disabled=false;
                //aparece com o dropdown
                document.getElementById("Campo").style.display='block';
                document.getElementById("labelCurso1").style.display='block';
            }
            else if (document.getElementById("Usuario_ALUNO_1").checked==true) {
                document.getElementById("Campo").disabled=true;
                //some com o dropdown
                document.getElementById("Campo").style.display='none';
                document.getElementById("labelCurso1").style.display='none';

                document.getElementById("Campo").focus();
            }
            else if (document.getElementById("Usuario_ALUNO_2").checked==true) {
                document.getElementById("Campo").disabled=false;
                //aparece com o dropdown
                document.getElementById("Campo").style.display='block';
                document.getElementById("labelCurso1").style.display='block';

                document.getElementById("Campo").focus();
            }
            else{
                //document.getElementById("Usuario_ALUNO_1").checked=true;
                document.getElementById("Campo").disabled=true;
                //some com o dropdown
                document.getElementById("Campo").style.display='none';
                document.getElementById("labelCurso1").style.display='none';
            }
        }
    </script>
    <div class="row">
        <br/>
        <?php echo CHtml::label('Qual relação com a UFAM?', '',array('id'=>'labelCurso')); ?>
        <?php echo $form->radioButtonList($model,'ALUNO',
                                    array('sim'=>'Aluno',
                                          'nao'=>'Colaborador',
                                          'abs'=>'Aluno e colaborador'),/*ambos*/
                                    array(
                                        'id' => 'aluno',
                                        'onClick'=>'Hab()',
                                        'labelOptions'=>array('style'=>'display:inline'),
                                        'separator'=>'  ',
                                    )  ); ?>
        <?php echo $form->error($model,'ALUNO'); ?>
        <?php //echo $form->labelEx($model,'ALUNO_FORM', array('id'=>'labelCurso')); ?>
        <?php //echo $form->checkBox($model,'ALUNO', array('value'=>'sim','uncheckValue'=>'nao','id'=>'Travar','onClick'=>'Hab()')); ?>

    </div>
    <div class="row">
        <?php echo CHtml::label('Selecione um curso.', '',array('id'=>'labelCurso1')); ?>
        <?php echo $form->dropDownList($model,'CURSO',$cursosArray, array('id'=>'Campo',"disabled"=>"disabled", 'empty' => '--- Escolha um curso ---')); ?>

        <?php echo "<script> Hab()</script>"; ?>
    </div>

    <!---------------- FIM SUGESTAO -------------->


    <!-- Se logado exibe campo tipo, senao preenche com valor padrao "usuario" e oculta o campo.-->
    <div class="row">
        <br/>
    <?php if(!Yii::app()->user->isGuest): ?>
        <?php if (strpos($modelCurrentUserTipo,"diretor")!==false):?>
            <?php echo $form->labelEx($model,'TIPO'); ?>
            <?php echo $form->radioButtonList($model,'TIPO',
                                              array('usuario'=>'Usuario',
                                                    'gestor'=>'Gestor',
                                                    'diretor'=>'Diretor',
                                                    'usuario;gestor'=>'Gestor e Usuário',
                                                    'usuario;diretor'=>'Diretor e Usuário'),
                                              array(
                                                  'labelOptions'=>array('style'=>'display:inline'), // add this code
                                                  'separator'=>'  ',
                                              )  ); ?>
            <?php echo $form->error($model,'TIPO'); ?>
        <?php elseif(strpos($modelCurrentUserTipo,"gestor")!==false):?>
            <?php if(strpos($model->TIPO,"diretor")===false):?>
                <?php echo $form->labelEx($model,'TIPO'); ?>
                <?php echo $form->radioButtonList($model,'TIPO',
                                                  array('usuario'=>'Usuario',
                                                        'gestor'=>'Gestor',
                                                        'usuario;gestor'=>'Gestor e Usuário',),

                                                  array(
                                                      'labelOptions'=>array('style'=>'display:inline'), // add this code
                                                      'separator'=>'  ',
                                                  )  ); ?>
                <?php echo $form->error($model,'TIPO'); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php $form->labelEx($model,'TIPO'); ?>
        <?php $model->TIPO = "usuario"; echo $form->hiddenField($model,'TIPO',array('size'=>10,'maxlength'=>10)); ?>
        <?php $form->error($model,'TIPO'); ?>
    <?php endif; ?>
    </div>

    <div class="row">
        <?php if((strpos($modelCurrentUserTipo,$model->TIPO)!==false) or ($model->TIPO != "diretor")) :?>
            <?php echo $form->labelEx($model,'SENHA'); ?>
            <?php echo $form->passwordField($model,'SENHA',array('size'=>20,'maxlength'=>20,'autocomplete'=>'off', 'disabled'=>$varItemDisabled)); ?>
            <?php echo $form->error($model,'SENHA'); ?>
        <?php elseif((strpos($modelCurrentUserTipo,$model->TIPO)!==false) and ($model->TIPO == "gestor") and ($model->TIPO != "diretor")) :?>
            <?php echo $form->labelEx($model,'SENHA'); ?>
            <?php echo $form->passwordField($model,'SENHA',array('size'=>20,'maxlength'=>20,'autocomplete'=>'off', 'disabled'=>$varItemDisabled)); ?>
            <?php echo $form->error($model,'SENHA'); ?>
        <?php else: ?>
            <?php //echo $form->labelEx($model,'SENHA'); ?>
            <?php echo $form->hiddenField($model,'SENHA',array('size'=>20,'maxlength'=>20,'autocomplete'=>'off', 'disabled'=>$varItemDisabled)); ?>
            <?php echo $form->error($model,'SENHA'); ?>
        <?php endif; ?>
    </div>
</br>

    <div class="row buttons" align="center">
       <input type="image" name="confirmar" src="images/accept.png" value="Submit" height="70" width="70" alt="Confirmar"></input>
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="index.php?r=usuario/admin"><image src="images/cancel.png" height="78" width="73" alt="Cancelar"/></a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

