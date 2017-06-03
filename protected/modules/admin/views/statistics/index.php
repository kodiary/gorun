<?php $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="col-md-8">
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
$months=CompanyViews::get_all_months_by_year($_GET['id'],$year);
if($months)
{
    foreach($months as $val)
    {
    ?>
    <tr>
        <td><?php echo sprintf('%02d',$val->month).'-'.$year?></td>
        <td><?php $views = CompanyViews::monthly_report_by_company($_GET['id'], $val->month, $year)->count;
        echo $views? $views: 0;?></td>
        <td><?php $clicks = CompanyClicks::monthly_report_by_company($_GET['id'], $val->month, $year)->count;
        echo $clicks? $clicks: 0;?></td>
        <td><?php if($views!=0) echo number_format(($clicks/$views)*100, 2); else echo '0'?>%</td>
    </tr>
<?php 
    }
}
?>

</table>
</div>
</div>
</div>


<!-- right sidebar-->
<div class="col-md-4">
<?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>
