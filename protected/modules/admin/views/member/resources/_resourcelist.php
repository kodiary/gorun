<?php
if($companyId){
    $companyMember = CompanyMember::getMemberByCompany($companyId);
    $checkCategory[] = array();
    foreach($companyMember as $member)
    {
        $resourceCategoryModel = ResourceCategory::getResourceCategoryByMemberType($member);
        if($resourceCategoryModel)
        {
            foreach($resourceCategoryModel as $resCatModel)
            {
                if(!in_array($resCatModel->title,$checkCategory))
                {
                    $checkCategory[$resCatModel->id] = $resCatModel->title;
                }
            }
        }
    }
    
    if(!empty($checkCategory))
    {
        asort($checkCategory);
        foreach($checkCategory as $key=>$val)
        {
            if($key!=0){
            ?>
            <div class="border_line resource_category_list">
                <div class="text_desc_l">
                    <span class="titles"><?php echo $val?></span>
                    <div class="postedDate blue"><?php echo Resources::countResourceByCategory($key).' Items';?></div>
                </div>
                <div class="text_desc_r">
                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'View',
                        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'url' => $this->createUrl('viewdocs', array('id'=>$companyId,'catid'=>$key)),
                        'htmlOptions'=>array('id'=>'view_'.$key),
                    )); ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php
            }
        }
    }
}
?>