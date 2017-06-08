<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'cropModal',
        'options'=>array(
            'width'=>'auto',
            'height'=>'auto',
            'autoOpen'=>false,
            'resizable'=>false,
            'modal'=>true,
            'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
            ),
            'close'=>"js:function(e,ui){ // to overcome multiple submission problem
                $('#cropModal').empty();
            }",
        ),
    ));
    //modal dialog content here
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<aside class="leftContainer floatLeft addArticles news photos" id="news-form">
<div class="line"></div>
  <?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  <div class="subTitle">
    <h1>Photos - <span class="blue">Include photos with your article - (Optional)</span></h1>
  </div>
  <!--subTitle-->

  <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articlePhoto-form',
  ));?>

<div class="line"></div>
<div id="uploadFile">
    <div class="qq-uploader" >
        <div class="qq-upload-drop-area" ><span>Drag and drop photos here to add them</span></div>
        <div class="image_rows">
        	<div class="qq-upload-button qq-upload-image-button" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Add Photos</span>
            <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
        </div>
        </div>
        <div class="blue">Add one or more</div>
        <ul class="qq-upload-list"></ul>
    </div>
</div>  
<ul id="uploadList">
    <?php if(!$model->isNewRecord){
        foreach($model as $i=>$model_image){ ?>
            <li class="items" id="image_<?php echo $i; ?>">
                <?php if($model_image){ ?>
                <div>
                    <div id="imageHolder_<?php echo $i;?>"><img src="<?php echo $this->createUrl('/images/frontend/thumb/'.$model_image->filename)?>"/></div>
                    <div class="btns">
                    <?php echo CHtml::ajaxLink('Remove', array('deleteImage', 'id'=>$model_image->id), array('replace'=>'#image_'.$i), array('class'=>'btn btn-danger mar-bot-10'));?>
                        <?php
                        //crop button
                        echo CHtml::ajaxButton('Crop',
                            $this->createUrl('cropImg'),
                            array( //ajax options
                            'data'=>array('fileName'=>'js:$("#ArticleFile_'.$i.'_filename").val()', 'index'=>$i),
                            'type'=>'POST',
                            'dataType'=>'html',
                            'success'=>"js:function(data){
                                    $('#crop".$i."').val('Crop');
                                    $('#cropModal').html(data).dialog('open'); return false;
                                    }",
                            'complete'=>"js:function(){
                                    //$('#crop').val('Crop');
                                    $('#crop".$i."').val('Crop');
                                    }",
                            ),
                            array('id'=>'crop'.$i,'class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#ArticleFile_'.$i.'_filename").val()==""){alert("Please upload the image and try cropping");return false;}else $("#crop'.$i.'").val("loading...");')//html options
                        );
                        ?>
                        </div>
                    <?php echo CHtml::activeTextArea($model_image,"[$i]title",array('placeHolder'=>'Caption')); ?>
                    <?php echo CHtml::activeHiddenField($model_image, "[$i]filename");?>
                    <div class="clear"></div>
                </div>
                <?php } ?>
            </li>
    <?php }
    } ?>
</ul>
<div class="greybg margintopbot10"><?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large', 'style'=>'margin-left:120px;'));?></div>
  <?php $this->endWidget();?>
</aside>
<!--addArticles-->

<aside class="rightContainer floatRight">
    <?php 
  if(isset($_GET['id'])) {
    $this->renderPartial('_social'); 
  }
  ?>
</aside>
<!--rigtCOntainer-->
<div class="clear"></div>