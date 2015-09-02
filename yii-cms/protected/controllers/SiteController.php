<?php

class SiteController extends Controller
{
	/**
	 * Default controller action
	 * @var string
	 */
	public $defaultAction = 'index';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			array(
				'COutputCache + view',
				// 'duration'=>120, // cache the entire output from the actionView() method for 2 minutes
				'dependency'=> array(
									'class'=>'system.caching.dependencies.CDbCacheDependency',
									'sql'=>'SELECT update_time FROM tbl_article WHERE id = ' . Yii::app()->request->getQuery('id'),
			  				   ),			
				'varyByParam'=>array('id'),
			),			
		);
	}	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// import the models of admin module
		Yii::import('application.modules.admin.models.*');
				
		$today = getdate(); 
		$locale = Yii::app()->getLocale(Yii::app()->language);

		// change language for that view
		// Yii::app()->language = 'el_gr';
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array('today' => $today, 'locale' => $locale));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the articles page
	 */
	public function actionArticles()
	{
		// import the models of admin module
		Yii::import('application.modules.admin.models.*');

		Yii::app()->clientScript->registerLinkTag(
			'alternate',
			'application/rss+xml',
			$this->createUrl('site/feed')
		);

		$dataProvider=new CActiveDataProvider('Article');
		$this->render('articles',array(
			'dataProvider'=>$dataProvider,
		));	
	}

	/**
	 * Returns an RSS formatted articles data feed
	 */
	public function actionFeed()
	{
		// import the models of admin module
		Yii::import('application.modules.admin.models.*');

		// get the 5 latest articles
		$articles = Article::model()->findAll(array('order' => 'id DESC', 'limit' => 5));

		// load efeed extension
		Yii::import('efeed.*');

		// specify feed type
		$feed = new EFeed(EFeed::RSS1); // RSS 1.0
		$feed->title = 'Latest articles';
		$feed->link = Yii::app()->homeUrl;
		$feed->description = 'This is test of creating a RSS 1.0 feed by Universal Feed Writer';
		$feed->RSS1ChannelAbout = 'http://www.ramirezcobos.com/about';

		// create our items
		foreach ( $articles as $article )
		{
			$item = $feed->createNewItem();
			$item->title = CHtml::encode($article->title);
			$item->link = CHtml::encode(Yii::app()->homeUrl . '/el/site/' . $article->id);
			$item->date = CHtml::encode($article->formatDate($article->create_time));
			$item->description = CHtml::encode($article->body);
			$item->addTag('dc:subject', 'Article Testing');

			$feed->addItem($item);
		}

		$feed->generateFeed();
		
		// terminate the application
		Yii::app()->end();
	}

	/**
	 * Displays a single article.
	 * @param integer $id the ID of the article to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Article the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		// import the models of admin module
		Yii::import('application.modules.admin.models.*');

		$model=Article::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}