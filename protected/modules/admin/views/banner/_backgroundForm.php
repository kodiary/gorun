<?php 
$form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'specials-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true,),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    <div class="news_image_listing">
    <div class="buttons_for_img"> 
    <div id="logo">
        <div class="item_img thumbnail">
            <?php
            $logo=$model->image;
            if($logo!="")
            {
                 if(Yii::app()->file->set('images/frontend/main/'.$logo)->exists)
                 {
                    $logoUrl=Yii::app()->baseUrl.'/images/frontend/main/'.$logo;
                ?>
                <img src="<?php echo $logoUrl;?>"/>
                <?php 
                }
            }
            else
            {
                echo CHtml::image(Yii::app()->baseUrl.'/images/blank_images.gif');
            }
        ?>
        </div>
   	</div>
    </div> 
    <div class="submit_buttons_img">
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload', //select file button
                    array(
                        'id'=>'uploadFile',
                        'config'=>array(
                                       'action'=>$this->createUrl('uploadbackground'),
                                       'multiple'=> false,
                                       'debug'=> true,
                                       'allowedExtensions'=>array("jpg","jpeg",'gif','png'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes (10 MB))
                                       //'minSizeLimit'=>1024,// minimum file size in bytes
                                       'onProgress'=>"js:function(id, fileName, loaded, total){
                                            $('#uploadControl').text('Uploading...');
                                        }",
                                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                                $('#uploadControl').text('Select');
                                                if(responseJSON.success)
                                                {
                                                    $('#logo').html('<img src=\"'+responseJSON.imageThumb+'\"/>');
                                                    $('#BackgroundBanner_image').val(responseJSON.filename);
                                                }
                                                else
                                                {
                                                    alert('something went wrong!');
                                                }  
                                       }",
                                       'messages'=>array(
                                                        'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                         'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                         'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                       ),
                                       'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      ));
        ?>
    </div>
    <div class="image_captions_holders">    
        <?php echo $form->labelEx($model, "link");?>
    	<?php echo $form->textField($model, "link",array('class'=>'span5'));?>    
        <?php echo $form->error($model, "link");?> 
        
        <div class="bannerRadio margin">
        <?php echo $form->labelEx($model, "target",array('class'=>'marginTop10'));?>
        <?php echo $form->radioButtonList($model, 'target', array('1'=>'New Window', '0'=>'Same Window')); ?> 
        <div class="clear"></div>
        </div>   
        <div>
         <?php echo $form->labelEx($model, "color");?>
        <?php
            $this->widget('ext.SMiniColors.SActiveColorPicker', array(
            'model' => $model,
            'attribute' => 'color',
            'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
            'options' => array(), // jQuery plugin options
            'htmlOptions' => array(), // html attributes
            ));
        ?>
        </div>    
    </div> 
    <div class="clear"></div>
    </div>
    <?php echo $form->hiddenField($model,'image');?>
    <?php echo $form->error($model, "image");?>
    <div class="line"></div>
    <div class="account-active bannerVisibility"> 
        <div class="fl_left"><strong>VISIBILITY</strong></div>
        <div class="fl_right"><div class="bannerRadio"><?php echo $form->radioButtonList($model, 'visibility', array('1'=>'ON', '0'=>'OFF')); ?> <div class="clear"></div></div></div>
        <div class="clear"></div> 
     </div>
    <div class="greybg">
    <div style="padding-left:120px;">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large', // '', 'large', 'small' or 'mini'
			'label'=>'Save',
		)); ?>
	</div>
    </div>
<?php $this->endWidget();?>