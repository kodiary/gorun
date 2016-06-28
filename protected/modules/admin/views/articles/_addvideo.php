<li id="remove_<?php echo $index?>">
    <?php echo CHtml::activeLabelEx($model, "title");?>
    <?php echo CHtml::activeTextField($model, "[$index]title", array('class'=>'span5', 'style'=>'margin-bottom:10px'));?>
    <div class="clear"></div>
    <div class="margintopbot10">
        <label>Embed Code</label>
        <?php echo CHtml::activeTextArea($model, "[$index]filename", array('rows'=>4, 'cols'=>60, 'class'=>'inputwidth'));?>
        <div class="clear"></div>
       
        <?php 
            if($model->isNewRecord)
            {
                $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Remove',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete_'.$index,
                        'onClick'=>'$("#remove_'.$index.'").remove();',
                        'style'=>'float:right; margin-bottom:10px;'),
                ));
            }
            else
            {
              ?>
              <?php echo CHtml::ajaxLink('Remove', array('deleteVideo', 'id'=>$model->id), array('replace'=>'#remove_'.$index), array('class'=>'btn btn-danger'));?>
              <?php  
            }
        ?>
        <div class="clear"></div>
    </div>
</li>