<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.min.js"));?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/selectbox/jquery.selectBox.css"));?>
<script type="text/javascript">
$(document).ready( function() {
$("SELECT.dropdown")
.selectBox()
});
</script>
<?php if(!$section)$this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>Statistics - <span>How your listing has done since it has listed</span></h2>
<div class="line"></div>
<form method="post" id="frmDailyStat">
<span>Year &nbsp;&nbsp;&nbsp;&nbsp;</span>
<select name="year" onchange="if($(this).val()!='')$('#frmDailyStat').submit();" class="dropdown">
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

//$current_month = date("m", time());
//$current_year = date("Y", time());
$month_year_list = array();
$months =CompanyViews::get_all_months_by_year($company_id,$year);

foreach($months as $val)
{
    $month_year_list[$val->month.'-'.$year] = sprintf('%02d',$val->month).'-'.$year;
}
$max_month=CompanyViews::get_max_month_by_year($company_id,$year)->max;
?>

    <div class="button_a_select">
    <?php 
    echo CHtml::dropDownList('daystat', $max_month.'-'.$year, $month_year_list, array('id'=>'daystat','class'=>'dropdown'));
    echo CHtml::ajaxLink(
      "Select",
      array('dailystat'),
      array( // ajaxOptions
        'type' => 'POST',
        'beforeSend' => "function( request )
                         {
                           // Set up any pre-sending stuff like initializing progress indicators
                         }",
        'success' => "function( data )
                      {
                        // handle return data
                        $('#dailystat').html(data);
                      }",
        'data' => array('selected' => 'js:$("#daystat").val()', 'resId'=>$company_id)
      ),
      array( //htmlOptions
        //'href' => Yii::app()->createUrl( 'myController/ajaxRequest' ),
        'class' => 'btn btn-info'
      )
    );?>
    </div>
<?php $this->renderPartial('application.modules.admin.views.statistics._dailystat', array('company_id'=>$company_id, 'month'=>$max_month, 'year'=>$year, 'daycount'=>date("t", strtotime($year.'-'.$max_month))));?>
</div>
</div>

<div class="right_body">
<?php $this->renderPartial('application.modules.admin.views.statistics._sidebar');?>
</div>
<div class="clear"></div>
</div>