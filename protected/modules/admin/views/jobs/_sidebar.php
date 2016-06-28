
<?php if(Yii::app()->controller->action->id=='index')
{?>
<div class="mar-bot-10">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => $this->createUrl('create'),
                    'label'=>'+Add Job',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>

<?php $this->renderPartial('_search');?>

<div class="well">
<h3>JOBS BY COMPANY</h3>
<ul>
    <?php
         foreach(Jobs::countJobsOfCompany() as $val){
            $count = Jobs::model()->countJobsByCompany($val->id);
                if(($count) !=0){ ?>
                    <li>
                        <?php echo CHtml::link($val->name, $this->createUrl('/admin/jobs/index/companyId/'.$val->id));?>
                        <span class="blue">(<?php echo $count;?>)</span>
                    </li>
            <?php }
         }
    ?>                    
</ul>
</div>
<div class="color_indicators">
 	<div class="color"></div>
    <div class="ind_text">Inactive</div>
</div>
<?php }else{ ?>
<div class="right_btns">
   <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => $this->createUrl('index'),
                    'label'=>'Cancel',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));
   ?> 
</div>
<?php }?>
