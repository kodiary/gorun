<div class="left_body">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="line"></div>
<h1>Search Engine Optimisation</h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',
)); ?>
<div class="border_line">
    <div class="text_desc_l">
    <p class="f17">Company Seo</p>
    </div>
    <div class="text_desc_r">
     <?php echo CHtml::link('View',array('/admin/seo/updateCompany'),array('class'=>'btn btn-info'))?>
    </div>
    <div class="clear"></div>
</div>

</div>
	<div class="right_body">
    	<div class="right_btns">
        <div class=" mar-bot-10">
        <a href="#" class="btn">Site Map Download</a>
        <!--<a href="<?php echo $this->createAbsoluteUrl('/sitemap.xml') ?>" class="btn" target="_blank">Site Map Download</a>-->
        </div>
        <?php $this->renderPartial('_bypage'); ?>
        </div>
    </div>
<div class="clear"></div>