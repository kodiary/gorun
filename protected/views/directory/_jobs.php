<div id="jobsInfo" style="display:none;">
<div class="line" style="margin-top: 0;"></div>
<?php 
if($jobs)
{
    foreach($jobs as $data)
    {
   ?>
    <div class="jobs_listing">
    <article> 
        <aside class="fl_Left article_desc">
        <div class="jobDesc" id="desc_<?php echo $data->id;?>" style="cursor: pointer;">
            <h2><?php echo $data->title;?></h2>
            <p class="desc">
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
                <div id="short_desc_<?php echo $data->id?>" class="short_desc"><?php echo CommonClass::limit_text($data->desc);?></div>
                <div id="long_desc_<?php echo $data->id?>" class="long_desc" style="display: none;"><?php echo $data->desc?></div>
            </p>
        </div>
        </aside><!--articleContent-->
        <div class="clear"></div>
    </article>
    </div>
    <div class="line"></div>
   <?php 
    }  
}
?>
</div>