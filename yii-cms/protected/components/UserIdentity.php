<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * user's unique ID
	 * @var int
	 */
	private $_id;
	
	/**
	 * Authenticates a user using the User data model.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->findByAttributes(array('username'=>$this->username));

		if ( $user===null ) // username not found
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else // username was found
		{
			if ( $this->validatePassword($user->password) ) // password is invalid
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else // password is valid (and username)
			{
				$this->_id = $user->id;

				if ( null===$user->last_login_time ) 
				{
					$lastLogin = time();
				}
				else
				{
					$lastLogin = strtotime($user->last_login_time);
				}
				// update user's last login time
				$user->saveAttributes(array(
					'last_login_time'=>new CDbExpression('NOW()')
				));
				// store user's last login time to application's state
				Yii::app()->user->setState('lastLoginTime', $lastLogin);
				// store user's role to application's state
				Yii::app()->user->setState('role', $user->role->type);
				$this->errorCode=self::ERROR_NONE;
			}
		}

		return !$this->errorCode;
	}

	/**
	 * Checks if the given password is correct.
	 * @param  string the password to be validated
	 * @return boolean whether the password is valid
	 */
	private function validatePassword($password)
	{
		return $password !== crypt(trim($this->password), $password);
	}

	/**
	 * return user's unique database ID 
	 * @return int user's ID
	 */
	public function getId()
	{
		return $this->_id;
	}
}