<?php

class StatisticsController extends Controller
{
	public $layout='admin';
    public function actionIndex($id="")
	{
        //draw chart
        $cmodel=Company::model()->findByPk($id);
        $month = date('m', time());
        $year = date('Y', time());
        $daycount = date("d", time());
         $years=CompanyViews::get_all_years_by_company($id);
        if(isset($_POST['year']))$year=$_POST['year'];
        if($selected = $_POST['month_year_list'])
        {
            //$company_id = $_POST['company_id'];
            $select = explode('-', $selected);
            $month = $select['0'];
            $year = $select['1'];
            $daycount = date("t", strtotime($year.'-'.$month));
        } 
        $this->render('index', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years,'cmodel'=>$cmodel));
	}
     //yearly stats
    public function actionYearlyStats($id="")
    {
        $cmodel=Company::model()->findByPk($id);
        $views=CompanyViews::yearly_report_by_company($id);
        $this->render('_yearlystat',array('views'=>$views,'company_id'=>$id,'cmodel'=>$cmodel));
    }
    //daily stat report of selected month and year
    public function actionDailystat($id="")
    {
         $cmodel=Company::model()->findByPk($id);
        //draw chart
        $month = date('m', time());
        $year = date('Y', time());
        $daycount = date("d", time());
        if(isset($_POST['year']))$year=$_POST['year'];
        if(Yii::app()->request->isAjaxRequest){
            if($selected = $_POST['selected'])
            {
                $company_id = $_POST['company_id'];
                $select = explode('-', $selected);
                $month = $select['0'];
                $year = $select['1'];
                $daycount = date("t", strtotime($year.'-'.$month));
                $this->renderPartial('_dailystat', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount), false, false);
                Yii::app()->end();
            }
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('dailystatform', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years,'cmodel'=>$cmodel));
    }
    
    //daily stat report of selected month and year
    public function actionWeeklystat($id="")
    {
         $cmodel=Company::model()->findByPk($id);
        $year = date('Y', time());
        $week_number = date('W', time());
        if(isset($_POST['year']))$year=$_POST['year'];
        if(Yii::app()->request->isAjaxRequest){
            if($selected = $_POST['selected'])
            {
                $company_id = $_POST['company_id'];
                $select = explode('-', $selected);
                $week_number = $select['0'];
                $year = $select['1'];
                $this->renderPartial('_weeklystat', array('company_id'=>$company_id, 'week'=>$week_number, 'year'=>$year), false, false);
                Yii::app()->end();
            }
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('weeklystatform', array('company_id'=>$id, 'week'=>$week_number, 'year'=>$year,'years'=>$years,'cmodel'=>$cmodel));
    }
    
    //daily stat report of selected month and year
    public function actionGraph($id="")
    {
         $cmodel=Company::model()->findByPk($id);
        $month = date('m', time());
        $year = date('Y', time());
        $daycount = date("d", time());
         if(isset($_POST['year']))$year=$_POST['year'];
        if($selected = $_POST['month_year_list'])
        {
            $id = $_POST['company_id'];
            $select = explode('-', $selected);
            $month = $select['0'];
            $year = $select['1'];
            $daycount = date("t", strtotime($year.'-'.$month));   
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('chartform', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years,'cmodel'=>$cmodel));
    }
}