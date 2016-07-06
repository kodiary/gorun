<ul class="images gall_add_list_imgage">
<li>
<div class="row" style="margin-bottom: 10px;">
    
    <div class="image_rows">
    <?php //echo CHtml::activeHiddenField($model, "[0]name")?>
     
    <div id="upimage_0" style="width: 80px;height:80px; margin-right: 15px;" class="thumbnail"></div>
     
    </div>
    
    <div class="button_rows">
     <div id="file-uploader_0">
     <div class="qq-uploader">
    <div>
        <div id="uploadFile">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="image_rows">
                	<div class="qq-upload-button" id="0" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
                    <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                </div>
                </div>
                <ul style="display:none" class="qq-upload-list"></ul>
            </div>
        </div>    
    </div>
    </div>
    </div>
    </div>
 	<div class="clear"></div>   
     
    </div>
	<div class="row upldPhoto">
		
		<?php //echo CHtml::activeTextArea($model, "[0]caption")?>
        <p class="gray" style="margin-top: 6px;">Add a OPTIONAL description for this image</p>
	</div>
 <ul id="uploadList"></ul>
 </li>
 </ul>
