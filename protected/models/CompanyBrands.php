<?php

/**
 * This is the model class for table "tbl_com_brands".
 *
 * The followings are the available columns in table 'tbl_com_brands':
 * @property integer $id
 * @property integer $company_id
 * @property integer $brand_id
 */
class CompanyBrands extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyBrands the static model class
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
		return 'tbl_com_brands';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, brand_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, brand_id', 'safe', 'on'=>'search'),
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
            'brands'=>array(self::BELONGS_TO,'Brands','brand_id'),
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
			'brand_id' => 'Brands',
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
		$criteria->compare('brand_id',$this->brand_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getBrandById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'brand_id='.$id;
        return CompanyBrands::model()->count($criteria);
    }
    
    public function listBrands()
    {
        $brands = Brands::model()->findAllByAttributes(array('additional'=>0));
        return CHtml::listData($brands, 'id', 'brand_name');
    }
    
    public function getSelectedBrands($companyId)
    {
        $brands = CompanyBrands::model()->findAllByAttributes(array('company_id'=>$companyId),"brand_id!=0");
        $brand_arr = array();
        if($brands){
            foreach($brands as $val)
            {
                $val->brand_id;
                $brand_arr[] = $val->brand_id;
            }
        }
        if(is_array($brand_arr))
            return $brand_arr;
        else
            return false;
    }
    public function getCompanyByBrand($brand_id)
    {
        $models=self::model()->findAllByAttributes(array('brand_id'=>$brand_id));
        $companies = array();
        if($models)
        {
            foreach($models as $model)
            {
               $companies[]=$model->company_id; 
            }
        }
        return $companies;
    }   
}