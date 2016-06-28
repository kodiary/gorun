<?php

/**
 * This is the model class for table "tbl_associations".
 *
 * The followings are the available columns in table 'tbl_associations':
 * @property integer $Id
 * @property string $AssName
 * @property string $website
 * @property string $assDesc
 * @property string $assLogo
 */
class Associations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Associations the static model class
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
		return 'tbl_associations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('ass_name', 'required'),
			array('ass_name', 'length', 'max'=>100),
            array('ass_logo', 'file', 'types'=>'jpg,gif,png', 'maxSize'=>100*1024, 'allowEmpty'=>true,'tooLarge' => 'The file was larger than 100KB. Please upload a smaller file.'),
            array('ass_logo, slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ass_name, ass_logo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ass_name' => 'Association Name',
			'ass_logo' => 'Association Logo',
			'slug' => 'Slug',
		);
	}
    public function associationVal($id)
    {
        return Associations::model()->findByPk($id)->ass_name;
    }
    
    public function associationImage($id)
    {
        return Associations::model()->findByPk($id)->ass_logo;
    }
    
    public function Image($filename, $size='thumb', $alt='')
    {
        $baseUrl = Yii::app()->baseUrl;
        $basePath = Yii::app()->basePath;
        if(file_exists($basePath.'/../images/frontend/'.$size.'/'.$filename) && $filename)
            return CHtml::image($baseUrl.'/images/frontend/'.$size.'/'.$filename, $alt);
        else
            return CHtml::image($baseUrl.'/images/noimage.jpg',$alt);
    }
}