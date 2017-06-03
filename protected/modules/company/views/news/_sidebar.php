<?php
if($this->action->id=='index'){
    $createUrl =  array('create'); 
    $this->widget('bootstrap.widgets.BootButton', array(
        //'fn'=>'ajaxLink',
        'url' => $createUrl,
        'label'=>'+Add News',
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'small' or 'large'
    ));
?>
<div class="color_indicators">
    <div class="color"></div>
    <div class="ind_text">Indicates inactive items</div>
</div>
<?php       
}else{
    $cancelUrl =  array('/company/news'); 
    $this->widget('bootstrap.widgets.BootButton', array(
    //'fn'=>'ajaxLink',
    'url' => $cancelUrl,
    'label'=>'Cancel',
    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // '', 'small' or 'large'
));

}
?>