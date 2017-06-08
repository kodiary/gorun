<?php

/**
 * This is the model class for table "tbl_featured".
 *
 * The followings are the available columns in table 'tbl_featured':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $detail
 * @property string $image
 * @property string $date_updated
 * @property integer $display_order
 * @property string $slug
 * @property integer $status
 */
class Featured extends CActiveRecord
{
    public $maxOrder;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Featured the static model class
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
		return 'tbl_featured';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, detail', 'required'),
			array('company_id, display_order, status', 'numerical', 'integerOnly'=>true),
			array('title, image', 'length', 'max'=>255),
			array('image, date_updated, display_order, slug, status', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, title, detail, image, date_updated, display_order, status', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'title' => 'Product/Service title',
			'detail' => 'Short description of the product or service',
			'image' => 'Image',
			'date_updated' => 'Date Updated',
			'display_order' => 'Display Order',
            'slug' => 'Slug',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('display_order',$this->display_order);
        $criteria->compare('slug',$this->slug,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
    
    # check for max 3 display of Featured
    public function allowMax5display($companyId)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('company_id='.$companyId.' AND status=1');
        $max = Featured::model()->count($criteria);
        if($max<5)
            return 1;//display off
        else
            return 0;//display on
    }
    
    /**
    * string filename, size 
    * return image Featured
    * default thumb image
    */
    public function Image($filename, $size='thumb', $alt='')
    {
        $alt = htmlspecialchars_decode($alt);
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if(file_exists($basePath.'/../images/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/'.$size.'/'.$filename, $alt);
        else
            return CHtml::image($baseUrl.'/images/specials_fallback.gif', $alt);
    }
    /**
    * return count of active featured
    */
    public function countActive()
    {
        return Featured::model()->countByAttributes(array('status'=>1));
    }
    
    public function getAllFeatured($companyId='')
    {
        /*if($companyId)
            $RESID = $companyId;
        else
            $RESID = Yii::app()->user->id;*/
        $criteria  = new CDbCriteria;
        $criteria->condition = 'company_id='.$companyId;
        $criteria->order = 'display_order ASC';
        return $dataProvider = Featured::model()->findAll($criteria);
    }
}