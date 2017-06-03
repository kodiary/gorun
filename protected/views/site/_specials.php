<?php if($dataProvider){?>
<div class="special_f_rest" style="margin-bottom:10px;">
<div class="gray_blocks round cuSpec">
    <div style="float:left;"><h2><span class="bold">Current</span> Specials</h2></div>
    <div style="float:right;margin-top: 5px;"><a style="color:#999999;font-family: Arial;font-size:13px;" href="<?php echo $this->createUrl('/specials');?>" class="arrow">See More</a></div>
    <div class="clear"></div>
</div> 
<?php   
foreach($dataProvider as $data){?>
<?php 
 $company = Company::companyInfo($data->company_id);
 ?>
<li class="main spcllistss thumbnail">
	<div class="img_thumbs  image_thumbs1">
    <div class="sPBanner specialBanner"></div>
	<a rel="tooltip" title="<?php echo $data->title?>" href="<?php echo $this->createUrl('/companies/'.$company->slug.'#'.$data->slug)?>" class="thumbnail">
    <?php echo Specials::Image(CHtml::encode($data->image), 'thumb', CHtml::encode($data->image_caption)); ?>
    </a>
   </div>
   <div class="text_blocks">     
    <div class="bold spHeading" id="<?php echo $data->slug?>">	<a href="<?php echo $this->createUrl('/companies/'.$company->slug.'#'.$data->slug)?>"><strong><?php echo ucwords(CHtml::encode($data->title)); ?></strong></a></div>

    <div class="spDate"><span class="red">Ends</span>  <?php echo CommonClass::formatDate($data->expiry_date);?> </div> 
    <?php 
       $province_name = Province::model()->findByPk($company->province)->name;
       $address = $company->street_add;
    ?>
    <div class="blue"><?php if($address!='') echo $address.', ';?><?php if($province_name!='') echo $province_name?></div>
    <div class="orange"><strong><?php echo ucwords($company->name);?></strong></div>
     
   
   </div><!--TextBlocks-->
   <div class="clear"></div>
   <div class="spDtails"> 
     <p><?php echo CommonClass::limit_text(strip_tags($data->detail),130);?>
     <span class="Bold"><a href="<?php echo $this->createUrl('/companies/'.$company->slug.'#'.$data->slug)?>">Read More</a></span></p>
     </div>

</li>
<?php }?>
</div>
<?php }?>