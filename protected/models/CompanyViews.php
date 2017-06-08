<?php

/**
 * This is the model class for table "rest_views".
 *
 * The followings are the available columns in table 'rest_views':
 * @property integer $id
 * @property integer $company_id
 * @property string $date
 */
class CompanyViews extends CActiveRecord
{
    public $count,$year,$month,$week,$max;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyViews the static model class
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
		return 'tbl_company_views';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, date', 'required'),
			array('company_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, date', 'safe', 'on'=>'search'),
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
    public function get_all_years_by_company($company_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'year(date) as year';
        $criteria->condition="company_id=$company_id and year(date)!=0";
        $criteria->group = 'year';
        $criteria->order='year';
        return CompanyViews::model()->findAll($criteria);  
    }
    public function get_all_months_by_year($company_id,$year)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'month(date) as month';
        $criteria->condition="company_id=$company_id AND year(date)=$year";
        $criteria->group = 'month';
        $criteria->order='month';
        return CompanyViews::model()->findAll($criteria);  
    }
    public function yearly_report_by_company($company_id)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'year(date) as year, count( * ) AS count';
        $criteria->condition="company_id=$company_id";
        $criteria->group = 'year';
        $criteria->order='year';
        return CompanyViews::model()->findAll($criteria);
    }
	public function monthly_report_by_company($company_id, $month, $year){
        if($month!='00' && $year!='00'){
            $criteria = new CDbCriteria;
            $criteria->select = 'count(company_id) as count';
            $criteria->addCondition("company_id=$company_id AND MONTH(date)=$month AND YEAR(date)=$year");
            $criteria->group = 'YEAR(date), MONTH(date)';
            return CompanyViews::model()->find($criteria);
        }
        else
            return false;
    }
    public function get_all_weeks_by_year($company_id,$year)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'week(date) as week';
        $criteria->condition="company_id=$company_id AND year(date)=$year";
        $criteria->group = 'week';
        $criteria->order='week';
        return CompanyViews::model()->findAll($criteria);  
    }
    public function get_max_week_by_year($company_id,$year)
    {
       $criteria=new CDbCriteria;
        $criteria->select = 'max(week(date)) as max';
        $criteria->condition="company_id=$company_id AND year(date)=$year";
        return CompanyViews::model()->find($criteria);  
    }
    public function weekly_report_by_company($company_id, $month, $year){
        if($month!='00' && $year!='00'){
            $criteria = new CDbCriteria;
            $criteria->select = 'count(company_id) as count';
            $criteria->addCondition("company_id=$company_id AND MONTH(date)=$month AND YEAR(date)=$year");
            $criteria->group = 'YEAR(date), MONTH(date)';
            return CompanyViews::model()->find($criteria);
        }
        else
            return false;
    }
    public function get_max_month_by_year($company_id,$year)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'max(month(date)) as max';
        $criteria->condition="company_id=$company_id AND year(date)=$year";
        return CompanyViews::model()->find($criteria);  
    }
    
    public function daily_report_by_company($company_id, $day, $month, $year){
        if($month!='00' && $year!='00' && $month){
            $criteria = new CDbCriteria;
            $criteria->select = 'count(company_id) as count';
            $criteria->addCondition("company_id=$company_id AND DAY(date)=$day AND MONTH(date)=$month AND YEAR(date)=$year");
            //$criteria->group = 'YEAR(date), MONTH(date)';
            return CompanyViews::model()->find($criteria);
        }
        else
            return false;
    }
}