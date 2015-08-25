<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * We extend the constructor method of our controller class, in which we set the 
	 * application language. Since all our individual controller classes extend from 
	 * this one, the application language will be set explicitly upon each request.
	 * @param string $id id of this controller
	 * @param CWebModule $module the module that this controller belongs to
	 */
	public function __construct($id, $module=null)
	{
	    parent::__construct($id,$module);
	    // If there is a post-request, redirect the application to the provided url of the selected language 
	    if ( isset($_POST['language']) )
	    {
	        $lang = $_POST['language'];
	        $MultilangReturnUrl = $_POST[$lang];
	        $this->redirect($MultilangReturnUrl);
	    }

	    // Set the application language if provided by GET, session or cookie
	    if ( isset($_GET['language']) )
	    {
	        Yii::app()->language = $_GET['language'];
	        Yii::app()->user->setState('language', $_GET['language']); 
	        $cookie = new CHttpCookie('language', $_GET['language'], array('httpOnly' => true));
	        $cookie->expire = time() + (60*60*24*365); // (1 year)
	        Yii::app()->request->cookies['language'] = $cookie;
	    }
	    else if ( Yii::app()->user->hasState('language') )
	        Yii::app()->language = Yii::app()->user->getState('language');
	    else if ( isset(Yii::app()->request->cookies['language']) )
	        Yii::app()->language = Yii::app()->request->cookies['language']->value;
	}

	/**
	 * Returns a url that contains the selected language
	 * @param  string $lang current language
	 * @return string url containing the selected language
	 */
	public function createMultilanguageReturnUrl($lang='en')
	{
	    if ( count($_GET) > 0 )
	    {
	        $arr = $_GET;
	        $arr['language'] = $lang;
	    }
	    else
	        $arr = array('language'=>$lang);

	    return $this->createUrl('', $arr);
	}	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','list'),
				// 'users'=>array('@'),
				'roles'=>array('admin', 'staff'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				// 'users'=>array('@'),
				'roles'=>array('admin', 'staff'),
			),
			array('allow', // allow admin role to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				// 'users'=>array('admin'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}	
}