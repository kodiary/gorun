<?php $this->beginContent('//layouts/main'); ?>
	<div id="content">
    <?php
    if(!Yii::app()->user->isGuest)
    {
        $id=Yii::app()->user->id;
        $model=Company::companyInfo($id);
        
    ?>
   <?php /* <h1><?php echo ucwords($model->name);?></h1> */ ?>
    <p class="ext_heading">Control your company listing here - update details,photos or videos - or just view your statistics</p>
    <div class="line"></div>
	<div class="members_menus">
 		<?php $this->widget('CompanyMenu');?>
	</div>
   <div class="line" style="margin-top:5px;"></div>
    <?php
    }
    ?>
	<?php echo $content; ?>
	</div><!-- content -->
<?php $this->endContent(); ?>