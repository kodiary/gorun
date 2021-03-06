<div class="col-md-8">
<h3 class="admin_top_list_headings fl_left">List of <span class="bold">Brands</span></h3>
<div class="sorter fl_right">
Order - <?php echo $sort->link('alphabetic');?> - <?php echo $sort->link('date');?>
</div>
<div class="clear"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php 
$itemsCount = Yii::app()->params['items_pers_page'];
/* auto scrolling on showall*/
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.brand_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more brand.',
    'pages' => $pages,
));?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('/admin/brands/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
        
</div><!--#col-md-8-->

<div class="col-md-4">
	<div class="well">
        <?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
        	'id'=>'brand-form',
        		'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
        )); ?>
            <?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>
        	<?php echo $form->textField($model,'brand_name',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'Add/Edit Brand')); ?>
        
        	<div class="actions">
        		<?php $this->widget('bootstrap.widgets.BootButton', array(
                        'buttonType'=>'submit',
                        'label'=>'Save',
                        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                )); ?>
        	</div>
            <?php echo $form->error($model,'brand_name');?>
            <div class="clear"></div>
        <?php $this->endWidget(); ?>
    </div>
    <div><?php $this->renderPartial('_search');?></div>
    <div> <a class="btn" href="<?php echo $this->createUrl('/admin/brands/retag');?>">+ReTag Brand</a></div>
</div><!--#col-md-4-->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').live('click',function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
   });
   
   $('.btn-info').live('click',function(){
    var val = this.id.split('_');
    if(id=val[1])
    {
        $.ajax({
          type: "POST",
          url: '<?php echo $this->createUrl("getBrand")?>',
          data: "id="+id
        }).done(function( msg ) {
          $("#Brands_brand_name").val(msg);
          $("#Brands_id").val(id);
        });
    }
   });
});
</script>