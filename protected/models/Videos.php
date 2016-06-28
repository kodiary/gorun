<?php

/**
 * This is the model class for table "tbl_videos".
 *
 * The followings are the available columns in table 'tbl_videos':
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $code
 * @property integer $display_order
 */
class Videos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Videos the static model class
	 */
     public $maxorder;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array(' title, code','required'),
			array('company_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id,display_order', 'safe',),
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
			'company_id' => 'Company',
			'title' => 'Title of your Video',
			'code' => 'YouTube Video link (Just the URL)',
            'display_order'=>'Display Order',
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
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function get_max_order($company_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select='MAX(display_order) as maxorder';
        $criteria->condition='company_id='.$company_id;
        $result= self::model()->find($criteria);
        return $result['maxorder'];
    }
}