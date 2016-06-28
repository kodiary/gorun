<div id="showmsg" class="alert-message success"></div>
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
if($videos)
    {
    ?>
    <ul id="sort_videos" class="ui-sortable">
    <?php
    foreach($videos as $data)
    {
    ?>
    <li id="listitem_<?php echo $data->id;?>" >
    <div id="<?php echo $data->id?>" class="border_line drag">
        <div class="text_desc_l" style="margin-top: 5px;">
            <span class="titles"><?php echo $data->title;?></span></span>
        </div>
        
        <div class="text_desc_r">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'htmlOptions'=>array('id'=>'delete_'.$data->id,
            'onClick'=>'$("#show_'.$data->id.'").show();'),
            )); ?>
            <?php
                //crop button
                 echo CHtml::ajaxButton('Edit',
                            $this->createUrl('getVideo'),
                             array
                             ( 
                             //ajax options
                             'data'=>array('id'=>$data->id),
                             'type'=>'POST',
                             'dataType'=>'json',
                             'success'=>"js:function(data){
                                        $('#videoId').val(data.id);
                                        $('#Videos_title').val(data.title);
                                        $('#Videos_code').val(data.code);
                                        }",
                             'complete'=>"js:function(){
                                          $('#edit_".$data->id."').val('Edit');
                                        }",
                            ),
                            array('id'=>'edit_'.$data->id,'style'=>'padding-top:5px;padding-bottom:5px;','class'=>'btn btn-info','onclick'=>'$("#edit_'.$data->id.'").val("loading...");')//html options
                );
                ?>
        </div>
        <div class="clear"></div>
    </div>
    <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
        <div class="fl_left">
            <span class="bold">Warning:</span> This cannot be undone. Are you sure?
        </div>
        <div class="fl_right">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
            'url' => array('delete', 'id'=>$data->id),
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            ));?>
            
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>">Cancel</a> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    </li>  
    <?php
    }
    ?>
    </ul>
    <?php
    }
?>
 <script type="text/javascript">
   $(function(){
    $("#sort_videos").sortable({
       update : function () {
            $('#showmsg').show();
    		var order = $('#sort_videos').sortable('serialize');
           	$("#showmsg").load("<?php echo $this->createUrl('videos/sortvideos');?>",order, function (){
  		       $(this).slideUp(1500);
  		    });
            
          }
        });
   });
</script>