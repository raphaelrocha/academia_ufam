<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>


    <div id="toolbar" class="span-19">

        <div id="titulo" class="span-8">
            <h1>
                <?php
                    echo $GLOBALS['nome'];
                ?>
            </h1>
        </div>

        <div class="span-10">
            <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items'=>$this->menu,
                    'encodeLabel'=>false,
                ));
            ?>
        </div>

    </div><!-- sidebar -->







<div id="content" class="span-18">
    <?php echo $content; ?>
</div><!-- content -->


<?php $this->endContent(); ?>
