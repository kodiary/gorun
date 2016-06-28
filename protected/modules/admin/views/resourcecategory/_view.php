<div class="resource_category_listing">

    <div id="<?php echo $data->id?>" class="border_line drag">
        <div class="text_desc_l">
            <span class="titles"><?php echo $data->title?></span> - <a  href="javascript:void(0);" class="blue" onclick="$('#companies_<?php echo $data->id?>').toggle();"><?php echo CompanyResources::getResourceById($data->id).' Tags';?></a>
        </div>
        
        <div class="text_desc_r">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$data->id,
                'onClick'=>'$("#show_'.$data->id.'").show();'),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'edit_'.$data->id),
            )); ?>
        </div>
        <div class="clear"></div>
    </div>
         
    <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
        <div class="fl_left">
            <span class="bold">Warning:</span> This cannot be undone. Are you sure?
        </div>
        <div class="fl_right">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => $this->createUrl('delete', array('id'=>$data->id)),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
            ));?>
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>">Cancel</a> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

<?php 
$list=CompanyResources::getCompanyByResources($data->id);
if($list)
{
?>
<div id="<?php echo 'companies_'.$data->id ?>" style="display: none;">
    <?php
    foreach($list as $val)
    {
        $company=Company::companyInfo($val);
    ?>
        <div class="companyEnclose blue"><a href="<?php echo $this->createUrl('/admin/company/update/id/'.$val);?>"><?php echo $company->name; ?></a> - <?php echo date('d F Y',strtotime($company->date_updated));?></div>
    <?php
    }
    ?>
</div>
<?php
}
?></div>