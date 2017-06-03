<div class="association_listing">
        <div id="<?php echo $data->id?>" class="border_line">
        	<div class="text_desc_l">
            <span class="image" style="width:56px; height:50px;">
            	<?php 
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$data->ass_logo) && $data->ass_logo)
                    echo CHtml::image(Yii::app()->baseUrl.'/images/frontend/thumb/'.$data->ass_logo, '', array('height'=>'50px', 'width'=>'56px'));
                else
                    echo CHtml::image(Yii::app()->baseUrl.'/images/noimage.jpg', '', array('height'=>'50px', 'width'=>'56px'))?>
            </span>
            <span class="titles desc_w_img" style="width:360px;">
			<span class="vert_middle" style="height:50px;"><?php echo $data->ass_name?> - <span style="font-size:13px;" class="blue"><?php echo CompanyAssociations::getAssociationById($data->id).' Linked';?></span>
            </span>
            </span>
            </div>
            
            <div class="text_desc_r">
            <span class="vert_middle" style="height:50px;">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$data->id,
                'onClick'=>'$("#show_'.$data->id.'").show();'),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'edit_'.$data->id),
            )); ?>
            </span>
            </div>
			<div class="clear"></div>
         </div>
         <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
                <div class="fl_left">
               	    <span class="bold">Warning:</span> This cannot be undone. Are you sure?
                </div>
                <div class="fl_right">
               <?php $this->widget('bootstrap.widgets.BootButton', array(
                        //'fn'=>'ajaxLink',
                        'url' => $this->createUrl('deleteAssociation', array('id'=>$data->id)),
                        'label'=>'Delete',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'small' or 'large'
                ));?>
                <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>">Cancel</a> 
                <div class="clear"></div>
                </div>
         <div class="clear"></div>
         </div>
</div>