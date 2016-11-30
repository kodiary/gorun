<?php
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
                            <a href="javascript:void(0)" class="show_review">
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
                            <?php
                        }
                        
                        ?>
                        <div class="clearfix"></div>