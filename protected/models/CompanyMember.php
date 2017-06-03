<?php

/**
 * This is the model class for table "tbl_company_member".
 *
 * The followings are the available columns in table 'tbl_company_member':
 * @property integer $id
 * @property integer $company_id
 * @property integer $member_id
 */
class CompanyMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyMember the static model class
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
		return 'tbl_company_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, member_id', 'required'),
			array('company_id, member_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, member_id', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'member_id' => 'Member',
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
		$criteria->compare('member_id',$this->member_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getMemberTypeById($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'member_id='.$id;
        return CompanyMember::model()->count($criteria);
    }
    
    public function getCompanyByMemberType($member_id)
    {
        $models=self::model()->findAllByAttributes(array('member_id'=>$member_id));
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
    public function getMemberByCompany($companyId)
    {
        $members = self::model()->findAllByAttributes(array('company_id'=>$companyId));
        $arr = array();
        if($members){
            foreach($members as $val)
            {
                $arr[] = $val->member_id;
            }
        }
        return $arr;
    }
    public function is_member($companyId)
    {
        return self::model()->exists('company_id='.$companyId);
    }
    
}