<!--<script src="<?php echo Yii::app()->baseUrl.'/js/float-object.js'?>"></script>-->
<script type="text/javascript">
var scrolladY;
    var windowY;

    $(document).ready(function ($) {
       scrolladY = $("#floatingDiv").offset().top;

        $(window).scroll(function () {
            if ($.browser.msie) {
                windowY = $(window).scrollTop();
            }
            else {
                windowY = $(window).attr("scrollY");
            }

            if (windowY > scrolladY) {
                var offset = windowY - scrolladY;
                $("#floatingDiv").css("margin-top", offset);
            }
            else {
                $("#floatingDiv").css("margin-top", 0);
            }
        });
        
    });
</script>
<div id="floatingDiv" class="floatingSideNotice">
<div class="innerBox">

<p>    Remember to <span class="bold">save</span> after you have made any changes.</p>
<p> <a href="javascript:void(0);" onclick="$('.update-company-form').submit();" class="btn btn-primary btn-large">Save Changes</a></p>

</div>   
<div class="botArrowSideNotice"></div>
</div>