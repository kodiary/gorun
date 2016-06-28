<?php
$this->breadcrumbs=array(
	'Tag'
);?>
<aside class="left_body addContentArea">
<div class="line"></div>
<h1>List of Common Tags</h1>
<div class="line"></div>


<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>false,
)); ?>
 <div class="clear"></div>
 <div class="well"><?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>

Topic
<span class="required">*</span>

	<?php echo $form->textField($model,'tag',array('class'=>'span5','maxlength'=>255,'style'=>'margin-left:20px;')); ?>
	<span class="floatRight"><?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'submit',
    'label'=>'Submit',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
     // '', 'large', 'small' or 'mini'
)); ?></span>
<div class="clear"></div>
</div>
<?php $this->endWidget(); ?>


<ul>
 <?php
  $j = 0;
    foreach($records as $val){
    
    $count = Articles::model()->findAll(array('condition'=>"common_tags LIKE '%$val->id%'"));
    
    if($count)
    {
        foreach($count as $c)
        {
            $tag_ids = $c->common_tags;
            $arr = explode(',',$tag_ids);
            $num = count($arr);
            for($i=0; $i<$num; $i++)
            {
                if($arr[$i] == $val->id)
                {
                    $j++;
                }
            } 
        }
        //exit();
    }
    ?>
	<li class="greybg mar-bot-6">
    <aside class="floatLeft margintop5">
    <?php echo $val->tag?></span> <span class="blue"><?php echo "- ".$j.' Tags'; $j = 0;?></span>
    </aside>
    <aside class="floatRight">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$val->id,
                'onClick'=>'$("#show_'.$val->id.'").show();'),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'edit_'.$val->id),
            )); ?>
    </aside>
    
    <div class="clear"></div>
    
    </li>
    
        <div style="display: none;" id="show_<?php echo $val->id?>" class="alert">
                     <div class="floatLeft">
                   		Warning: This cannot be undone. Are you sure?
                    </div>
                    <div class="floatRight">
                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => $this->createUrl('delete', array('id'=>$val->id)),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
                ));?>
                    
                    <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $val->id?>">Cancel</a> 
                    
                    </div>
                    <div class="clear"></div>
                    </div>
               
    <?php }
?>
    
   
</ul>

</aside>


<div class="left_body">
<div class="wide-form">

   
    <div class="clear"></div>


</div>


</div><!--#left_body-->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').click(function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
        
   });
   
   $('.btn-info').click(function(){
    var val = this.id.split('_');
    if(id=val[1])
    {
        $.ajax({
          type: "POST",
          url: '<?php echo $this->createUrl("gettag")?>',
          data: "id="+id
        }).done(function( msg ) {
          $("#Tags_tag").val(msg);
          $("#Tags_id").val(id);
        });
    }
    
   });
});
</script>