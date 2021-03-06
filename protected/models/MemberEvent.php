<?php

/**
 * This is the model class for table "tbl_member_event".
 *
 * The followings are the available columns in table 'tbl_member_event':
 * @property integer $id
 * @property integer $member_id
 * @property integer $event_id
 * @property integer $going
 * @property integer $event_type
 * @property integer $event_time
 */
class MemberEvent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberEvent the static model class
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
		return 'tbl_member_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, event_id, event_type, event_date', 'required'),
			array('member_id, event_id, going, event_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, event_id, going, event_type, event_date', 'safe', 'on'=>'search'),
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
            'member'=>array(self::BELONGS_TO,'Member','member_id'),
            'event'=>array(self::BELONGS_TO,'Events','event_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'event_id' => 'Event',
			'going' => 'Going',
			'event_type' => 'Event Type',
			'event_time' => 'Event Time',
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
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('going',$this->going);
		$criteria->compare('event_type',$this->event_type);
		$criteria->compare('event_time',$this->event_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}