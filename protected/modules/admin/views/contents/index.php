<?php
$this->breadcrumbs=array(
	'Pages',
);
?>
<aside class="col-md-8 floatLeft">
<div class="line"></div>
<h1>Parent Pages</h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php
    foreach($model as $page)
    {
    ?>
    <div class="greybg" style="margin-bottom: 8px;">
    <div class="floatLeft" style="font-size: 17px; color:#333333; line-height:28px;"><?php echo CHtml::encode($page->title); ?></div>
    <div class="floatRight">
	<?php echo CHtml::link('Edit',array('/admin/contents/update/id/'.$page->id),array('class'=>'btn btn-info'))?>
	</div>
    <div class="clear"></div>
    </div>
    <?php } ?>

</aside>

<aside class="col-md-4 floatRight" >
	<a href="<?php echo $this->createUrl('/admin/contents/create')?>" class="btn">+Add Page</a>
</aside>

<div class="clear"></div>