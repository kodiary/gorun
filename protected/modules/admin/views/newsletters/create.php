<aside class="col-md-8 addArticles">
<?php $this->renderPartial('_newslettermenu');?>

<div class="addContentArea"><?php echo $this->renderPartial('_selectTemplate', array('templates'=>$templates)); ?></div>

</aside>
<aside class="col-md-4 addArticles">
    <?php $this->renderPartial('_sidebar'); ?>
</aside>
<div class="clear"></div>

