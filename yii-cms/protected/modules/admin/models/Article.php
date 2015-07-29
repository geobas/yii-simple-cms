<?php

/**
 * This is the model class for table "tbl_article".
 *
 * The followings are the available columns in table 'tbl_article':
 * @property string $id
 * @property string $title
 * @property string $body
 * @property string $image
 * @property string $user_id
 * @property integer $published
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Category[] $categories
 */
class Article extends CActiveRecord
{
	const DISABLED=0;
	const ENABLED=1;

	/**
	 * property containing category_id as input from the view
	 * @var string
	 */
    public $category = null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_article';
	}

	/**
	 * Save article and category to tbl_article_category
	 */
    public function afterSave()
    {    	
        parent::afterSave();
        ArticleCategory::saveArticleCategory($this->id, $this->category);
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, body, image, published', 'required'),
			array('title', 'length', 'max'=>255),
			array('image', 'length', 'max'=>150),
			array('user_id', 'length', 'max'=>10),
			array('category', 'safe', 'on' => 'create'),
			array('published', 'in', 'range' => self::getAllowedPublishedRange()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, body, image, user_id, published, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'categories' => array(self::MANY_MANY, 'Category', 'tbl_article_category(article_id, category_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'body' => 'Body',
			'image' => 'Image',
			'user_id' => 'User',
			'published' => 'Published',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns all article categories
	 * @deprecated
	 * @return array array of categories
	 */
	public function getCategoryOptions()
	{
		// $criteria = new CDbCriteria();
		// $criteria->select = 'title';
		$categories = Category::model()->findAll(array('select' => 'id, title'));

		$options = array();
		foreach ( $categories as $category )
		{
			$options[$category['id']] = $category['title'];
		}

		return $options;
	}

	/**
	 * Returns an array with all article categories
	 * @return array array of categories
	 */
	public function getCategoryList()
	{
		$categories = CHtml::listData(Category::model()->findAll(array('select' => 'id, title')), 'id', 'title');
		if ( !empty($categories) )
			return $categories;
		else
			return array();
	}

	/**
	 * Returns all article publishing options
	 * @return array publishing options
	 */
	public function getPublishedOptions()
	{
		return array(
			self::ENABLED => 'Yes',
			self::DISABLED => 'No',
		);
	}

	/**
	 * Returns all allowed publishing options
	 * @return array allowed publishing options
	 */
	public static function getAllowedPublishedRange()
	{
		return array(
			self::ENABLED,
			self::DISABLED,
		);
	}

	/**
	 * Returns the published status text
	 * @return string the published status text for the current article
	 */
	public function getPublishedText()
	{
		$publishedOptions = $this->publishedOptions;
		return isset($publishedOptions[$this->published]) ? $publishedOptions[$this->published] : "unknown published status ({$this->published})";
	}

	/**
	 * Returns a custom formatted date
	 * @param  string $date date in MySQL format yyyy-mm-dd h:i:s
	 * @return string date formatted
	 */
	public function formatDate($date)
	{
		$time = date('l, F d, Y, g:i a', strtotime($date));
		return $time;
	}
}