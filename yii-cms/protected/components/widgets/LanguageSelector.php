<?php
/**
 * A widget for selecting application's languages
 */
class LanguageSelector extends CWidget
{
	private $_currentLang;
	private $_languages;

	public function init()
	{
		$this->_currentLang = Yii::app()->language;
		$this->_languages = Yii::app()->params->languages;
	}

    public function run()
    {        
        $this->render('languageSelector', array(
        									'currentLang' => $this->_currentLang,
        									'languages'=>$this->_languages,
        								));
    }
}