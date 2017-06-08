<?php

class StatisticsController extends Controller
{
	public $layout='column2';
    public function actionIndex()
	{
        //draw chart
        $id=Yii::app()->user->id;
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
        $this->render('index', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years));
	}
     //yearly stats
    public function actionYearlyStats($id="")
    {
        $id=Yii::app()->user->id;
        $views=CompanyViews::yearly_report_by_company($id);
        $this->render('application.modules.admin.views.statistics._yearlystat',array('views'=>$views,'company_id'=>$id,'section'=>'company'));
    }
    //daily stat report of selected month and year
    public function actionDailystat()
    {
        $id=Yii::app()->user->id;
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
                $this->renderPartial('application.modules.admin.views.statistics._dailystat', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount), false, false);
                Yii::app()->end();
            }
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('application.modules.admin.views.statistics.dailystatform', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years,'section'=>'company'));
    }
    
    //daily stat report of selected month and year
    public function actionWeeklystat()
    {
        $id=Yii::app()->user->id;
        $year = date('Y', time());
        $week_number = date('W', time());
        if(isset($_POST['year']))$year=$_POST['year'];
        if(Yii::app()->request->isAjaxRequest){
            if($selected = $_POST['selected'])
            {
                $company_id = $id;
                $select = explode('-', $selected);
                $week_number = $select['0'];
                $year = $select['1'];
                $this->renderPartial('application.modules.admin.views.statistics._weeklystat', array('company_id'=>$company_id, 'week'=>$week_number, 'year'=>$year), false, false);
                Yii::app()->end();
            }
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('application.modules.admin.views.statistics.weeklystatform', array('company_id'=>$id, 'week'=>$week_number, 'year'=>$year,'years'=>$years,'section'=>'company'));
    }
    
    //daily stat report of selected month and year
    public function actionGraph($id="")
    {
       $id=Yii::app()->user->id;
        $month = date('m', time());
        $year = date('Y', time());
        $daycount = date("d", time());
         if(isset($_POST['year']))$year=$_POST['year'];
        if($selected = $_POST['month_year_list'])
        {
            $select = explode('-', $selected);
            $month = $select['0'];
            $year = $select['1'];
            $daycount = date("t", strtotime($year.'-'.$month));   
        }
        $years=CompanyViews::get_all_years_by_company($id);
        $this->render('application.modules.admin.views.statistics.chartform', array('company_id'=>$id, 'month'=>$month, 'year'=>$year, 'daycount'=>$daycount,'years'=>$years,'section'=>'company'));
    }
}