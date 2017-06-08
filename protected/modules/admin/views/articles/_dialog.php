<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cropModal',
    'options'=>array(
        'width'=>'auto',
        'height'=>'auto',
        'autoOpen'=>false,
        'resizable'=>false,
        'modal'=>true,
        'overlay'=>array(
            'backgroundColor'=>'#fff',
            'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
            $('#cropModal').empty();
        }",
    ),
));
//modal dialog content here
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>