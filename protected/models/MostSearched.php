<?php

/**
 * This is the model class for table "tbl_most_searched".
 *
 * The followings are the available columns in table 'tbl_most_searched':
 * @property integer $id
 * @property integer $product_id
 * @property integer $service_id
 * @property string $date
 */
class MostSearched extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MostSearched the static model class
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
		return 'tbl_most_searched';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, service_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, service_id, date', 'safe'),
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
			'product_id' => 'Product',
			'service_id' => 'Service',
			'date' => 'Date',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getCommonSearchTopics()
    {
        $sql = "(SELECT `product_id`, `service_id`, count(*) as `productCount`
                FROM `tbl_most_searched`
                WHERE `date` between DATE_SUB(CURDATE(),INTERVAL 21 DAY) AND CURDATE() AND `product_id`<>0
                GROUP BY `product_id`
                ORDER BY `productCount` DESC
                )
                UNION
                (SELECT `product_id`, `service_id` as `service`, count(*) as `serviceCount`
                FROM `tbl_most_searched`
                WHERE `date` between DATE_SUB(CURDATE(),INTERVAL 21 DAY) AND CURDATE() AND `service_id`<>0
                GROUP BY `service_id`
                ORDER BY `serviceCount` DESC
                )
                ORDER BY `productCount` DESC
                LIMIT 10";
        
        $model = MostSearched::model()->findAllBySql($sql);
        if($model) return $model;
        else return null;
    }
}