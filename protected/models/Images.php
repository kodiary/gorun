<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $ImageId
 * @property string $ImageName
 * @property string $Caption
 * @property integer $NewsId
 * @property integer $ResId
 * @property integer $display_order
 */
class Images extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ImageName, Caption, NewsId', 'safe'),
			array('NewsId, ResId, display_order', 'numerical', 'integerOnly'=>true),
			array('ImageName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ImageId, ImageName, Caption, NewsId, ResId, display_order', 'safe', 'on'=>'search'),
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
			'ImageId' => 'Image',
			'ImageName' => 'Image Name',
			'Caption' => 'Caption',
			'NewsId' => 'News',
			'ResId' => 'Res',
			'display_order' => 'Display Order',
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

		$criteria->compare('ImageId',$this->ImageId);
		$criteria->compare('ImageName',$this->ImageName,true);
		$criteria->compare('Caption',$this->Caption,true);
		$criteria->compare('NewsId',$this->NewsId);
		$criteria->compare('ResId',$this->ResId);
		$criteria->compare('display_order',$this->display_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}