<?php

/**
 * This is the model class for table "tbl_events_link".
 *
 * The followings are the available columns in table 'tbl_events_link':
 * @property integer $id
 * @property integer $event_id
 * @property integer $type_id
 * @property integer $category_id
 * @property integer $profile_id
 */
class EventsLink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventsLink the static model class
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
		return 'tbl_events_link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, type_id, category_id, profile_id', 'required'),
			array('event_id, type_id, category_id, profile_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, type_id, category_id, profile_id', 'safe', 'on'=>'search'),
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
			'event_id' => 'Event',
			'type_id' => 'Event Type',
			'category_id' => 'Category',
			'profile_id' => 'Visitor Profile',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('profile_id',$this->profile_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function countEventsLinkTags($parameter,$id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = $parameter."='".$id."'";
        //$criteria->group = "'".$parameter."'";
        return count(self::model()->findAll($criteria));
    }
}