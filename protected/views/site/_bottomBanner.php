<?php 
$banner = Banner::randBottomBanner();

if($banner->opens==1)
    $target = '_blank';
else
    $target='_self';

if($image = Banner::Image($banner->image, $banner->alt_tag)){
    BannerViews::saveViews($banner->id);?>
<div class="banner_600">
<a href="<?php echo $this->createUrl('/banner/index/id/'.$banner->id);?>" target="<?php echo $target ?>"><?php echo $image;?></a>
</div>
<?php }?>