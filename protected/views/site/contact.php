<?php
$this->breadcrumbs=array(
	'contact us',
);
?>

<div class="body_content_left contact">
<div class="line"></div>
<h1>Contact EXSA</h1>
<div class="line"></div>
<?php echo $contact->desc;?>
<?php
	if($contact->display_map==1 && $contact->google_map!='')
	{
		echo $contact->google_map;
	}
?>
<?php $this->renderPartial('/site/_bottomBanner');?>
</div>
<div class="body_content_right contact">
    <?php if($contact->display_form){?>
        <?php $this->renderPartial('_contactForm',array('model'=>$model));?>
        <div class="no_marg_banner"></div>
    <?php }?>
    <?php $this->renderPartial('/site/_squareBanner');?>
</div>
<div class="clear"></div>