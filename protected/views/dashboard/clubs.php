<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-7 right-content profile_detail">
  <div class="col-md-12">
        <h1>YOUR CLUB</h1>
        Clubs you are member of. To add a club, simply follow them from the club page.
    </div>
    <div class="clearfix"></div>
    <hr />
<?php 
//var_dump($clubs);
foreach($clubs as $c)
{
   $club = Club::model()->findByPk($c->club_id);
    ?>
    <div class="col-md-12 ">
    <div class="clubs">
        <?php echo ucfirst($club->title);?>
        <a href="javascript:void(0)" onclick="$('#deleteclub<?php echo $club->id;?>').show('drop',{direction : 'up'}, 'slow');"><span class="glyphicon glyphicon-remove right" aria-hidden="true"></span></a>
        
        
    </div>
    <div class="col-md-12 clubs" id="deleteclub<?php echo $club->id;?>" style="display: none;">
        <div class="col-md-8">Are you sure that you want to unfollow this club?</div>
        <div class="col-md-4">
            <a href="javascript:void(0)" class="btn btn-danger" onclick="removeClub('<?php echo $club->id;?>');">Yes</a>
            <a href="javascript:void(0)" class="btn btn-info" onclick="$(this).parent().parent().hide('drop', { direction: 'up' }, 'slow');">Cancel</a>
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
        url:'<?php echo Yii::app()->request->baseUrl?>/clubs/unfollow',
        type:'post',
        data : 'clubid='+clubid,
        success:function(msg)
        {
            if(msg=='OK')
            {
                $('#deleteclub'+clubid).html('<span class="blue">Club Unfollow Successfull!</span>');
                setInterval(function(){$('#deleteclub'+clubid).parent().remove()},2000)
                //$('#deleteclub'+clubid).parent().hide('drop', { direction: 'up' }, 'slow');
                 
            }
            else if(msg =='Error')
                alert('Sorry, the club coudnot be unfollowed. Try Again');
                
        }
        
   }) 
}
</script>