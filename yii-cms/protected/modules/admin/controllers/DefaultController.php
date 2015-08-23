<?php

class DefaultController extends Controller
{
	/**
	 * Sets the default action of controller
	 */	
	public $defaultAction = 'login';

	/**
	 * Sets the default layout for that controller's views
	 */	
	public $layout='/layouts/column1';

	/**
	 * Displays index page
	 */
	public function actionIndex()
	{
		// display this page only when the user is logged in
		if ( Yii::app()->user->isGuest )
			Yii::app()->request->redirect(WebUser::buildBackendUrl());

		// user's last login time
		if ( isset(Yii::app()->user->lastLoginTime) )
			$time = date( 'l, F d, Y, g:i a', Yii::app()->user->lastLoginTime);
		else
			$time = null;	
		$this->render('index', array('time' => $time));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		Yii::trace("The actionLogin() method is being requested", "application.modules.admin.controllers.DefaultController");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) 
			{
				Yii::log("Successful login of user: " . Yii::app()->user->name, "info", "application.modules.admin.controllers.DefaultController");
				// $this->redirect(Yii::app()->user->returnUrl);
				$this->redirect('admin/default/index');
			} 
			else 
			{
				Yii::log("Failed login attempt of user ". $model->username, "warning", "application.modules.admin.controllers.DefaultController");
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}	

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}	
}