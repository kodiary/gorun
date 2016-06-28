<ul id="rest-specials">
<?php if($dataProvider)
{ 
    foreach($dataProvider as $data)
    {
        $company = Company::companyInfo($data->company_id);
        //$special_type=($data->type==2)?"eventBanner":"specialBanner";
    ?>

    <li class="main spcllistss thumbnail" id="<?php echo $data->slug;?>">
    	<div class="img_thumbs  image_thumbs1">
        <div class="sPBanner specialBanner"></div>
    	<a href="javascript:void(0);" class="spexpand thumbnail" id="spimage_<?php echo $data->slug;?>">
        <?php echo Specials::Image(CHtml::encode($data->image), 'thumb', ($data->image_caption!="")?CHtml::encode($data->image_caption):$data->title); ?>
        </a>
       </div>
       <div class="text_blocks">     
        <div class="spHeading"><a href="javascript:void(0);" class="spexpand" id="sptitle_<?php echo $data->slug;?>"><?php echo ucwords(CHtml::encode($data->title)); ?></a></div>
    
        <div class="spDate"><span class="red">Ends</span> <?php echo CommonClass::formatDate($data->expiry_date);?> </div>
        <?php 
            $province_name = Province::model()->findByPk($company->province)->name;
            $address = $company->street_add;
        ?>
        <div class="blue"><?php if($address!='') echo $address.', ';?><?php if($province_name!='') echo $province_name?></div>
        <div class="orange"><strong><?php echo ucwords($company->name);?></strong></div>
         
       
       </div><!--TextBlocks-->
       <div class="clear"></div>
       <div class="spDtails"> 
           <div id="short_<?php echo $data->slug;?>">
             <p><?php echo CommonClass::limit_text(strip_tags($data->detail),130);?>
             <span class="Bold"><a href="javascript:void(0);" class="spexpand" id="spreadmore_<?php echo $data->slug;?>">Read More</a></span></p>
           </div>
           
           <div id="long_<?php echo $data->slug;?>" class="spexpanded" style="display: none;">
                <div><?php echo $data->detail;?></div>
                <?php if($data->filename){
                    $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
                    $filesize = CommonClass::format_file_size(filesize($folder));?>
                <div class="pdf_downloads_f_side">
                    <?php echo CHtml::ajaxLink("View Special", CController::createUrl('site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$data->filename)), 'title'=>$data->title,'filename'=>$data->filename)),array('success'=>'function(data){window.scrollTo(0,0);$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>'pdf_icons'));?>
                    <p><?php echo CHtml::ajaxLink('View Special ( '.$filesize.' )', CController::createUrl('/site/menu', array('url'=>urlencode($this->createAbsoluteUrl('/documents/'.$data->filename)), 'title'=>$data->title,'filename'=>$data->filename)),array('success'=>'function(data){window.scrollTo(0,0);$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid()));?></p>
                </div>
    
                <?php }?>
                <?php
                if($data->image!="" && file_exists(Yii::app()->basePath.'/../images/frontend/full/'.$data->image))
                {
                     //Create an instance of ColorBox
                    $colorbox1 = $this->widget('application.extensions.colorpowered.JColorBox');
                     
                    //Call addInstance (chainable) from the widget generated.
                    $colorbox1->addInstance('.spGallery');
                    $full_image=Yii::app()->baseUrl.'/images/frontend/full/'.$data->image;
                ?>
                <span class="thumbnail spBigImg"><a rel="tooltip" title="Click to view" href="<?php echo $full_image;?>" class="spGallery"><img  src="<?php echo Yii::app()->baseUrl.'/images/frontend/main/'.$data->image;?>" alt="<?php echo $data->title;?>"/></a></span>
                <div class="clear"></div>
                <?php
                }
                ?>
           </div>
       </div>
    
    </li>
<?php 
    }
}
?>
</ul>