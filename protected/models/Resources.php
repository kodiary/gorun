<?php

/**
 * This is the model class for table "tbl_resources".
 *
 * The followings are the available columns in table 'tbl_resources':
 * @property integer $id
 * @property integer $cat_id
 * @property string $title
 * @property string $filename
 * @property string $date_added
 * @property string $date_updated
 * @property string $slug
 */
class Resources extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resources the static model class
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
		return 'tbl_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, title, filename', 'required'),
			array('cat_id', 'numerical', 'integerOnly'=>true),
			array('title, filename, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cat_id, title, filename, $date_added, $date_updated, slug', 'safe', 'on'=>'search'),
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
			'cat_id' => 'Category',
			'title' => 'Title',
			'filename' => 'Document',
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
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getAvailableCategories()
    {
        $criteria = new CDbCriteria;
        $criteria->select = "cat_id";
        $criteria->group = "cat_id";
        return self::model()->findAll($criteria);
    }
    
    public function getResourceByCategory($cat_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = "cat_id = '".$cat_id."'";
        $criteria->order = "title ASC";
        return self::model()->findAll($criteria);
    }

    public function getResourceByCategorySlug($cat_slug)
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_resource_category ON tbl_resource_category.id = t.cat_id';
        $criteria->condition = "tbl_resource_category.slug = '".$cat_slug."'";
        $criteria->order = "title ASC";
        return self::model()->findAll($criteria);
    }
    
    public function countResourceByCategory($cat_id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'cat_id='.$cat_id;
        return self::model()->count($criteria);
    }
}