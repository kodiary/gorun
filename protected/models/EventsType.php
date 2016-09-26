<?php

/**
 * This is the model class for table "tbl_events_type".
 *
 * The followings are the available columns in table 'tbl_events_type':
 * @property integer $id
 * @property string $title
 * @property integer $order_by
 */
class EventsType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventsType the static model class
	 */
     public $max;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_events_type';
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
			array('order_by', 'numerical', 'integerOnly'=>true),
            array('cat_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, order_by, cat_id', 'safe', 'on'=>'search'),
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
			'title' => 'Types',
			'order_by' => 'Order By',
            'cat_id' => 'Category',
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
		$criteria->compare('order_by',$this->order_by);
        $criteria->compare('cat_id',$this->cat_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getmaxOrder()
    {
                      
        $criteria = new CDbCriteria;
        $criteria->select='MAX(order_by) as max';
        
        return self::model()->find($criteria)->max;
        
    }
    
    public function titleName($id)
    {
       return EventsType::model()->findByAttributes(array('id'=>$id))->title; 
    }
}