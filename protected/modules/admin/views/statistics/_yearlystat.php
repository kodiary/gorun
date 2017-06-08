<?php if(!$section)$this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">
<h2>Statistics - <span>How your listing has done since it has listed</span></h2>
<div class="line"></div>
<!-- monthly report-->
<div id="monthly_stat">
<table cellpadding="5" border="0" class="table table-bordered table-striped">
<tr>
    <th>Year</th>
    <th>Advert Viewed</th>
    <th>Contact Clicked</th>
    <th>CTR - Ratio</th>
</tr>
<?php
foreach($views as $view)
{
    $clicks=CompanyClicks::yearly_report_by_company($company_id,$view->year);
  ?>
  <tr>
  <td><?php echo $view->year;?></td>
  <td><?php echo $view->count;?></td>
  <td><?php echo $clicks->count;?></td>
  <td><?php if($view->count!=0) echo number_format(($clicks->count/$view->count)*100, 2); else echo '0'?>%</td>
  </tr>
  <?php 
}
?>
</table>
</div>
</div>
</div>
<!-- right sidebar-->
<div class="col-md-4">
<?php $this->renderPartial('application.modules.admin.views.statistics._sidebar');?>
</div>
<div class="clear"></div>
</div>