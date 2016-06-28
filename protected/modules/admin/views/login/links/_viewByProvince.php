<?php
if($links)
{
    foreach($links as $data)
    {
    ?>
    <li id="item_<?php echo $data->LinkId;?>">
    <div class="border_line">
            <div class="text_desc_l">
                <?php
                $area_detail=Area::model()->findByPk($data->AreaId);
                $province_detail=Province::model()->findByPk($area_detail->RegId);
                ?>
                <p class="names"><?php echo ucwords($province_detail->Region)." > ".ucwords($area_detail->Area)?></p>
                <p class="links"><?php echo CHtml::encode($data->Url);?></p>
            </div>
            <div class="text_desc_r">
             <?php echo CHtml::link('Delete','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->LinkId.'").show();','class'=>'btn btn-danger'));?>
                <?php echo CHtml::link('Edit',array('/admin/links/update/id/'.$data->LinkId),array('class'=>'btn btn-info'))?>
            </div>
            <div class="clear"></div>
        </div>
    <div id="div_del_<?php echo $data->LinkId;?>" style="display: none;" class="warning_blocks">
    	<div class="fl_left">Cannot be undone - Are you sure you want to delete?</div>
        <div class="fl_right"><?php echo CHtml::link('Delete', array('/admin/links/delete', 'id'=>$data->LinkId),array('class'=>'btn btn-danger'));?> <?php echo CHtml::link('Cancel','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->LinkId.'").hide();','class'=>'btn'));?>
        </div>
        <div class="clear"></div>
    </div>
    
    </li>
<?php
    }
}
else
{
    echo "No results found.";
}
?>