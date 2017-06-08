<?php

/**
 * This is the model class for table "tbl_resource_category".
 *
 * The followings are the available columns in table 'tbl_resource_category':
 * @property integer $id
 * @property string $title
 * @property string $member_type
 * @property integer $display_order
 * @property string $slug
 */
class ResourceCategory extends CActiveRecord
{
    public $max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResourceCategory the static model class
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
		return 'tbl_resource_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('display_order', 'numerical', 'integerOnly'=>true),
			array('title, slug', 'length', 'max'=>255),
            array('id, member_type, display_order, slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, member_type, display_order, slug', 'safe', 'on'=>'search'),
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
			'title' => 'Category',
			'member_type' => 'Visible',
			'display_order' => 'Display Order',
			'slug' => 'Slug',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('member_type',$this->member_type,true);
		$criteria->compare('display_order',$this->display_order);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getmaxOrder()
    {
        $criteria = new CDbCriteria;
        $criteria->select='MAX(display_order) as max';
        
        return self::model()->find($criteria)->max;
    }
    
    public function getCategoryByResource($id)
    {
        return self::model()->findByPk($id);
    }
    
    public function getResourceCategoryByMemberType($memberId)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = "member_type REGEXP '({$memberId},)|{$memberId}$'";
        $criteria->order = "title ASC";
        return self::model()->findAll($criteria);
    }
}