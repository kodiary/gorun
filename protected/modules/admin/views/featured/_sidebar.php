<div class="right_bar_blocks">
<!-- start right side bar-->
<div class="right_btns">

<?php 
    if(isset($_GET['id'])){
        $companyId = $_GET['id'];
        $createUrl =  array('create', 'id'=>$companyId);
    }
    else{
        $createUrl =  array('create');
    }
?>
        
<?php $this->widget('bootstrap.widgets.BootButton', array(
                    'url' => $createUrl,
                    'label'=>'+Add Item',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
));?>

</div>
</div>
<!-- end right side bar-->
