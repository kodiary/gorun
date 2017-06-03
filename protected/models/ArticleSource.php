<?php

/**
 * This is the model class for table "tbl_article_source".
 *
 * The followings are the available columns in table 'tbl_article_source':
 * @property integer $id
 * @property integer $article_id
 * @property string $source_name
 * @property string $source_link
 */
class ArticleSource extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleSource the static model class
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
		return 'tbl_article_source';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, source_name, source_link', 'safe'),
			array('article_id', 'numerical', 'integerOnly'=>true),
			array('source_name, source_link', 'length', 'max'=>255),
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
			'article_id' => 'Article',
			'source_name' => 'Source Name',
			'source_link' => 'Source Link',
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
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('source_name',$this->source_name,true);
		$criteria->compare('source_link',$this->source_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}