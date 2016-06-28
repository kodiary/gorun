<li id="remove_video_<?php echo $index?>">
    <?php echo CHtml::activeLabelEx($model, "title");?>
    <?php echo CHtml::activeTextField($model, "[$index]title",array('class'=>'w-428 mar-bot-10'));?>
    <div class="clear"></div>
    <div class="margintopbot10">
        <label>Embed Code</label>
        <?php echo CHtml::activeTextArea($model, "[$index]filename", array('class'=>'w-428'));?>
        <div class="clear"></div>
        <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Remove',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete_video_'.$index,
                        'onClick'=>'$("#remove_video_'.$index.'").remove();'),
        ));?>
    </div>
<div class="line"></div>
</li>