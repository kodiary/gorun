<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$companyId = $_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>Resources - <span class="blue">Exhibition Documents</span></h2>
<div class="line"></div>

    <?php
        if($resourcesModel)
        {
            foreach($resourcesModel as $resModel)
            {
                $this->renderPartial('_docview',array('data'=>$resModel));
            }
        }
    ?>
</div>
</div>
<div class="right_body">
   <?php $this->widget('bootstrap.widgets.BootButton', array(
                    'url' => array('index', 'id'=>$companyId),
                    'label'=>'Back',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));
   ?> 
</div>
<div class="clear"></div>
</div>

<!-- poop up modal for document  -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'docPopup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'autoOpen'=>false,
        'resizable'=>false,
        'height'=>'auto',
        'width'=>'auto',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
$('#docPopup').empty();
}")));?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>