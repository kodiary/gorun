<div class="submit-result-block">
        <div class="alert alert-success alert-dismissible submitMsg" role="alert" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Result submitted successfully.
        </div>
            <?php $this->renderPartial('/events/_submit_result_form',array('m_time'=>$m_time,'race_result'=>$race_result,'tri_result'=>$tri_result));?>
            <a href="javascript:void(0);" class="result_submit_black" <?php if(Yii::app()->user->isGuest){?>data-toggle="modal" data-target="#loginModal"<?php }else{?> onclick="$('.submit-result-form').toggle('slow');"<?php }?> >Submit your result</a>
        </div>