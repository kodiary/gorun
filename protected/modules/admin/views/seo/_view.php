<div class="border_line">
    <div class="text_desc_l">
    <?php echo CHtml::encode($data->PageTitle." Seo"); ?> - <span class="f15 blue"><?php echo "Updated ".date('d F Y',strtotime($data->Updated)); ?></span>
    </div>
    <div class="text_desc_r">
    <?php $url = '/admin/seo/update/id/'.$data->SeoId; ?>
     <?php echo CHtml::link('View',array($url),array('class'=>'btn btn-info'))?>
    </div>
    <div class="clear"></div>
</div>