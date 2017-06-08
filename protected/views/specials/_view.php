<?php 
$company=Company::model()->findByPk($data->company_id);
if($company->province!=0) $province=Province::model()->findByPk($company->province)->name;
if($company->country!=0) $country= Countries::model()->findByPk($company->country)->name;
?>
<div class="line_directory">
 <h2><a href="javascript:void(0);" class="expand" id="title_<?php echo $data->id;?>"><?php echo CHtml::encode($data->title); ?></a></h2>
    <div class="left img_thumbs  image_thumbs1 thmnSpcl">
    <div class="sPBanner specialBanner"></div>
        <a class="thumbnail expand" rel="tooltip" href="javascript:void(0);" title="<?php echo $company->name?>" id="image_<?php echo $data->id;?>">
        <?php echo Specials::Image(CHtml::encode($data->image), 'thumb', CHtml::encode($data->image_caption)); ?>
        </a>
    </div>
    <div class="right">
        <div class="spDate"><strong><?php echo CommonClass::formatDate($data->expiry_date);?></strong> </div> 
        <div>
            <span class="orange"><a href="<?php echo $this->createUrl('/companies/'.$company->slug.'#'.$data->slug)?>"><strong><?php echo ucwords($company->name)?></strong></a></span>
             <span class="blue"><?php echo ($province && $country)?' - '.$province.', '.$country:''; ?></span>
        </div>
        
        <div id="short_<?php echo $data->id;?>"> 
            <?php echo CommonClass::limit_text(strip_tags($data->detail));?>
            <div class="spDate"><a href="javascript:void(0);" class="expand" id="expand_<?php echo $data->id;?>"><strong>Read More...</strong></a></div>
        </div>
        <div id="long_<?php echo $data->id;?>" style="display: none;" class="expanded">
            <div><?php echo $data->detail;?></div>
            <div class="spDate"><a href="javascript:void(0);" onclick="$('#long_<?php echo $data->id;?>').slideUp('slow');$('#short_<?php echo $data->id;?>').slideDown('slow');"><strong>Close..</strong></a></div>

            <?php if($data->filename && file_exists(Yii::app()->basePath.'/../documents/'.$data->filename))
            {
                $filesize = CommonClass::format_file_size(filesize(Yii::app()->basePath.'/../documents/'.$data->filename));
            ?>
            <div class="pdf_downloads_f_side">
                    <?php echo CHtml::ajaxLink("View Special", CController::createUrl('site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$data->filename)), 'title'=>$data->title,'filename'=>$data->filename)),array('success'=>'function(data){window.scrollTo(0,0);$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>'pdf_icons'));?>
                    <p><?php echo CHtml::ajaxLink('View Special ( '.$filesize.' )', CController::createUrl('/site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$data->filename)), 'title'=>$data->title,'filename'=>$data->filename)),array('success'=>'function(data){window.scrollTo(0,0);$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid()));?></p>
                </div>

            <?php }?>            
            <?php
            if($data->image!="" && file_exists(Yii::app()->basePath.'/../images/frontend/full/'.$data->image))
            {
            ?>
            <span class="thumbnail spBigImg"><img  src="<?php echo Yii::app()->baseUrl.'/images/frontend/full/'.$data->image;?>" alt="<?php echo $data->title;?>"/></span>
            <div class="clear"></div>
            <?php
            }
            ?>
            <div class="viewResturants"><a href="<?php echo $this->createUrl('/companies/'.$company->slug)?>">View Company</a></div>
        </div>
        
    </div>
    <div class="clear"></div>
 </div>