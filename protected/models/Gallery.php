<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property string $name
 * @property string $caption
 * @property integer $company_id
 * @property integer $display_order
 */
class Gallery extends CActiveRecord
{
    public $maxOrder,$count;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gallery the static model class
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
		return 'tbl_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('company_id, display_order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
            array('caption,company_id,display_order','safe'),
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
			'id' => 'Image',
			'name' => '',
			'caption' => 'Optional Photo Comment',
			'company_id' => '',
			'display_order' => 'Display Order',
		);
	}
    
    public function getMaxDisplayOrder($parent)
    {
        $criteria=new CDbCriteria;
        $criteria->select='max(display_order) AS maxOrder';
        $criteria->condition='company_id = '.$parent;
        $row = $this->find($criteria);
        $displayOrder = $row['maxOrder'];
        return $displayOrder;
        
    }
     public function getTotalImages($parent)
    {
        $criteria=new CDbCriteria;
        $criteria->select='count(*) AS count';
        $criteria->condition='company_id = '.$parent;
        $row = $this->find($criteria);
        $count = $row['count'];
        return $count;
        
    }
    public function findGalleryCountByCompany($parent)
    {
        return self::model()->count('company_id='.$parent);
    }
}