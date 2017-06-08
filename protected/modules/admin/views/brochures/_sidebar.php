<?php 
    if(isset($_GET['id'])){
        $companyId = $_GET['id'];
        $createUrl = array('create', 'id'=>$companyId);
        $cancelUrl = array('index', 'id'=>$companyId);
    }
    else{
        $createUrl = array('create');
        $cancelUrl = array('index');
    }
?>
        
<?php
if(Yii::app()->controller->action->id=='index'){
    $this->widget('bootstrap.widgets.BootButton', array(
            'url' => $createUrl,
            'label'=>'+Add Brochure',
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
    ));    
}else{
    $this->widget('bootstrap.widgets.BootButton', array(
            'url' => $cancelUrl,
            'label'=>'Back',
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
    ));   
}
?>
