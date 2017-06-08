<?php

/**
 * This is the model class for table "tbl_tags".
 *
 * The followings are the available columns in table 'tbl_tags':
 * @property integer $id
 * @property string $tag
 */
class Tags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tags the static model class
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
		return 'tbl_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag', 'required'),
			array('tag', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tag', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag' => 'Topic',
		);
	}
    
    // used for checkbox, dropdownlist
    public function getAllTags()
    {
        return CHtml::listData(Tags::model()->findAll(array('order'=>'tag')), 'id', 'tag');
    }
    
    public function tagInfo($tag_id, $select='*')
    {
        $criteria = new CDbCriteria;
        $criteria->select=$select;
        $criteria->condition='id='.$tag_id;
        return Tags::model()->find($criteria);
    }
    
    public function tagName($id)
    {
        return Tags::model()->findByPk($id)->tag;
    }
    
    //return array
    public function fetchAllTags($order="")
    {
        if($order)return Tags::model()->findAll(array('order'=>$order));
        else return Tags::model()->findAll();
    }
    
    public function getIdBySlug($slug)
    {
        return Tags::model()->findByAttributes(array('slug'=>$slug))->id;
    }
}