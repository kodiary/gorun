<div class="submit-result-block">
        <div class="alert alert-success alert-dismissible submitMsg" role="alert" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Result submitted successfully.
        </div>
<?php 
$this->renderPartial('/events/_submit_result_form',array('m_time'=>$m_time,'race_result'=>$race_result,'tri_result'=>$tri_result));?>
<a href="javascript:void(0);" class="result_submit_red" onclick="$('.submit-result-form').toggle('slow');"><strong>YOUR RESULTS -</strong> 
<?php
$st = '';
$swim = array();
foreach($model as $m){
if(!isset($model_tri))
{
    if(!$str)
    $str = str_replace('.',',',$m->distance).'KM <strong>'.$m->dist_time.'</strong>';
    else
    $str = $str.' - '.str_replace('.',',',$m->distance).'KM <strong>'.$m->dist_time.'</strong>';
}
else{
    foreach($model_tri as $mt)
    {
        if($mt->is_tri_swim == 1)
        {
            $swim['distance'] = $mt->distance;
            $swim['time'] = $mt->dist_time;
            $swim['dist_min'] = $mt->dist_min;
            $swim['dist_hour'] = $mt->dist_hour;
            $swim['dist_sec'] = $mt->dist_sec; 
        }
        if($mt->is_tri_run == 1)
        {
            $run['distance'] = $mt->distance;
            $run['time'] = $mt->dist_time;
            $run['dist_min'] = $mt->dist_min;
            $run['dist_hour'] = $mt->dist_hour;
            $run['dist_sec'] = $mt->dist_sec; 
        }
        if($mt->is_tri_bike == 1)
        {
            $bike['distance'] = $mt->distance;
            $bike['time'] = $mt->dist_time;
            $bike['dist_min'] = $mt->dist_min;
            $bike['dist_hour'] = $mt->dist_hour;
            $bike['dist_sec'] = $mt->dist_sec; 
        }
    }
    $str = 'Swim <strong>'.$swim['time'].'</strong> - '.'Bike <strong>'.$bike['time'].'</strong> - '.'Run <strong>'.$run['time'].'</strong> - Total <strong>'.$m->dist_time.'</strong>';
}
}
echo $str;
?>
</a>
</div>