<?php
if(is_array($data))
{
    foreach ($data as $image)
    {
        if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$image['name']))
        {
            $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$image['name'];
        }
        else
        {
            $img_url=Yii::app()->baseUrl.'/images/noimage.jpg';    
        }
     ?>
     <li id="item_<?php echo $image['id'];?>">
     <div class="gallery_wrapping">
     <div class="left">
        <div id="image_<?php echo $image['id'] ?>" class="thumbnail"><img src="<?php echo $img_url;?>"/></div>
     </div>
     <div class="right">
         <div><?php echo CHtml::link('Delete', array('/'.$this->module->getName().'/gallery/delete', 'id'=>$image['id']), array('class'=>'btn btn-danger','onclick'=>'js:return confirm(\'Are you sure you want to delete?\');'));?></div>
         <div>
         <?php
            //crop button
             echo CHtml::ajaxButton('Crop',
                        $this->createUrl('cropPhoto'),
                         array( //ajax options
                         'data'=>array('fileName'=>$image['name'],'id'=>$image['id']),
                         'type'=>'POST',
                        'success'=>"js:function(data){
                                    $('#cropModal').html(data).dialog('open'); return false;
                                    }",
                        'complete'=>"js:function(){
                                      $('#crop_".$image['id']."').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop_'.$image['id'],'class'=>'btn btn-normal','onclick'=>'$("#crop_'.$image['id'].'").val("loading...");')//html options
            );
            ?>
        </div>
         <div>
        <?php
            //crop button
             echo CHtml::ajaxButton('Edit',
                        $this->createUrl('getImagebyId'),
                         array
                         ( 
                         //ajax options
                         'data'=>array('id'=>$image['id']),
                         'type'=>'POST',
                         'dataType'=>'json',
                         'success'=>"js:function(data){
                                    $('#Gallery_0_name').val(data.image_name);
                                    if(data.image_thumb)$('#upimage_0').html('<img src=\"'+data.image_thumb+'\"/>');
                                    else $('#upimage_0').html('');
                                    if(data.caption)$('#Gallery_0_caption').val(data.caption);
                                    else $('#Gallery_0_caption').val('');
                                    $('#Gallery_0_id').val(data.image_id);
                                    }",
                         'complete'=>"js:function(){
                                      $('#edit_".$image['id']."').val('Edit');
                                    }",
                        ),
                        array('id'=>'edit_'.$image['id'],'class'=>'btn btn-info','onclick'=>'$("#edit_'.$image['id'].'").val("loading...");')//html options
            );
            ?>
        </div>
    </div>
    <div class="clear"></div>
    </div>
     </li>
     <?php
    }  
}
?>