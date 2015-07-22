<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property string $id
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $last_login_time
 * @property string $create_time
 * @property string $update_time
 */
class User extends CActiveRecord
{
	/**
	 * property containing password confirmation as input from the view
	 * @var string
	 */
	public $password_repeat;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	* perform one-way encryption on the password before we store it in the database
	*/
	protected function afterValidate()
	{
		parent::afterValidate();
		$this->password = $this->encrypt($this->password);
	}

	/**
	 * Encrypt a value 
	 * @param  string $value the value to encrypt
	 * @return string encrypted value
	 */
	public function encrypt($value)
	{
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Yii::app()->getParams()->salt), $value, MCRYPT_MODE_CBC, md5(md5(Yii::app()->getParams()->salt))));
	}

	/**
	 * Decrypt a value
	 * @param  string $value the value to decrypt
	 * @return string decrypted value
	 */
	public static function decrypt($value)
	{
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Yii::app()->getParams()->salt), base64_decode($text), MCRYPT_MODE_CBC, md5(md5(Yii::app()->getParams()->salt)));		
	}	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fname, lname, username, password, email', 'required'),
			array('fname, username, password, email', 'length', 'max'=>50),
			array('lname', 'length', 'max'=>70),
			array('email, username', 'unique'),
			array('email', 'email'),
			array('password', 'compare'),
			array('password_repeat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fname, lname, username, password, email, last_login_time, create_time, update_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fname' => 'Fname',
			'lname' => 'Lname',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'last_login_time' => 'Last Login Time',
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
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
