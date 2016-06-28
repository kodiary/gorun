<?php

/**
 * This is the model class for table "tbl_article_file".
 *
 * The followings are the available columns in table 'tbl_article_file':
 * @property integer $id
 * @property integer $article_id
 * @property string $title
 * @property string $filename
 * @property integer $file_type
 */
class ArticleFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleFile the static model class
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
		return 'tbl_article_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, title, filename, file_type', 'safe'),
			array('article_id, file_type', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article_id, title, filename, file_type', 'safe', 'on'=>'search'),
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
        'article' => array(self::BELONGS_TO, 'Articles', 'article_id'),
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
			'title' => 'Title',
			'filename' => 'Filename',
			'file_type' => 'File Type',
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
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('file_type',$this->file_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getArtilceFilesByType($article_id,$type)
    {
        $criteria=new CDbCriteria;
        $criteria->condition="article_id= $article_id AND file_type=$type";
        $result = ArticleFile::model()->findAll($criteria);
        return $result;
    }
}