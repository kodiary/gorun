<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company));?>
<div class="restaurant_menus_wrapper">
<div class="div600">

<div class="special_blocks">
<div class="active_on_of">
	<div class="left"><div class="vert">Display Item</div></div>
    <div class="mdl">
    <div id="switch">
        <p class="field switch">
            <label class="cb-enable cb-on <?php if($model->status==1) echo 'selected';?>"><span>On</span></label>
            <label class="cb-disable cb-off <?php if($model->status==0) echo 'selected';?>"><span>Off</span></label>
            <input type="checkbox" id="display" class="checkbox" name="display" />
        </p>
        </div>
    </div>
    <div class="right"><div class="vert">Turn special ON or OFF from display</div></div>
    <div class="clear"></div>
</div>
</div>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>

<?php $this->renderPartial('_sidebar');?>
<div class="clear"></div>
</div>

<script type="text/javascript">
/*<![CDATA[*/
$(document).ready(function() {
    $('.cancel_button').live('click', function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
    });
   
    //display on off
    $(".cb-on").click(function(){
        var parent = $(this).parents('.switch');
        
        $('.cb-off',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
        $.ajax({
            url: '<?php echo $this->createUrl("displayOnOff", array("id"=>$model->id, "switch"=>1))?>',
            success: function(data) {
            $('.special_blocks').prepend(data);
            $('.alert').slideUp(2500);
            }
        });
    });
    
    $(".cb-off").click(function(){
        var parent = $(this).parents('.switch');
        $('.cb-on',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
        $.ajax({
            url: '<?php echo $this->createUrl("displayOnOff", array("id"=>$model->id, "switch"=>0))?>',
            success: function(data) {
            $('.special_blocks').prepend(data);
            $('.alert').slideUp(2500);
            }
        });
    });    
    
    $("a.close").live('click', function(){
        $("div.alert").hide('slow');
    });   
});
/*]]>*/
</script>