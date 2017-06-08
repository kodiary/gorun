<?php
$i=0;
foreach($models as $member)
{
    $i++;
?>
    <div class="white" style="width: 49%;float:<?php if($i%2==1){?>left<?php }else{?>right<?php }?>;margin-bottom:15px;border-radius:5px;" title="<?php echo $offset;?>">
    
        <?php
            if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->member['logo'])&&$member->member['logo']!='')
            {
                $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->member['logo'];
            }
            else
            {
                $img_url=Yii::app()->baseUrl.'/images/blue.png';    
            }
         ?>
        <div class="col-md-3">
            <img class="img-circle" src="<?php echo $img_url;?>"/>
        </div>
        <div class="col-md-9">
            <div class="Members_name"><a href="<?php echo Yii::app()->baseUrl."/".$member->member['username'];?>"><?php echo ucfirst($member->member['fname']." ".$member->member['lname']);?></a></div>
            <span class="results"><?php echo EventResult::model()->resultCountbyUser($member->member_id);?> Results</span>
            <div class="blue race-reviews"><?php echo Review::model()->resultCountbyUser($member->member_id);?> RACE REVIEWS</div>
        </div>
        <div class="clearfix"></div>
    
    </div>
    
<?php
}


