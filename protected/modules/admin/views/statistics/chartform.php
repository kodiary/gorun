<?php if(!$section) $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>Statistics - <span>How your listing has done since it has listed</span></h2>
<div class="line"></div>
<!-- draw google api chart-->
<form method="post" id="frmMonthlyStat">
<span>Year &nbsp;&nbsp;&nbsp;&nbsp;</span>
<select name="year" onchange="if($(this).val()!='')$('#frmMonthlyStat').submit();" class="dropdown">
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
<?php 
$month_year_list = array();

$months =CompanyViews::get_all_months_by_year($company_id,$year);

foreach($months as $val)
{
    $month_year_list[$val->month.'-'.$year] = sprintf('%02d',$val->month).'-'.$year;
}
$max_month=CompanyViews::get_max_month_by_year($company_id,$year)->max;
if(isset($_POST['year']))$month=$max_month;
?>


<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'chart-form',
    //'action'=>$this->createUrl('drawchart'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="button_a_select">
<?php echo CHtml::dropDownList('month_year_list',(int)$month.'-'.$year, $month_year_list, array('id'=>'monthly_stat','class'=>'dropdown'));
echo CHtml::hiddenField('company_id', $company_id);?>

<?php echo CHtml::submitButton('Select', array('class'=>'btn btn-info'));?>
</div>

<?php $this->endWidget(); 

if(isset($daycount)){
    $this->renderPartial('application.modules.admin.views.statistics._googlechart', array('company_id'=>$company_id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount));
}?>
</div>
</div>

<div class="right_body">
<?php $this->renderPartial('application.modules.admin.views.statistics._sidebar');?>
</div>
<div class="clear"></div>
</div>

