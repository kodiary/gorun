<?php $this->renderPartial('_dialog'); ?>
<?php $this->renderPartial('_addimage');?>
<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
  <?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h1>Photos - <span class="blue">Include photos with your article - (Optional)</span></h1>
  </div>
  <!--subTitle-->

  <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articlePhoto-form',
));?>
  <div class="addContentArea addPhoto">
    <ul>
      <?php if($images){
            foreach($images as $key=>$image){
                $index = 'no_'.$image->id;
      ?>
      <li id="remove_<?php echo $index?>" >

          	 <figure class="floatLeft thumbnail" id="image_<?php echo $index;?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/frontend/thumb/'.$image->filename);?></figure><!--thumbnail-->
          <aside class="buttons floatLeft">
            <div id="file-uploader_<?php echo $index;?>">
              <div class="qq-uploader">
                <div id="uploadFile_<?php echo $index;?>">
                  <div class="qq-uploader" >
                    <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                    <div class="qq-upload-button btn btn-info" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
                      <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;" class="btn"/>
                    </div>
                    <ul style="display:none" class="qq-upload-list">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <?php
    //crop button
     echo CHtml::ajaxButton('Crop',
                $this->createUrl('cropImg'),
                 array( //ajax options
                 'data'=>array('fileName'=>'js:$("#ArticleFile_'.$index.'_filename").val()', 'index'=>$index),
                 'type'=>'POST',
                 'dataType'=>'html',
                 'success'=>"js:function(data){
                            $('#cropModal').html(data).dialog('open'); return false;
                            }",
                'complete'=>"js:function(){
                            //$('#crop').val('Crop');
                            $('#crop".$index."').val('Crop');
                            }",
                ),
                array('id'=>'crop'.$index,'class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#ArticleFile_'.$index.'_filename").val()==""){alert("Please upload the image and try cropping");return false;}else $("#crop'.$index.'").val("loading...");')//html options
    );
    ?>
          </aside><!--buttons	-->
          <?php echo CHtml::activeHiddenField($modelObj, "[$index]filename", array('value'=>$image->filename));?>
          <aside class="imageCaption floatLeft">
         
           <?php echo CHtml::activeLabel($modelObj, "[$index]title")?>
            <textarea id="ArticleFile_<?php echo $index?>_title" name="ArticleFile[<?php echo $index?>][title]"><?php echo $image->title?></textarea>
          </aside><!--imageCaption-->
          <?php $indexId = end(explode('_',$index));?>
          <aside class="remove floatRight">
            <a class="btn btn-danger" href="javascript:void(0);" onclick="$('#remove_<?php echo $index ?>').remove();">Remove</a>
            <?php //echo CHtml::ajaxLink('Remove', array('deleteImage', 'id'=>$indexId), array('replace'=>'#remove_'.$index), array('class'=>'btn btn-danger', 'id'=>'link'.uniqid()));?>
          </aside><!--remove-->
          <div class="clear"></div>
        
        <div id="cropImg" style="display:none;"></div>
      </li>
      <?php }   
        }
        else{?>
      <div id="thumbDiv"></div>
      <div id="cropDiv" style="display:none">
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Crop', 'htmlOptions'=>array('id'=>'cropButton'))); ?>
      </div>
      <?php }?>
      <div class="line"></div>
    </ul>
    <ul class="images">
      <?php if(empty($image)){
		  for($i=0; $i<count($modelImages); $i++):?>
      <?php $this->renderPartial('_imageform', array(
				'modelImages' => $modelImages[$i],
				'index' => $i,
			))?>
      <?php endfor; }?>
    </ul>
  </div>
  <!--addContentArea--> 
  
  <?php echo CHtml::button('+Add Photo', array('class' => 'btn image-add'))?>
  <div class="greybg margintopbot10"><?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large', 'style'=>'margin-left:120px;'));?></div>
  <?php $this->endWidget();?>
</aside>
<!--addArticles-->

<aside class="rightContainer floatRight"> </aside>
<!--rigtCOntainer-->
<div class="clear"></div>