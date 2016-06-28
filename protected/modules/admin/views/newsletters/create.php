<aside class="left_body addArticles">
<?php $this->renderPartial('_newslettermenu');?>

<div class="addContentArea"><?php echo $this->renderPartial('_selectTemplate', array('templates'=>$templates)); ?></div>

</aside>
<aside class="right_body addArticles">
    <?php $this->renderPartial('_sidebar'); ?>
</aside>
<div class="clear"></div>

