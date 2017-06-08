<?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = Yii::app()->user->id;
?>

<div id="msg"></div>
<div class="restaurant_menus_wrapper">
<?php
$this->breadcrumbs=array(
	'Brochures',
);

    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<h2>Brochures - <span>Add one or more brochures or product sheets here - drag to order list</span></h2>
<div class="line"></div>
<div id="showmsg" class="alert-message success"></div>
<?php
    if($this->module->getName()=='company' && empty($dataProvider))
    { ?>
        <div class="green-border">
            <div class="fl_left">
                <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
            </div>
            <div class="fl_right">
                <div class="blue"><strong>Share your brochure with the world</strong></div>
                <div>Add one or more brochures or product sheets here.</div>
            </div>
            <div class="clear"></div>
        </div>
    <?php }
?>
<ul id="sort_brochures">
<?php foreach($dataProvider as $data){?>
<li id="listitem_<?php echo $data->id;?>">
  
    <div id="<?php echo $data->id?>" class="border_line drag">
        	<div class="text_desc_l" style="margin-top: 5px;">
            <span class="titles"><?php echo $data->title;?></span> -
            <span class="blues">
            <?php 
                $folder=Yii::app()->basePath.'/../documents/'.$data->filename;
                if(file_exists($folder) && $data->filename)
                echo $filesize = CommonClass::format_file_size(filesize($folder));
            ?>
            </span>
            </div>
            
            <div class="text_desc_r">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$data->id,
                'onClick'=>'$("#show_'.$data->id.'").show();'),
            )); ?>
            
            <?php 
                if(isset($id))
                    $updateUrl = array('update', 'id'=>$id, 'bId'=>$data->id);
                else
                    $updateUrl = '';
            ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => $updateUrl,
                //'htmlOptions'=>array('id'=>'update_'.$data->id),
            )); ?>
            </div>
			<div class="clear"></div>
         </div>
        <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
                     <div class="fl_left">
                   		<span class="bold">Warning:</span> This cannot be undone. Are you sure?
                    </div>
                    <div class="fl_right">
                    <?php if(isset($_GET['id']))
                        $deleteUrl= array('delete', 'id'=>$id, 'bId'=>$data->id);
                    elseif(isset(Yii::app()->user->id))
                        $deleteUrl = array('delete', 'bId'=>$data->id);
                    else
                        $deleteUrl= '';?>
                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => $deleteUrl,
                    'label'=>'Delete',
                    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
                    
                    <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>">Cancel</a> 
                    <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
        </div>
	
</li>
<?php }?>
</ul>

<div class="clear"></div>
</div>
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
   <script type="text/javascript">
   $(function(){
    $("#sort_brochures").sortable({
       update : function () {
            $('#showmsg').show();
    		var order = $('#sort_brochures').sortable('serialize');
           	$("#showmsg").load("<?php echo $this->createUrl('brochures/sortbrochures');?>",order, function (){
  		       $(this).slideUp(1500);
  		    });
            
          }
        });
        $("#confirmButton").click(function(){
        $("#applyDiv").show();
    });
    $("#cancelButton").click(function(){
        $("#applyDiv").hide();
    })
   });

   </script>