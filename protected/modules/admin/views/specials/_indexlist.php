<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = Yii::app()->user->id;
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<h2>Specials/Events - <span>List your company specials - MAX 3 active adverts</span></h2>

<div id="showmsg" class="alert-message success"></div>
<ul id="sort_specials">
<?php foreach($dataProvider as $data){?>
<li id="listitem_<?php echo $data->id;?>" class="<?php if($data->status==0) echo 'in_active';?>">
  
    <div id="<?php echo $data->id?>" class="border_line">
        	<div class="text_desc_l">
            <span class="titles"><?php echo $data->title;?></span> 
            <span class="blues">
            Valid Until <?php echo strtotime($data->expiry_date)? CommonClass::formatDate($data->expiry_date): $data->expiry_date;?>
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
            <?php if(isset($id))
                    $updateUrl=  array('update', 'id'=>$id, 'specId'=>$data->id);
                else
                    $updateUrl='';
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
                    <?php
                    if(isset($_GET['id']))
                        $deleteUrl = array('delete', 'id'=>$id, 'specId'=>$data->id);
                    elseif(isset(Yii::app()->user->id))
                        $deleteUrl = array('delete', 'specId'=>$data->id);
                    else
                        $deleteUrl = '';
                    ?>
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
<div class="color_indicators">
 	<div class="color"></div>
    <div class="ind_text">Indicates inactive items</div>
 </div>

<script type="text/javascript">
/*<![CDATA[*/
$(document).ready(function(){
   $('.cancel_button').live('click', function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
   });
   
    $("#sort_specials").sortable({
       update : function () {
            $('#showmsg').show();
    		var order = $('#sort_specials').sortable('serialize');
           	$("#showmsg").load("<?php echo $this->createUrl('specials/sortspecials');?>",order, function (){
  		       $(this).slideUp(1500);
  		    });
            
          }
        });
        $("#confirmButton").click(function(){
        $("#applyDiv").show();
    });
    
    $("#cancelButton").click(function(){
        $("#applyDiv").hide();
    });   	
});
/*]]>*/
</script>