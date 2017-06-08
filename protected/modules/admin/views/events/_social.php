<?php 
$id = $_GET['id'];
$model = Events::model()->findByPk($id);
?>
<div class="sidebar-social">
<div class="social-media-count">
<p>Post to Social Media</p>
<div class="social-media-count-num">
<?php 
		$fb_likes = CommonClass::countFBLikes();
		$twit_follow = CommonClass::getFollowersCount();
		echo ((int)$fb_likes + (int)$twit_follow) 
		?>
</div>
</div>

<div class="post-fb">
	<a class="<?php echo ($model->is_facebook != 1) ? '' : 'posted' ; ?>" href="<?php echo ($model->is_facebook != 1) ? $this->createUrl('postFB', array('back_url'=>Yii::app()->controller->action->id, 'id' => $_GET['id'])) : 'javascript:void(0);'?>"></a>
	<?php echo $fb_likes ?>
</div>

<div class="post-twt">
	<?php echo $twit_follow ?>
	<a class="<?php echo ($model->is_twitter != 1) ? '' : 'posted' ; ?>" href="<?php echo ($model->is_twitter != 1) ? $this->createUrl('postTwit', array('back_url'=>Yii::app()->controller->action->id, 'id' => $_GET['id'])) : 'javascript:void(0);'?>"></a>
</div>

<div class="clear"></div>

<p>Our you are ready click the icons to post to Facebook or Twitter</p>
</div>

<div class="clear"></div>