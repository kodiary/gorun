<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'menu_popup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        //'title'=>'Menu',
        'autoOpen'=>false,
        'draggable'=>true,
        'resizable'=>false,
        'height'=>'auto',
        'width'=>'auto',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
            $('#menu_popup').empty();
        }",
    ),
));?>
<div id="update_data"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>