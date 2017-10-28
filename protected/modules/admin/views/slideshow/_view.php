<?php
$transitionArray = array(
                        'random'=>'Random Transitions',
                        'boxslide'=>'Box Mask',
                        'boxfade'=>'Box Mask Mosaic',
                        'slotzoom-horizontal'=>'Slot Zoom Horizontal',
                        'slotslide-horizontal'=>'Slot Slide Horizontal',
                        'slotfade-horizontal'=>'Slot Fade Horizontal',
                        'slotzoom-vertical'=>'Slot Zoom Vertical',
                        'slotslide-vertical'=>'Slot Slide Vertical',
                        'slotfade-vertical'=>'Slot Fade Vertical',
                        'curtain-1'=>'Curtain One',
                        'curtain-2'=>'Curtain Two',
                        'curtain-3'=>'Curtain Three',
                        'slideleft'=>'Slide Left',
                        'slideright'=>'Slide Right',
                        'slideup'=>'Slide Up',
                        'slidedown'=>'Slide Down',
                        'fade'=>'Fade',
                        'flyin'=>'Fly In',
                        'cubic'=>'Cubic',
                        'turnoff'=>'Turn Off',
                        '3dcurtain-horizontal'=>'3D Curtain Horizontal',
                        '3dcurtain-vertical'=>'3D Curtain Vertical',
                        'papercut'=>'Paper Cut',
                   );
?>
<?php $index = $modelImages->id;?>
 
<li id="remove_<?php echo $index;?>">

<div class="whitebg">
<div class="marginbot10" style=" margin-bottom: 10px;">
	
  <div class="buttons fl_left sliderBtns">
    <div id="file-uploader_<?php echo $index;?>">
      <div class="qq-uploader">
        <div id="uploadFile_<?php echo $index;?>">
          <div class="qq-uploader" >
            <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
            <div class="qq-upload-button" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
              <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
            </div>
            <ul style="display:none" class="qq-upload-list">
            </ul>
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
                 'data'=>array('fileName'=>'js:$("#Slideshow_'.$index.'_image").val()', 'index'=>$index),
                 'type'=>'POST',
                 'dataType'=>'html',
                 'success'=>"js:function(data){
                            $('#cropModal').html(data).dialog('open'); return false;
                            //$('#cropImg').html(data);
                            }",
                'complete'=>"js:function(){
                            $('#crop').val('Crop');
                            }",
                ),
                array('id'=>'crop'.$index,'class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#Slideshow_'.$index.'_image").val()==""){alert("Please upload the image and try cropping");return false;}else $("#crop'.$index.'").val("loading...");'));?>
  </div>
  <!--buttons-->

  <div class="new-banner">
  <figure class="slideImage" id="image_<?php echo $index;?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/frontend/thumb/'.$modelImages->image);?></figure>
  </div>
  
  <div class="submit_buttons_img fl_right"> <?php echo CHtml::ajaxLink('Remove', array('delete', 'id'=>$index), array('replace'=>'#remove_'.$index), array('class'=>'btn btn-danger', 'confirm'=>'Are you sure you want to delete?','id'=>'link'.uniqid()));?> </div>
  <div class="clear"></div>
  </div>
  
  <div class="margintopbot10 slideLink">
  <?php echo CHtml::activeLabel($modelImages, "[$index]caption", array('class'=>'fl_left sliderLinklabel'));?>
  <?php echo CHtml::activeTextArea($modelImages, "[$index]caption", array('class'=>'span5'));?>
  <div class="linkError"></div>
  <div class="clear"></div>
  </div>
  
  <div class="margintopbot10 slideLink">
  <?php echo CHtml::activeLabel($modelImages, "[$index]sub_caption", array('class'=>'fl_left sliderLinklabel'));?>
  <?php echo CHtml::activeTextArea($modelImages, "[$index]sub_caption", array('class'=>'span5'));?>
  <div class="linkError"></div>
  <div class="clear"></div>
  </div>
  
  <div class="margintopbot10 slideLink">
  <?php echo CHtml::activeLabel($modelImages, "[$index]slide_link", array('class'=>'fl_left sliderLinklabel'));?>
  <?php echo CHtml::activeTextField($modelImages, "[$index]slide_link", array('class'=>'span5'));?>
  <div class="linkError"></div>
  <div class="clear"></div>
  </div>
  
  <?php echo CHtml::activeLabel($modelImages, "[$index]target", array('class'=>'fl_left sliderLinklabel'));?>
  <?php echo CHtml::activeDropDownList($modelImages, "[$index]target", array(0=>'Same Window', 1=>'New Window'));?>
  <!--span class='fl_right sliderclicks'><?php echo Slideshow::countClicks($index);?> Clicks </span-->
  <div class="clear"></div>
  
    <!--new customized slider changes-->
    <!--div class="margintopbot10 image_option">
        <?php echo CHtml::activeLabel($modelImages, "[$index]transition", array('class'=>'fl_left'));?>
        <?php echo CHtml::activeDropDownList($modelImages, "[$index]transition", $transitionArray);?>
        <div class="clear"></div>
    </div>
    
    <div class="margintopbot10 slideLink">
        <?php echo CHtml::activeLabel($modelImages, "[$index]slot_amount", array('class'=>'fl_left sliderLinklabel'));?>
        <?php echo CHtml::activeTextField($modelImages, "[$index]slot_amount", array('class'=>'span1 slot_amount'));?>
        <?php echo CHtml::error($modelImages, "[$index]slot_amount");?>
        <div class="erroSlotAmount"></div>
        <div class="clear"></div>
    </div-->               
    <!--new customized slider changes-->
  
  <div id="cropImg" style="display:none;"></div>
  </div><!--whitebg-->
</li>
