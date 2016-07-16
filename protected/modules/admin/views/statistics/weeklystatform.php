<?php if(!$section)$this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">
<h2>Statistics - <span>How your listing has done since it has listed</span></h2>
<div class="line"></div>
<form method="post" id="frmWeeklyStat">
<span>Year &nbsp;&nbsp;&nbsp;&nbsp;</span>
<select name="year" onchange="if($(this).val()!='')$('#frmWeeklyStat').submit();" class="dropdown">
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
$week_year_list = array();
$week_number=CompanyViews::get_max_week_by_year($company_id,$year)->max;
//if($year==date('Y'))$week_number = date('W', time());
$weeks =CompanyViews::get_all_weeks_by_year($company_id,$year);

foreach($weeks as $val)
{
    $week_year_list[($val->week).'-'.$year] = 'w'.$val->week.'-'.$year;
}
?>


    <div class="button_a_select">
    <?php 
    echo CHtml::dropDownList('weeklist', $week_number.'-'.$year, $week_year_list, array('id'=>'weeklist','class'=>'dropdown'));
    echo CHtml::ajaxLink(
      "Select",
      array('weeklystat'),
      array( // ajaxOptions
        'type' => 'POST',
        'beforeSend' => "function(request)
                         {
                           // Set up any pre-sending stuff like initializing progress indicators
                         }",
        'success' => "function( data )
                      {
                        // handle return data
                        $('#weeklystat').html(data);
                      }",
        'data' => array('selected' => 'js:$("#weeklist").val()', 'resId'=>$company_id)
      ),
      array( //htmlOptions
        //'href' => Yii::app()->createUrl( 'myController/ajaxRequest' ),
        'class' => 'btn btn-info'
      )
    );?>
    </div>
    <div id="weeklystat">
    <?php 
    $this->renderPartial('application.modules.admin.views.statistics._weeklystat', array('company_id'=>$company_id, 'week'=>$week_number, 'year'=>$year));?>
    </div>
</div>
</div>


<div class="col-md-4">
<?php $this->renderPartial('application.modules.admin.views.statistics._sidebar');?>
</div>
<div class="clear"></div>


</div>