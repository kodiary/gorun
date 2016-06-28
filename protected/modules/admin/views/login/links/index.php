<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<!--<h3 class="admin_top_list_headings">Province based link - <span class="bold">Drag and drop to order in province view</span></h3>-->
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div id="showmsg"></div>

 <div class="restro_fr_blocks">
<div class="lefts">	

 <div class="h_button">
	<a href="<?php echo $this->createUrl('index');?>" class="btn"><i class="icon-home"></i></a>
</div>
<?php 
$default= array('label'=>'Home Page', 'url'=>array('index'));
if($linkId)
    $default= array('label'=>Links::getProvinceName(Links::getProvinceIdOfLink($linkId)), 'url'=>array('/admin/links/index/linkid/'.$linkId));
    
$provinces = Links::getAllProvinceFromLinks();
if(!empty($provinces)){
foreach($provinces as $key=>$val){
    $array[]=array('label'=>$val,'url'=>array('/admin/links/index/linkid/'.$key)); 
}}else $array[] = '';
?>
<div class="blue_selects">
        <div class="btn-toolbar" style="margin:0;">
        <?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
            'type'=>'primary', 
            'buttons'=>array(
                $default,
                array('items'=>$array),
            ),
            ));?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="right"></div>
<div class="clear"></div>
</div>

<div class="left_body">
    <?php
    if(isset($_GET['province']))
    {
    ?>
    <ul id="sortable">
    <?php $this->renderPartial('_viewByProvince',array('links'=>$data));?>
    </ul>
    <?php
    }
    else
    {
    ?>
    <?php $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'_view',
        'summaryText'=>'',
    )); ?>
    <?php
    }
    ?>
    <?php if($linkId>1 && isset($_GET['showall']))
        echo CHtml::link('Show All', $this->createUrl('links/index/showall'), array('class'=>'btn btn-info'));?>

</div>
<div class="right_body">
<?php echo CHtml::link('+ Add Link',array('create'),array('class'=>'btn')); ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#sortable").sortable({
      update : function () {
		  var order = $('#sortable').sortable('serialize');
  		 $("#showmsg").load("<?php echo $this->createUrl('sortLinks');?>",order); 
      }
    });
});
</script>