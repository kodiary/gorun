<h2>Club finder</h2>
            <div class="filter">
                <div class="fil-group">
                <a href="javascript:void(0)" class="fil">
                Club type
                 <span class="fa fa-sort"></span>
                </a>
                <ul class="option">
                    <li><a href="javascript:void(0);">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                </ul>
                </div>
                <div class="fil-group">
                    <a href="javascript:void(0)" class="fil">All Provinces <span class="fa fa-sort"></span></a>
                    <ul class="option">
                    <?php $provinces = Province::model()->findAll();
                        foreach($provinces as $province){?>
                            <option value="<?php echo $province->id;?>"><?php echo $province->name;?></option>
                    <?php }?>
                    </ul>
                </div>
      
                <div class="gap"></div>
                <a href="javascript:void(0)" class="btn btn-inverse btn-lg">Search</a>
            </div>
            <a href="#" class="calendar-view">Calendar View &nbsp; <span class="fa fa-calendar"></span></a>
            <a href="<?php echo Yii::app()->request->baseUrl;?>/clubs" class="submit-event">Add your Club &nbsp; <span class="fa fa-plus"></span></a>