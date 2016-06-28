<?php $companyId = $_GET['id']; ?>
<?php
if($this->action->id=='index'){
    $createUrl = array('create', 'id'=>$companyId); 
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
    $cancelUrl = array('index', 'id'=>$companyId);
    $this->widget('bootstrap.widgets.BootButton', array(
    //'fn'=>'ajaxLink',
    'url' => $cancelUrl,
    'label'=>'Cancel',
    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // '', 'small' or 'large'
));

}
?>