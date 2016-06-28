<?php
Yii::import('bootstrap.widgets.BootPager');
class MyPager extends BootPager{

	/**
	 * Creates the URL suitable for pagination.
	 * This method is mainly called by pagers when creating URLs used to
	 * perform pagination. The default implementation is to call
	 * the controller's createUrl method with the page information.
	 * You may override this method if your URL scheme is not the same as
	 * the one supported by the controller's createUrl method.
	 * @param CController the controller that will create the actual URL
	 * @param integer the page that the URL should point to. This is a zero-based index.
	 * @return string the created URL
	 */
	public function createPageUrl($page)
	{
	   $url=Yii::app()->request->getRequestUri();
       $url=explode('/page',$url);
       	if($page>0) // page 0 is the default
			$page=$page+1;
		else
			$page=1;
        if($page==1) return $url[0];
		else return (rtrim($url[0], '/').'/page/'.$page);
	}
}