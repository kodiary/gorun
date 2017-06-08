<?php

/**
 * This is the model class for table "banner_views".
 *
 * The followings are the available columns in table 'banner_views':
 * @property integer $id
 * @property integer $banner_id
 * @property integer $date
 */
class BannerViews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BannerViews the static model class
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
		return 'banner_views';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('banner_id, date', 'required'),
			array('banner_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, banner_id, date', 'safe', 'on'=>'search'),
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
    public function saveViews($bannerId)
    {
        $model = new BannerViews;
        $model->banner_id = $bannerId;
        $model->date = date('Y-m-d');
        if($model->save())
            return true;
    }
}