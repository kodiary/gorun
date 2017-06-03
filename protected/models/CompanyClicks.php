<?php

/**
 * This is the model class for table "rest_clicks".
 *
 * The followings are the available columns in table 'rest_clicks':
 * @property integer $id
 * @property integer $company_id
 * @property string $date
 */
class CompanyClicks extends CActiveRecord
{
    public $count;
    public $count_clicks;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyClicks the static model class
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
		return 'tbl_company_clicks';
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
    public function yearly_report_by_company($cid,$year)
    {
        $criteria=new CDbCriteria;
        $criteria->select = 'count( * ) AS count';
        $criteria->condition="company_id=$cid AND  YEAR(date)=$year";
        return CompanyClicks::model()->find($criteria);
    }
    public function monthly_report_by_company($cid, $month, $year){
        if($month!='00' && $year!='00'){
            $criteria = new CDbCriteria;
            $criteria->select = 'count(company_id) as count';
            $criteria->addCondition("company_id=$cid AND MONTH(date)=$month AND YEAR(date)=$year");
            $criteria->group = 'YEAR(date), MONTH(date)';
            return CompanyClicks::model()->find($criteria);
        }
        else
            return false;
    }
    
    public function daily_report_by_company($cid, $day, $month, $year){
        if($month!='00' && $year!='00' && $month!=""){
            $criteria = new CDbCriteria;
            $criteria->select = 'count(company_id) as count';
            $criteria->addCondition("company_id=$cid AND DAY(date)=$day AND MONTH(date)=$month AND YEAR(date)=$year");
            //$criteria->group = 'YEAR(date), MONTH(date)';
            return CompanyClicks::model()->find($criteria);
        }
        else
            return false;
    }
    public function countClicks($cid)
    {
        $criteria = new CDbCriteria;
        $criteria->condition='company_id='.$cid;
        return CompanyClicks::model()->count($criteria);
    }
    
    public function weeklyReport($startDate, $endDate, $company_id)
    {
        //$sql = "SELECT date, count( company_id ) AS count FROM rest_clicks WHERE company_id = 3002 AND date BETWEEN '2012-05-1' AND '2012-06-03' GROUP BY date";
        $criteria = new CDbCriteria;
        $criteria->select = 'date, count(company_id) as count_clicks';
        $criteria->addBetweenCondition('date', "$startDate", "$endDate");
        $criteria->condition='company_id='.$company_id;
        $criteria->group='date';
        return CompanyClicks::model()->findAll($criteria);
    }
    public function date_range($sd,$ed){
        $tmp = array();
        $sdu = strtotime($sd);
        $edu = strtotime($ed);
        while ($sdu <= $edu) {
            $tmp[] = date('Y-m-d',$sdu);
            $sdu = strtotime('+1 day',$sdu);
        }
        return $tmp;
    }
}