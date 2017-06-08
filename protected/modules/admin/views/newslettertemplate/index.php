<?php
$this->breadcrumbs=array(
	'Newsletters Templates',
);
?>
<aside class="col-md-8 floatLeft">
    <div class="line"></div>
<h1>Newsletters Templates - <span class="blue">Add or Edit Templates Here</span></h1>
<div class="line"></div>
<div class="seperator"></div>


  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php
    foreach($model as $gettemplate)
    {
    ?>
    <div class="greybg mar-bot-6">    
    <div class="text_desc_l"><?php echo CHtml::encode($gettemplate->title); ?></div>
    <div class="text_desc_r">
    <?php
    if($gettemplate->id!=1){
        $del_url = Yii::app()->createUrl('/admin/newslettertemplate/delete/id/'.$gettemplate->id);
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'delete',
			'type'=>'danger',
            'size' =>'normal',
            //'url' => $del_url,
			'label'=>'Delete',
            'htmlOptions'=>array('id'=>'delete_'.$gettemplate->id,
            'onClick'=>'$("#show_'.$gettemplate->id.'").show(400);'),
		));
    }
    ?>
	<?php echo CHtml::link('Edit',array('/admin/newslettertemplate/update/id/'.$gettemplate->id),array('class'=>'btn btn-info'))?>
	</div>
    <div class="clear"></div>
    </div>

<div class="clear"></div>    
    
    <div style="display: none;" id="show_<?php echo $gettemplate->id?>" class="alert">
    <div class="floatLeft margintop5">
        Warning: This cannot be undone. Are you sure?
    </div>
    <div class="floatRight">
        <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'danger',
            'size' =>'normal',
            'url' => $del_url,
			'label'=>'Delete',
        ));?>
        <?php
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
			'type'=>'normal',
            'size' =>'normal',
			'label'=>'Cancel',
            'htmlOptions'=>array('id'=>'delete_'.$gettemplate->id,            
            'onClick'=>'$("#show_'.$gettemplate->id.'").hide(400);'),            
		));?>
    </div>
    <div class="clear"></div>
    </div>    
    <?php } ?>

</aside>

<aside class="col-md-4 floatRight">
	<a href="<?php echo $this->createUrl('/admin/newslettertemplate/create')?>" class="btn">+Add Template</a>
</aside>

<div class="clear"></div>