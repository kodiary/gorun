<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<div id="msg"></div>
<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company));?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">

<?php
$this->breadcrumbs=array(
	'Brochures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>
<h2>Brochures - <span class="blue">Create or Edit Brochures here.</span></h2>
<div class="line"></div>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
</div>
<div class="right_body" style="margin-top: 45px;">
<?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
     $('.cancel_button').live('click', function(){
        var val = this.id.split('_');
        if(id = val[1])
        {
            $("#show_"+id).hide(); 
        }
    });

    $("a.close").live('click', function(){
        $("div.alert").hide('slow');
    });
    
  });
</script>
