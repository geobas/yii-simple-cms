<?php

/**
 * This is the model class for table "tbl_article_category".
 *
 * The followings are the available columns in table 'tbl_article_category':
 * @property string $article_id
 * @property string $category_id
 * @property string $create_time
 * @property string $update_time
 */
class ArticleCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_article_category';
	}

	/**
	 * Creates a new model.
	 * @param integer $article_id article's id for creation
	 * @param integer $category_id category's id for creation
	 */
    public static function saveArticleCategory($article_id, $category_id)
    {
        $criteria=new CDbCriteria;
        $criteria->condition='article_id=:article_id and category_id=:category_id';
        $criteria->params=array(':article_id'=>$article_id, ':category_id'=>$category_id);
        
        $articleCategory = self::model()->find($criteria);
        if ( $articleCategory===null ) // create articleCategory
        {
        	// delete previous record
        	self::model()->deleteAll('article_id = ' . $article_id);

        	// add new one
            $articleCategory = new self;
            $articleCategory->attributes = array(
            									'article_id'=>$article_id,
	            								'category_id'=>$category_id,
            									'create_time'=>date('Y-m-d H:i:s'),
            									'update_time'=>'0000-00-00 00:00:00',
            								);
            $articleCategory->save();
        }
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, category_id, create_time, update_time', 'required'),
			array('article_id, category_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('article_id, category_id, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_id' => 'Article',
			'category_id' => 'Category',
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

		$criteria->compare('article_id',$this->article_id,true);
		$criteria->compare('category_id',$this->category_id,true);
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
	 * @return ArticleCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
