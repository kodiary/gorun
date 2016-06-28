<?php

/**
 * This is the model class for table "tbl_background_banner".
 *
 * The followings are the available columns in table 'tbl_background_banner':
 * @property integer $id
 * @property string $image
 * @property string $link
 * @property integer $target
 * @property integer $visibility
 * @property intreger $clicks
 * @property string $color
 */
class BackgroundBanner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BackgroundBanner the static model class
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
		return 'tbl_background_banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image', 'required'),
            array('link', 'url','defaultScheme'=>'http'),
			// Please remove those attributes that should not be searched.
			array('id,link, target, visibility,clicks,color', 'safe'),
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
			'image' => 'Image',
			'link' => 'Link',
			'target' => 'Opens',
			'visibility' => 'Visibility',
            'color' => 'Background Color',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('target',$this->target);
		$criteria->compare('visibility',$this->visibility);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getActiveBanner()
    {
        $criteria= new CDbCriteria;
        $criteria->condition='visibility=1';
        $criteria->order='id desc';
        $criteria->limit=1;
        $banner=self::model()->find($criteria);
        return $banner;
    }
}