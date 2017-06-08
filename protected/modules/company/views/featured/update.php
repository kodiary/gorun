<div class="body_content_left restaurant_menus_wrapper">
    
    <div class="special_blocks">
    <div class="active_on_of">
    	<div class="left"><div class="vert">Display Special</div></div>
        <div class="mdl">
        <div id="switch">
            <p class="field switch">
       <label class="cb-enable <?php if($model->status==1) echo 'selected';?>"><span>On</span></label>
        <label class="cb-disable <?php if($model->status==0) echo 'selected';?>"><span>Off</span></label>
        <input type="checkbox" id="display" class="checkbox" name="display" />
    </p>
            </div>
        </div>
        <div class="right"><div class="vert">Turn special ON or OFF from display</div></div>
        <div class="clear"></div>
    </div>
    </div>
    
    <?php $this->renderPartial('application.modules.admin.views.featured._form',array(
            'model'=>$model)
    ); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('application.modules.admin.views.featured._sidebar');?>
</div>
<div class="clear"></div>

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
    $(".cb-enable").click(function(){
        $(".alert").hide();
        var parent = $(this).parents('.switch');
        $('.cb-disable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
        $.ajax({
            url: '<?php echo $this->createUrl("displayOnOff", array("id"=>$model->id, "switch"=>1))?>',
            success: function(data) {
            $('.special_blocks').prepend(data);
            }
        });
    });
    
    $(".cb-disable").click(function(){
        $(".alert").hide();
        var parent = $(this).parents('.switch');
        $('.cb-enable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
        $.ajax({
            url: '<?php echo $this->createUrl("displayOnOff", array("id"=>$model->id, "switch"=>0))?>',
            success: function(data) {
            $('.special_blocks').prepend(data);
            }
        });
    });    
    
    $("a.close").live('click', function(){
        $("div.alert").hide('slow');
    });
    
  });
/*]]>*/
</script>