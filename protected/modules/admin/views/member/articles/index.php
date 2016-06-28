<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$companyModel)); ?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>  
<div class="company-bottom"> 
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>News - <span>Post your latest news - <span class="bold">Subject to approval</span></span></h2>
<div class="line"></div>
<ul>            
<?php
    $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'_view',
        'summaryText'=>'',
    ));    
?>
</ul>
</div>
</div>

<div class="right_body">
     <?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>