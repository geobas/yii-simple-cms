<?php
/**
 * The language has to be a part of the URL. That is, $_GET['language'] has to be
 * defined. To ensure this, we override the createUrl() function of the class.
 * If the desired language is not present in the URL, we look if it is stored in a 
 * session variable, or in a cookie and set the application language accordingly. 
 * After that, we add the language to the parameters of the URL.
 */
class UrlManager extends CUrlManager
{
    public function createUrl($route, $params=array(), $ampersand='&')
    {
        if ( !isset($params['language']) )
        {
            if ( Yii::app()->user->hasState('language') )
                Yii::app()->language = Yii::app()->user->getState('language');
            else if ( isset(Yii::app()->request->cookies['language']) )
                Yii::app()->language = Yii::app()->request->cookies['language']->value;
            
            $params['language'] = Yii::app()->language;
        }

        return parent::createUrl($route, $params, $ampersand);
    }
}