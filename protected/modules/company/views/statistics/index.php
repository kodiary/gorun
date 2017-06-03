<div class="body_content_left">
<div class="restaurant_menus_wrapper">
<h2>Statistics - <span>How your listing has done since it has listed</span></h2>
<!-- monthly report-->
<div class="line"></div>
<form method="post" id="frmYearlyStat">
<span>Year &nbsp;&nbsp;&nbsp;&nbsp;</span>
<select name="year" onchange="if($(this).val()!='')$('#frmYearlyStat').submit();">
<option value="">Select Year</option>
<?php
if($years)
{
    foreach($years as $val)
    {
        ?>
        <option value="<?php echo $val->year ?>" <?php if($year==$val->year)echo "selected";?>><?php echo $val->year ?></option>
        <?php
    }
}
?>
</select>
</form>
<div class="line"></div>
<div id="monthly_stat">
<table cellpadding="5" border="0" class="table table-bordered table-striped">
<tr>
    <th>Month</th>
    <th>Advert Viewed</th>
    <th>Contact Clicked</th>
    <th>CTR - Ratio</th>
</tr>
<?php 
$months=CompanyViews::get_all_months_by_year(Yii::app()->user->id,$year);
if($months)
{
    foreach($months as $val)
    {
    ?>
    <tr>
        <td><?php echo sprintf('%02d',$val->month).'-'.$year?></td>
        <td><?php $views = CompanyViews::monthly_report_by_company(Yii::app()->user->id, $val->month, $year)->count;
        echo $views? $views: 0;?></td>
        <td><?php $clicks = CompanyClicks::monthly_report_by_company(Yii::app()->user->id, $val->month, $year)->count;
        echo $clicks? $clicks: 0;?></td>
        <td><?php if($views!=0) echo number_format(($clicks/$views)*100, 2); else echo '0'?>%</td>
    </tr>
<?php 
    }
}
?>

</table>
</div>

<div class="blue"><strong>CTR - Ratio : </strong>The click-through rate (CTR) is the ratio of the number of times your company is clicked compared to the number of times it is viewed. CTR measures the effectiveness of an advertising campaign.</div>

</div>
</div>
<!-- right sidebar-->
<div class="body_content_right" style="margin-top: 45px;">
<?php $this->renderPartial('application.modules.admin.views.statistics._sidebar',array('id'=>Yii::app()->user->id));?>
</div>
<div class="clear"></div>

