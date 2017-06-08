<aside class="col-md-8">
<div class="line"></div>
<h1>Advertising Banners - <span class="blue">Add or Edit Banners Here</span></h1>
<div class="line"></div>


<div class="bannerlist" style="margin:10px 0;">
<?php if($dataProvider->totalItemCount>0):?>
    <?php echo CHtml::link('Active banners', array('index'), array('class'=>($this->action->id=='index')?'active':''));?> &nbsp;&nbsp;
    <?php echo CHtml::link('Inactive banners', array('inactive'), array('class'=>($this->action->id=='inactive')?'active':'')); ?>
<?php  endif;?>
</div>


<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',
)); ?>

<?php if($dataProvider->totalItemCount>10){?>
<div>
<?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('showall'),
)); ?>
</div>
<?php }?>
</aside>

<aside class="col-md-4">
<div class="right_btns">
<?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'+Add New Banner',
                'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('create'),
)); ?>
</div>
</aside>

<div class="clear"></div>


<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').live('click', function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide();
    }

   });
});
   </script>