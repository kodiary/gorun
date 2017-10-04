<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-7 right-content profile_detail">
  <div class="col-md-12">
        <h1>YOUR ATHLETES</h1>
        All your athletes. Listed in alphabetical order of surname.
    </div>
    <div class="clearfix"></div>
    <hr />
<?php 
//var_dump($clubs);
foreach($members as $member)
{
   //echo "<pre>";
   //var_dump($member);die();
   //$member = Member::model()->findByPk($c->follower_id);
    ?>
    <div class="white" style="width: 49%;float:left;margin-bottom:5px;margin-right:5px;border-radius:5px;" title="<?php echo $offset;?>">
    
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
            <a href="javascript:void(0)" onclick="$('#deleteclub<?php echo $member->follower_id;?>').show('drop',{direction : 'up'}, 'slow');" style="background-color:#eb0067; display:inline-block;color:#fff;padding:3px 5px; font-weight:700;"><span aria-hidden="true">UNFOLLOW</span></a>
            
            <div class="blue race-reviews"><?php echo Review::model()->resultCountbyUser($member->member_id);?> RACE REVIEWS</div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 clubs" id="deleteclub<?php echo $member->follower_id;?>" style="display: none;">
        <div class="col-md-7">Are you sure that you want to unfollow this athlete?</div>
        <div class="col-md-5">
            <a href="javascript:void(0)" class="btn btn-danger" style="display: inline;" onclick="removeClub('<?php echo $member->follower_id;?>');">Yes</a>
            <a href="javascript:void(0)" class="btn btn-info" style="display: inline;" onclick="$(this).parent().parent().hide('drop', { direction: 'up' }, 'slow');"> X </a>
        </div>
    </div>  
    </div>
    
    
<?php
}
?>
 <hr />
</div>
<div class="clearfix"></div>

<script>
function removeClub(clubid)
{
   $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl?>/dashboard/unfollow',
        type:'post',
        data : 'follower_id='+clubid,
        success:function(msg)
        {
            if(msg=='OK')
            {
                $('#deleteclub'+clubid).html('<span class="blue">Athlete Unfollow Successfull!</span>');
                setInterval(function(){$('#deleteclub'+clubid).parent().remove()},2000)
                //$('#deleteclub'+clubid).parent().hide('drop', { direction: 'up' }, 'slow');
                 
            }
            else if(msg =='Error')
                alert('Sorry, the Athlete coudnot be unfollowed. Try Again');
                
        }
        
   }) 
}
</script>