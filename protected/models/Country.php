<?php

/**
 * This is the model class for table "tbl_countries".
 *
 * The followings are the available columns in table 'tbl_countries':
 * @property integer $id
 * @property string $CountryName
 * @property string $twoLetterISO
 * @property string $threeLetterISOCode
 * @property integer $numericISOCode
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countries the static model class
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
		return 'tbl_countries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CountryName, twoLetterISO, threeLetterISOCode, numericISOCode', 'required'),
			array('numericISOCode', 'integerOnly'=>true),
			//array('loc, code, code_inet', 'length', 'max'=>2),
			//array('name', 'length', 'max'=>100),
			//array('enabled', 'length', 'max'=>1),
			//array('code_iso3', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, CountryName, twoLetterISO, threeLetterISOCode, numericISOCode', 'safe', 'on'=>'search'),
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
			//'loc' => 'Loc',
			//'code' => 'Code',
			//'name' => 'Name',
			//'enabled' => 'Enabled',
			//'code_iso3' => 'Code Iso3',
			//'code_inet' => 'Code Inet',
			//'region' => 'Region',
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
		//$criteria->compare('loc',$this->loc,true);
		//$criteria->compare('code',$this->code,true);
		//$criteria->compare('name',$this->name,true);
		//$criteria->compare('enabled',$this->enabled,true);
		//$criteria->compare('code_iso3',$this->code_iso3,true);
		//$criteria->compare('code_inet',$this->code_inet,true);
		//$criteria->compare('region',$this->region);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function get_id_by_slug($slug)
    {
        $model=self::model()->find("slug='$slug'");
        if($model)return $model->id;
        else return false;
    }
}