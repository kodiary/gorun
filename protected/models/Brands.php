<?php

/**
 * This is the model class for table "tbl_brands".
 *
 * The followings are the available columns in table 'tbl_brands':
 * @property integer $id
 * @property string $brand_name
 * @property integer $additional
 * @property string $slug
 */
class Brands extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Brands the static model class
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
		return 'tbl_brands';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('brand_name', 'required'),
            array('additional', 'numerical', 'integerOnly'=>true),
			array('brand_name, slug', 'length', 'max'=>100),
            array('additional, slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand_name, additional, slug', 'safe', 'on'=>'search'),
		);
	}

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand_name' => 'Brand Name',
            'additional' => 'IsAdditional',
			'slug' => 'Slug',
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
		$criteria->compare('brand_name',$this->brand_name,true);
        $criteria->compare('additional',$this->additional);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function brandVal($id)
    {
        return Brands::model()->findByPk($id)->brand_name;
    }
    
    public function getSelectedBrandsByCompany($companyId)
    {
        $companyBrands = CompanyBrands::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyBrands)
        {
            $brands = '';
            foreach($companyBrands as $cbrands)
            {
                $brandModel = Brands::model()->findByPk($cbrands->brand_id);
                if($brandModel)
                {
                    if($brands=='') $brands = $brandModel->brand_name;
                    else $brands = $brands.','.$brandModel->brand_name;
                }
            }            
        }
        if($brands) return $brands;
        else return null;
    }
    
    public function deleteCompanyAdditionalBrands($companyId)
    {
        $companyBrands = CompanyBrands::model()->findAllByAttributes(array('company_id'=>$companyId));
        if($companyBrands)
        {
            foreach($companyBrands as $cbrands)
            {
                $brand_type = Brands::model()->findByPk($cbrands->brand_id)->additional;
                if($brand_type==1)
                {
                    CompanyBrands::model()->deleteByPk($cbrands->id);
                    Brands::model()->deleteByPk($cbrands->brand_id);
                }
            }            
        }
    }
    
    //get selected brands with additional
    public function getBrandsByCompany($companyId)
    {
        $criteria = new CDbCriteria;
		$criteria->join = 'LEFT JOIN tbl_com_brands ON tbl_com_brands.brand_id = t.id';
        $criteria->condition = 'tbl_com_brands.company_id = '.$companyId;
        $criteria->order = 'brand_name ASC';
        
        $brands = Brands::model()->findAll($criteria);        
        return $brands;
    }
    
    public function getBrands()
    {
        $brandarr = array();
        
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional = 0';
        $criteria->order = 'brand_name ASC';
        
        $brandModel = Brands::model()->findAll($criteria);
        if($brandModel){
            foreach($brandModel as $bModel){
                $brandarr[] = $bModel->brand_name;
            }
        }
        
        if(is_array($brandarr)) return json_encode($brandarr);
        else return null;
    }
    
    public function checkBrand($brandName)
    {
        $brand = Brands::model()->findByAttributes(array('brand_name'=>$brandName));
        if($brand)
            return $brand;
        else
            return null;
    }
    public function getAllBrands()
    {
        $criteria = new CDbCriteria;
        //$criteria->condition = 't.additional = 0';
        $criteria->order = 'brand_name ASC';
        return Brands::model()->findAll($criteria);
    }
    public function getAdditionalBrands()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional = 1';
        $criteria->order = 'brand_name ASC';
        return Brands::model()->findAll($criteria);
    }
}