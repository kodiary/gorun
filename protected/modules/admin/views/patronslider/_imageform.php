<li id="remove_<?php echo $index;?>">
  <div class="whitebg patron">

                <div class="buttons_for_img buttons floatLeft sliderBtns" >
     			<div id="file-uploader_<?php echo $index;?>">
     <div class="qq-uploader">
    
        <div id="uploadFile_<?php echo $index;?>">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="qq-upload-button" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
                    <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                </div>
                <ul style="display:none" class="qq-upload-list"></ul>
            </div>
        </div>    
    
    </div>
    </div>
     <?php echo CHtml::activeHiddenField($modelImages, "[$index]image");?>
     <?php
    //crop button
     echo CHtml::ajaxButton('Crop',
                $this->createUrl('cropImg'),
                 array( //ajax options
                 'data'=>array('fileName'=>'js:$("#PatronSlider_'.$index.'_image").val()', 'index'=>$index),
                 'type'=>'POST',
                 'dataType'=>'html',
                 'success'=>"js:function(data){
                            $('#cropModal').html(data).dialog('open'); return false;
                            }",
                'complete'=>"js:function(){
                            $('#crop').val('Crop');
                            }",
                ),
                array('id'=>'crop'.$index,'class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#PatronSlider_'.$index.'_image").val()==""){alert("Please upload the image and try cropping");return false;}else $("#crop'.$index.'").val("loading...");'));?>
     
    	</div>
        
    	<div class="image_place_holders floatLeft" >
        	<div class="" id="image_<?php echo $index?>"></div>
        </div>
        <div class="click-links">
        <span class="floatRight sliderclicks">0 Clicks</span>
        </div>
       
        <div class="submit_buttons_img remove floatRight">
         	 <?php echo CHtml::ajaxLink('Remove', array('delete', 'id'=>$modelImages->id), array('replace'=>'#remove_'.$index), array('class'=>'btn btn-danger', 'id'=>'link'.uniqid()));?>
             <div class="clear"></div>
        </div>
         <div class="clear"></div>
        <div class="margintopbot10 slideLink">
        <?php echo CHtml::activeLabel($modelImages, "[$index]slide_link", array('class'=>'floatLeft sliderLinklabel'));?>
        <?php echo CHtml::activeTextField($modelImages, "[$index]slide_link", array('class'=>'links'));?>
         <div class="clear"></div>
        <div class="linkError"></div>
        </div>
        
        <div class="image_option">
        <?php echo CHtml::activeLabel($modelImages, "[$index]target", array('class'=>'floatLeft sliderLinklabel'));?>
        <?php echo CHtml::activeDropDownList($modelImages, "[$index]target", array(0=>'Same Window', 1=>'New Window'));?>
        <div class="clear"></div>
        </div>
         
         
         
         <div class="clear"></div>
	
    <div id="cropImg" style="display:none;"></div>

</div>

</li>
