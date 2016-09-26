<?php

/**
 * This is the model class for table "tbl_events_time".
 *
 * The followings are the available columns in table 'tbl_events_time':
 * @property integer $id
 * @property integer $event_id
 * @property string $on_date
 * @property string $from
 * @property string $to
 */
class EventsTime extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventsTime the static model class
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
		return 'tbl_events_time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, event_from_hour, event_from_min', 'required'),
			array('event_id', 'numerical', 'integerOnly'=>true),
			array('event_from_hour, event_from_min, event_cost', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, distance1,distance2, distance_swim_1, distance_swim_2, distance_run_1, distance_run_2, distance_bike_1, distance_bike_2, event_from_hour, event_from_min, event_cost', 'safe', 'on'=>'search'),
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
			'distance1' => 'Distance',
            'distance2' => 'Distance',
            'distance_swim_1' => 'Swim',
            'distance_swim_2' => 'Swim',
            'distance_run_1' => 'Run',
            'distance_run_2' => 'Run',
            'distance_bike_1' => 'Bike',
            'distance_bike_2' => 'Bike',
			'event_from_hour' => 'Start Time',
            'event_from_min' => 'Start Time',
			'event_cost' => 'Cost',
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
		$criteria->compare('distance1',$this->distance1,true);
        $criteria->compare('distance2',$this->distance2,true);
        $criteria->compare('distance_swim_1',$this->distance_swim_1,true);
        $criteria->compare('distance_swim_2',$this->distance_swim_2,true);
        $criteria->compare('distance_run_1',$this->distance_run_1,true);
        $criteria->compare('distance_run_2',$this->distance_run_2,true);
        $criteria->compare('distance_bike_1',$this->distance_bike_1,true);
        $criteria->compare('distance_bike_2',$this->distance_bike_2,true);
		$criteria->compare('event_from_hour',$this->event_from_hour,true);
        $criteria->compare('event_from_min',$this->event_from_min,true);
		$criteria->compare('event_cost',$this->event_cost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
     public function check_event_time_in_db($id,$on_date)
     {
        $check=EventsTime::model()->findAllByAttributes(array('event_id'=>$id,'on_date'=>$on_date));
        if($check)
            return true;
        else
            return false;
     }
}