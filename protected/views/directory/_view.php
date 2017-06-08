<?php
    $name = $data->name;
	$alt_logo = $name;
    $logo = $data->logo;
    $logo_url = Yii::app()->baseUrl."/images/no_image_medium.jpg";  
    if($logo!="") 
    {
       if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$logo))
       {
          $logo_url=Yii::app()->baseUrl."/images/frontend/thumb/".$logo;  
       } 
    }
    $desc = CommonClass::getCleanData($data->detail,200)."...";
    $province_name = Province::model()->findByPk($data->province)->name;    
    $address = $province_name;
    $membership=$data->membership;
    if($membership)
    {
       foreach($membership as $member)
        {
            $member_type.=MemberType::model()->findByPk($member->member_id)->type_name.', ';
        } 
    }
 ?>
    <div class="laout_5 direcotry_listing">
    	<div class="img_left">
        	<a class="thumbnail" href="<?php echo $this->createUrl('/directory/'.$data->slug); ?>"><?php echo Company::Image($logo, 'thumb', $alt_logo);?></a>
        </div>
    <a href="<?php echo $this->createUrl('/directory/'.$data->slug); ?>">    
    	<div class="texts_right">
        	<h2><?php echo $name;?></h2>
            <p class="address">
                <span class="add2"> <?php echo $address; ?></span>
                <span><?php echo trim($member_type,', ');?></span>
            </p>
            <p class="desc"><?php echo $desc;?></p>
    	</div>
    </a>
    <div class="clear"></div>
    </div>