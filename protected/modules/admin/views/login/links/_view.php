
    <div class="border_line">
        <div class="text_desc_l">
            <?php if($data->LinkId==1){?>
            <p class="names">Home Page</p><?php }else{
            $area_detail=Area::model()->findByPk($data->AreaId);
            $province_detail=Province::model()->findByPk($area_detail->RegId);
            ?>
            <p class="names"><?php if($data->ProvinceId) echo ucwords(Region::get_region_by_id($data->ProvinceId)->Region);?> > <?php if($data->AreaId) echo ucwords(Area::get_area_by_id($data->AreaId)->Area);?></p><?php }?>
            <p class="links"><?php echo CHtml::encode($data->Url1);?></p>
            <p class="links"><?php echo CHtml::encode($data->Url2);?></p>
        </div>
        <div class="text_desc_r">
         <?php /*echo CHtml::link('Delete','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->LinkId.'").show();','class'=>'btn btn-danger'));*/?>
            <?php 
            if(isset($_GET['linkid']))
                echo CHtml::link('Edit',array('/admin/links/update/id/'.$data->LinkId, 'linkid'=>$_GET['linkid']),array('class'=>'btn btn-info'));
            else
                echo CHtml::link('Edit',array('/admin/links/update/id/'.$data->LinkId),array('class'=>'btn btn-info'))?>
        </div>
        <div class="clear"></div>
    </div>
<div id="div_del_<?php echo $data->LinkId;?>" style="display: none;" class="warning_blocks">
	<div class="fl_left">Cannot be undone - Are you sure you want to delete?</div>
    <div class="fl_right"><?php echo CHtml::link('Delete', array('/admin/links/delete', 'id'=>$data->LinkId),array('class'=>'btn btn-danger'));?> <?php echo CHtml::link('Cancel','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->LinkId.'").hide();','class'=>'btn'));?>
    </div>
    <div class="clear"></div>
</div>
