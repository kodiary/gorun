<div class="jobs_listing-new">
<article> 
    <aside class="fl_Left article_desc">
    <div class="jobDesc" id="desc_<?php echo $data->id;?>" style="cursor: pointer;">
        <h2><?php echo $data->title;?></h2>
        <span class="desc">
            <?php
                $company = Company::companyInfo($data->company_id);
                if($company && $company->province!=0){
                    $province = Province::model()->findByPk($company->province)->name;
                }
            ?>
            <span class="blue">
                <?php
                    if($company->suburb!='') echo $company->suburb . ', ';
                    if($province) echo $province;
                ?>
            </span>
            - <span id="short_desc_<?php echo $data->id?>" class="short_desc"><?php echo CommonClass::limit_text($data->desc);?></span>
            <span id="long_desc_<?php echo $data->id?>" class="long_desc" style="display: none;"><?php echo $data->desc;?></span>
        </span>
    </div>
    </aside><!--articleContent-->
    <div id="company_<?php echo $data->id;?>" style="display: none;" class="job-company">
    <?php $this->renderPartial('application.views.directory._view',array('data'=>$company));?>
    </div>
    <div class="clear"></div>
</article>
</div>
