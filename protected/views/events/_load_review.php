<?php
if(count($all_review)){
                        $cou=0;
                        foreach($all_review as $ar)
                        {
                            $cou++;
                            if($cou==7)
                            break;
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
                                <?php
                                $pictures = $pics->findAllByAttributes(['review_id'=>$ar->id]);
                                if(count($pictures)){
                                ?>
                                <p>
                                <?php
                                foreach($pictures as $p)
                                {
                                    ?>
                                    <div class="review-pic-list">
                                        <img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/thumb/<?php echo $p->picture;?>" />
                                    </div>
                                    <?php
                                }
                                ?>
                                </p>
                                <?php } ?>
                                </div>
                            </div>
                            <?php
                        }
                        
                        ?>
                        <div class="clearfix"></div>
                        <?php }?>