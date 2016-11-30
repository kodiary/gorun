
<div class="row">
<div class="extra_border">
                    <div class="rating-block">
                        
                        <div class="col-md-5">
                            <?php
                            $rate_sum = $average->rate_sum;
                            $rate_count = $average->rate_count;
                            if($rate_count==0)
                            {
                                $rating=0;
                            }
                            else
                            {
                                $rating = $rate_sum/$rate_count;
                            }
                            //$rating = $average->rate_sum;
                            $rate_int = (int)$rating;
                            $decimal = $rating - $rate_int;
                            $review_count = $rate_count;
                            
                            $review_count = number_format($review_count);
                            ?>
                            <div id="stars-default2">
                                <?php
                                    for($i=1;$i<=5;$i++)
                                    {
                                        if($i<=$rate_int)
                                        {
                                            ?>
                                            <span class="fa fa-star" style="font-size: 3.5em; color: rgb(3, 147, 217); cursor: pointer;"></span>
                                            <?php
                                        }
                                        else
                                        {
                                            if($decimal>=0.5)
                                            {
                                               ?>
                                               <span class="fa fa-star-half-empty" style="font-size: 3.5em; color: rgb(3, 147, 217); cursor: pointer;"></span>
                                               <?php 
                                               $decimal = 0;
                                            }
                                            else
                                            {
                                                ?>
                                                <span class="fa fa-star" style="font-size: 3.5em; color: rgb(215, 215, 215); cursor: pointer;"></span>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7 review-message">
                        <?php
                        $rating = number_format((float)$rating, 2, '.', ''); 
                        ?>
                            Average Rating <strong><?php echo str_replace('.',',',$rating);?></strong> from <strong><?php echo $review_count;?></strong> Review<?php if($review_count!=1){?>s<?php }?>
                            <br />
                            <a href="javascript:void(0)" class="edit_review" <?php if(Yii::app()->user->isGuest){?>data-toggle="modal" data-target="#loginModal"<?php }else{?> onclick="$('.your_review').toggle('slow');"<?php }?>>RATE THIS RACE</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="your_review" style="display: none;">
                        <div class="col-md-12">
                           <div class="col-md-12">
                               <strong class="review-title">YOUR RACE REVIEW</strong>
                               <span class="blue">Tell us about your race experience or post a personal performance review</span>
                               <textarea class="form-control review_text"><?php echo $review->review;?></textarea> 
                           </div> 
                        </div>
                        <div class="clearfix"></div>
                        <div class="five-start-block">
                            <?php
                            $my_rating = $review->rate; 
                            if(!$my_rating)
                            $my_rating = 0;
                            ?>
                            <input type="hidden" class="rate_val" value="<?php echo $review->rate;?>" />
                            <div class="col-md-4"><span class="rating-title">YOUR RATING</span></div>
                            <div class="col-md-6"><div id="stars-default"><input type="hidden" name="rating"/></div></div>
                            <div class="col-md-2"><span class="rating-title"><?php echo $my_rating;?> STARS</span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="review-photo">
                                    <strong class="review-title">PHOTOS (Optional)</strong>
                                    <span class="blue">Did you get any great photos? Drag photos onto the block below to upload.</span>
                                    <!--<div id="dropzone">
                        
                                            	<a href="javascript:void(0)" class="qq-upload-button btn btn-black uploadControl" id="<?php echo isset($id)?$id:'0';?>" style="font-weight: bold;"><span class="fa fa-picture-o"></span>Upload Image</a>
                                            
                                    </div>
                                    <div id="review_photos"></div>-->
                                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/gallery/dropzone?type=review" class="dropzone" id="my-dropzone">
					                </form>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="five-start-block submit-review-block">
                            <div class="col-md-4"><a href="#" class="delete-review pushleft">Delete Review</a></div>
                            <div class="col-md-4 centerpush"><a href="javascript:void(0)" class="submit-review">Submit Review</a></div>
                            <div class="col-md-4"><a href="#" class="cancel-review pushright">Cancel</a></div>
                            <div class="clearfix"></div>
                        </div>
                        
                        
                    </div>
                    </div>
                    <?php if(count($all_review)){?>
                    <div class="all_review row">
                        <div class="all-review">
                        <?php
                        $cou=0;
                        foreach($all_review as $ar)
                        {
                            $cou++;
                            if($cou==7){
                            break;
                            }
                            if($cou==1)
                            {
                                ?>
                                <input type="hidden" class="event_id" value="<?php echo $ar->event_id;?>" />
                                <?php
                            }
                            $mem = $members->findByPk($ar->user_id);
                            $rr = $race_result->findAllByAttributes(array('user_id'=>$ar->user_id,'event_id'=>$ar->event_id));
                            $rating = $ar->rate;
                            $rate_int = (int)$rating;
                            $decimal = $rating - $rate_int;
                            $str = '';
                            for($i=1;$i<=5;$i++)
                                                {
                                                    if($i<=$rate_int)
                                                    {
                                                        $str = $str.'<span class="fa fa-star" style="font-size: 1em; color: rgb(3, 147, 217); cursor: pointer;"></span>';
                                                        
                                                    }
                                                    else
                                                    {
                                                        if($decimal>=0.5)
                                                        {
                                                           $str = $str.'<span class="fa fa-star-half-empty" style="font-size: 1em; color: rgb(3, 147, 217); cursor: pointer;"></span>';
                                                           
                                                           $decimal = 0;
                                                        }
                                                        else
                                                        {
                                                           $str =$str.'<span class="fa fa-star" style="font-size: 1em; color: rgb(215, 215, 215); cursor: pointer;"></span>';
                                                            
                                                        }
                                                    }
                                                }
                            ?>
                            <div class="col-md-6">
                            <a href="javascript:void(0)" id="hidden<?php echo $ar->id;?>" class="show_review" onclick="showReview($(this),<?php echo $ar->id;?>)">
                                <div class="all_review_list">
                                    <div class="review-list-img"><img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php if($mem->logo){?>frontend/thumb/<?php echo $mem->logo;?><?php }else{?>blue.png<?php }?>"/></div>
                                    <div class="review-list-txt">
                                        <?php echo $mem->fname.' '.$mem->lname;?>
                                        <br />
                                        <div class="black-result-fix">
                                        <?php
                                        if(count($rr))
                                        {
                                            foreach($rr as $r)
                                            {
                                                ?>
                                                <span class="black-result"><?php if($r->distance_tri)echo $r->distance_tri.'km';else echo $r->distance.'km';?> <strong><?php echo $r->dist_time;?></strong></span>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <strong><em>No result submitted</em></strong>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                        
                                        <div id="stars-default2" style="padding-top: 0;">
                                            <?php
                                                echo $str;
                                            ?>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div> 
                            </a>                           
                            </div>
                            <div class="col-md-12 hidden<?php echo $ar->id;?>" style="display: none;">
                                <div class="review-detail">
                                <p><?php echo str_replace('1em','2em',$str);?></p>
                                <p>
                                <?php echo $ar->review;?>
                                </p>
                                <p>
                                    <span class="blue memname"><?php echo ucfirst($mem->fname).' '.ucfirst($mem->lname);?></span>
                                    <br />
                                    Submitted: <?php echo str_replace('-','/',$ar->review_date);?> at <?php echo $ar->review_time;?>
                                </p>
                                </div>
                            </div>
                            <?php
                        }
                        
                        ?>
                        <div class="clearfix"></div>
                        </div>
                        <?php
                        if(count($all_review)>6)
                        {
                            ?>
                            <input type="hidden" class="offset" value="6" />
                            <div class="col-md-12">
                            <a href="javascript:void(0)" class="btn btn-default load-more-review"><span class="lefter">Load More</span> <span class="righter fa fa-sort-desc"></span></a>
                            </div>
                            <div class="clearfix"></div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php }?>
                    
                </div>
                <script type="text/javascript">
                function showReview($this,id){
                    var check = removeGrey($this);
                    
                        if(check)
                        {
                            // alert('test');
                             $this.find('.all_review_list').toggleClass('makeGrey');
                             $('.hidden'+id).toggle('slow');
                        }
                       
                    }
                    function hideReview(id)
                    {
                        
                        $('.'+id).hide('slow');
                        $('#'+id).find('.all_review_list').removeClass('makeGrey');
                    }
                    function removeGrey($this)
                    {
                        //alert('test');
                        var count = 0;
                        var valid=0;
                        $('.makeGrey').each(function(){
                            count++;
                            
                            //alert($(this).parent().attr('id'));
                            if($this.attr('id') != $(this).parent().attr('id')){
                            hideReview($(this).parent().attr('id'));
                            }
                            if (count==$('.makeGrey').length){valid=1;}
                        });
                        if(valid)
                        return true;
                        if(!$('.makeGrey').length){
                        return true;
                        }
                        
                    }
                    $(function(){
                    $('.load-more-review').click(function(){
                       var offset = $('.offset').val();
                       $('.offset').val(parseInt(offset)+6);
                       $.ajax({
                        url:'<?php echo Yii::app()->request->baseUrl;?>/events/loadReview',
                        data:'offset='+offset+'&event_id='+$('.event_id').val(),
                        type:'post',
                        success:function(res){
                            $('.all-review').append(res);
                        }
                       }); 
                    });
                })
                </script>