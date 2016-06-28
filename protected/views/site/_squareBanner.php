<?php 
 $banners = Banner::randSquareBanner();
if($banners)
{
?>
<div class="advertise">
<ul class="adv_blck">
<?php
$count = 0;

    foreach($banners as $banner){
        $count++;
        BannerViews::saveViews($banner->id);
        if($banner->opens==1)
            $target = '_blank';
        else
            $target='_self';
        
        if($image = Banner::Image($banner->image, $banner->alt_tag)){?>
        
        <li class="<?php echo ($count%2==0)? 'right': ''?>">
        <a href="<?php echo $this->createUrl('/banner/index/id/'.$banner->id);?>" target="<?php echo $target ?>"><?php echo $image;?></a>
        </li>
        <?php /*if($count%2==0){?><div class="clear"></div><?php }*/?>
        
<?php }}?>
        
    </ul>
    <div class="clear"></div>
</div>
<?php
}
?>