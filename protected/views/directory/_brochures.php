<div id="brochureInfo" class="menu_bars" style="display: none;">
<?php 
if($brochures){?>
    <ul>
        <?php foreach($brochures as $model){?>
        <li>
            <div class="titles"><?php echo $model->title;?></div>
            <div class="texts_menus">
                <?php echo $model->detail;?>
                <?php if(file_exists(Yii::app()->basePath.'/../documents/'.$model->filename) && $model->filename){
                    $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
                    $filesize = CommonClass::format_file_size(filesize($folder)); ?>    
                    <div class="pdf_downloads_f_side">
                        <?php echo CHtml::ajaxLink("View Menu", CController::createUrl('site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$model->filename)), 'title'=>$model->title,'filename'=>$model->filename)),array('success'=>'function(data){$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>'pdf_icons'));?>
                        <p><?php echo CHtml::ajaxLink($model->title. ' ( '.$filesize.' )', CController::createUrl('site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$model->filename)), 'title'=>$model->title,'filename'=>$model->filename)),array('success'=>'function(data){$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>''));?></p>
                    </div>
                <?php }?>
            </div>
            <div class="clear"></div>
        </li>    
        <?php 
        }
    }?>
    </ul>
</div>