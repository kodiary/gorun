<?php

/**
 * This is the model class for table "tbl_genericseo".
 *
 * The followings are the available columns in table 'tbl_genericseo':
 * @property integer $SeoId
 * @property string $SeoTitle
 * @property string $SeoDesc
 * @property string $SeoKeywords
 * @property string $PageSlug
 * @property string $Updated
 */
class Seo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seo the static model class
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
		return 'tbl_genericseo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('SeoTitle,SeoDesc,SeoKeywords','required','on'=>'update'),
			array('SeoTitle, PageSlug, Updated', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SeoId, SeoTitle, SeoDesc, SeoKeywords, PageSlug, Updated', 'safe', 'on'=>'search'),
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
			'SeoTitle' => 'Title',
			'SeoDesc' => 'Description',
			'SeoKeywords' => 'Keywords',
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

		$criteria->compare('SeoId',$this->SeoId);
		$criteria->compare('SeoTitle',$this->SeoTitle,true);
		$criteria->compare('SeoDesc',$this->SeoDesc,true);
		$criteria->compare('SeoKeywords',$this->SeoKeywords,true);
		$criteria->compare('PageSlug',$this->pageSlug,true);
		$criteria->compare('Updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}