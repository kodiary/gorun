<?php
class BannerController extends Controller
{
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;

    public function actionIndex()
	{
            $bannerId = $_GET['id'];
            $banner = Banner::model()->findByPk($bannerId);
            $model = new BannerClicks;
            $model->banner_id = $bannerId;
            $model->date = date('Y-m-d');
            if($model->save())
            {
                if($banner->links)$this->redirect($banner->links);
            }
           $this->redirect(Yii::app()->request->urlReferrer);
	}

    public function actionBackground($id)
    {
        $model=BackgroundBanner::model()->findByPk($id);
        $model->clicks= $model->clicks+1;
        $model->save();
        if($model->link)$this->redirect($model->link);
        else  $this->redirect(Yii::app()->request->urlReferrer);
    }
}
?>