<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property string $title
 * @property string $alt_tag
 * @property string $links
 * @property integer $opens
 * @property integer $from_month
 * @property integer $from_year
 * @property integer $to_month
 * @property integer $to_year
 * @property string $image
 * @property integer $size
 */
class Banner extends CActiveRecord
{
    public $name;
    public $email;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alt_tag, links, opens, from_month, from_year, to_month, to_year, size', 'required'),
            //array('image', 'required', 'on'=>'create'),
			array('opens, from_month, from_year, to_month, to_year, size', 'numerical', 'integerOnly'=>true),
			array('title, alt_tag, links, image', 'length', 'max'=>255),
            array('links', 'url'),
            array('name, email', 'required', 'on'=>'report'),
            array('email', 'email', 'on'=>'report'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'alt_tag' => 'Alt Tag',
			'links' => 'Links',
			'opens' => 'Opens',
			'from_month' => 'From Month',
			'from_year' => 'From Year',
			'to_month' => 'To Month',
			'to_year' => 'To Year',
			'image' => 'Image',
			'size' => 'Size',
            'name'=>'Name',
            'email'=>'Email',
		);
	}

	public function list_month()
    {
        return array(
            '01'=> 'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December'
        );
    }
    public function list_year()
    {
        $current_year = date('Y');
        $next_year = $current_year+1;
        return array(
            $current_year=>$current_year,
            $next_year=>$next_year
        );
    }

   public function countClicks($banner_id)
    {
        return BannerClicks::model()->countByAttributes(array('banner_id'=>$banner_id));
    }

    public function countViews($banner_id)
    {
        return BannerViews::model()->countByAttributes(array('banner_id'=>$banner_id));
    }
    /**
     * display random active bottom banner
     */
    public function randBottomBanner()
    {
        $curr_year = (int) Date('Y');
        $curr_month = Date('m');
        $criteria=new CDbCriteria;   
        //$criteria->addCondition('t.size=1 AND t.to_month>='.$curr_month.' AND t.to_year>='.$curr_year);
        $criteria->addCondition('t.size=1 AND ((t.to_month>='.$curr_month.' AND t.to_year='.$curr_year.') OR (t.to_year>'.$curr_year.'))');
        $criteria->order = 'rand()';
        $criteria->limit =1;
        return Banner::model()->find($criteria);
    }
    
    /**
     * display random active bottom banner
     */
    public function randSquareBanner($limit=4)
    {
        $curr_year = (int) date('Y');
        $curr_month = date('m');
        $criteria=new CDbCriteria;   
       //$criteria->addCondition('t.size=0 AND t.to_month>='.$curr_month.' AND t.to_year>='.$curr_year);
        $criteria->addCondition('t.size=0 AND ((t.to_month>='.$curr_month.' AND t.to_year='.$curr_year.') OR (t.to_year>'.$curr_year.'))');
        $criteria->order = 'rand()';
        $criteria->limit =$limit;
        return Banner::model()->findAll($criteria);
    }
    
    public function Image($filename, $alt='')
    {
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if(file_exists($basePath.'/../images/frontend/main/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/main/'.$filename, $alt);
        
    }
    //return full month name
    public function fullMonthName($month_no)
    {
        $case = $month_no;
        switch($case){
            case "01":
                return 'January';
                break;
            case "02":
                return 'February';
                break;
            case "03":
                return 'March';
                break;
            case "04":
                return 'April';
                break;
            case "05":
                return 'May';
                break;
            case "06":
                return 'June';
                break;
            case "07":
                return 'July';
                break;
            case "08":
                return 'August';
                break;
            case "09":
                return 'September';
                break;
            case "10":
                return 'October';
                break;
            case "11":
                return 'November';
                break;
            case "12":
                return 'December';
                break;
        }
    }

}