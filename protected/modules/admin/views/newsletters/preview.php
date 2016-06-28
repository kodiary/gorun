<aside class="left_body addArticles">
<?php $this->renderPartial('_newslettermenu');?>

<div class="addContentArea">
<a class="blue" href="<?php echo $this->createUrl('/newsletters/newsletter'.$model->number.'.html');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/newsletters/newsletter'.$model->number.'.html');?></a>
</div>

</aside>
<div class="clear"></div>