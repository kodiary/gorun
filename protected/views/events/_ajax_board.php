<?php
if(count($result))
{
    ?>
    
    <tr><td>POS</td><td>NAME</td><td>DISTANCE</td><td>AV PACE</td><td>TIME</td></tr>
    <?php
    if(!isset($i))
    $i=0;
    foreach($result as $r)
    {
        $mem = Member::model()->findByPk($r->user_id);
        $i++;
        ?>
        <tr><td><?php echo $i;?></td><td><a href="<?php echo Yii::app()->request->baseUrl;?>/<?php echo $mem->username;?>"><?php echo $mem->fname.' '.$mem->lname;?></a></td><td><?php if($r->distance_tri){echo $r->distance_tri;}else echo str_replace('.',',',$r->distance);?>km </td><td>...</td><td><?php echo $r->dist_time;?></td></tr>
        <?php
    }
    ?>
    <?php
}
else
{
    ?>
    <tr><td colspan="5">No Result found.</td></tr>
    <?php
}
?>