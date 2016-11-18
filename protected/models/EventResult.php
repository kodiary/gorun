<?php

/**
 * This is the model class for table "tbl_event_result".
 *
 * The followings are the available columns in table 'tbl_event_result':
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $event_category
 * @property integer $event_type
 * @property string $dist_time
 * @property integer $dist_hour
 * @property integer $dist_min
 * @property integer $dist_sec
 * @property double $distance
 * @property integer $is_tri_swim
 * @property integer $is_tri_bike
 * @property integer $is_tri_run
 * @property integer $transition_time
 * @property string $result_date
 * @property string $distance_tri
 */
class EventResult extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventResult the static model class
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
		return 'tbl_event_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dist_time, result_date', 'required'),
			array('user_id, event_id, event_category, event_type, dist_hour, dist_min, dist_sec, is_tri_swim, is_tri_bike, is_tri_run, transition_time', 'numerical', 'integerOnly'=>true),
			array('distance', 'numerical'),
			array('distance_tri', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, event_id, event_category, event_type, dist_time, dist_hour, dist_min, dist_sec, distance, is_tri_swim, is_tri_bike, is_tri_run, transition_time, result_date, distance_tri', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'event_id' => 'Event',
			'event_category' => 'Event Category',
			'event_type' => 'Event Type',
			'dist_time' => 'Dist Time',
			'dist_hour' => 'Dist Hour',
			'dist_min' => 'Dist Min',
			'dist_sec' => 'Dist Sec',
			'distance' => 'Distance',
			'is_tri_swim' => 'Is Tri Swim',
			'is_tri_bike' => 'Is Tri Bike',
			'is_tri_run' => 'Is Tri Run',
			'transition_time' => 'Transition Time',
			'result_date' => 'Result Date',
			'distance_tri' => 'Distance Tri',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('event_category',$this->event_category);
		$criteria->compare('event_type',$this->event_type);
		$criteria->compare('dist_time',$this->dist_time,true);
		$criteria->compare('dist_hour',$this->dist_hour);
		$criteria->compare('dist_min',$this->dist_min);
		$criteria->compare('dist_sec',$this->dist_sec);
		$criteria->compare('distance',$this->distance);
		$criteria->compare('is_tri_swim',$this->is_tri_swim);
		$criteria->compare('is_tri_bike',$this->is_tri_bike);
		$criteria->compare('is_tri_run',$this->is_tri_run);
		$criteria->compare('transition_time',$this->transition_time);
		$criteria->compare('result_date',$this->result_date,true);
		$criteria->compare('distance_tri',$this->distance_tri,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}