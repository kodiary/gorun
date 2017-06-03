<?php

/**
 * This is the model class for table "tbl_specials".
 *
 * The followings are the available columns in table 'tbl_specials':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $detail
 * @property string $expiry_date
 * @property string $date_updated
 * @property integer $display_order
 * @property string $image
 * @property string $image_caption
 * @property string $filename
 * @property integer $slug
 * @property integer $status
 */
class Specials extends CActiveRecord
{
    public $maxOrder;
    public $update_image;
    //public $countspecial;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return details the static model class
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
		return 'tbl_specials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, detail, expiry_date', 'required'),
			array('id, status, display_order', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
            array('seo_title,seo_desc,seo_keywords,id','safe','on'=>'seo'),
			//array('image, filename', 'length', 'max'=>255),
			array('expiry_date, filename, update_image, image_caption, type', 'safe'),
            //array('filename', 'file', 'types'=>'pdf,doc,docx', 'maxSize'=>100*1024, 'allowEmpty'=>true,'tooLarge' => 'The file was larger than 100KB. Please upload a smaller file.'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'company_id' => 'Company Id',
			'title' => 'Special Title',
			'detail' => 'Specials Description <span class="blue">- What is on offer? Provide a description of the special - keep it short.</span>',
			'expiry_date' => 'Valid Until',
			'image' => 'Photo',
			'filename' => 'Include a file',
			'display' => 'Display Special',
			'display_order' => 'Display Order',
            'image_caption'=>'Optional Photo Comment'
		);
	}
   
    # return  the max display order value
    public function maxDisplayVal($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(display_order) AS maxOrder';
        $criteria->condition = 'company_id='.$companyId;
        $row = $this->find($criteria);
        $displayOrder = $row['maxOrder']+1;
        return $displayOrder;
    }
    
    # check for max 3 display of specials
    public function allowMax3display($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('company_id='.$companyId.' AND status=1');
        $max = Specials::model()->count($criteria);
        if($max< 3)
            return 1;//display off
        else
            return 0;//display on
    }
    
    /**
    * string filename, size 
    * return image specials
    * default thumb image
    */
    public function Image($filename, $size='thumb', $alt='')
    {
        $alt = htmlspecialchars_decode($alt);
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt);
        else
            return CHtml::image($baseUrl.'/images/specials_fallback.gif', $alt);
    }
    /**
    * return count of active specials
    */
    public function countActive()
    {
        return Specials::model()->countByAttributes(array('status'=>1));
    }
    
    public function getAllSpecials($companyId='')
    {
        $criteria  = new CDbCriteria;
        $criteria->condition = 'company_id='.$companyId;
        $criteria->order = 'display_order ASC';
        return $dataProvider = Specials::model()->findAll($criteria);
    }

    public function getAll()
    {
        $criteria = new CDbCriteria;
        $criteria->select = array('id, title');
        $criteria->order = 'title asc';
        $rests = Specials::model()->findAll($criteria);
        return CHtml::listData($rests, 'id', 'title');
    }
    
    public function createSeo($title,$desc)
    {
       $seo=array();
       $seoTile=$title." - South African Directory";

       $seoKey=$title;
       $seoKey.=", specials, directory, south africa";
       
       $seo['title']=$seoTile;
       $seo['desc']=CommonClass::getCleanData($desc,160);
       $seo['keywords']=$seoKey;
       return $seo;
    }
    
    public function getAllActiveCompanyActiveSpecials($limit="",$order="")
    {
         $criteria  = new CDbCriteria;
         $criteria->condition = 'status=1 AND expiry_date>=CURDATE()';
         $criteria->addInCondition('company_id',Company::getAllActiveCompanyForSpecials());
         if($limit!="")$criteria->limit = $limit;
         if($order!="")$criteria->order = $order;
         else $criteria->order = 'display_order ASC';
         return Specials::model()->findAll($criteria);
    }
    
    public function getCompanyActiveSpecials()
    {
        $data = Specials::model()->findAll('status=1 AND expiry_date>=CURDATE()');
        $specials=array();
        foreach($data as $val)
        {
            $specials[]=$val->company_id;
        }
        return $specials;
    }
}