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

		if ( $user===null )
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
		{
			if ( $user->password!==$user->encrypt($this->password) )
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
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
				$this->setState('lastLoginTime', $lastLogin); // store user's last login time to session
				$this->setState('role', $user->role); // store user's role to session
				$this->errorCode=self::ERROR_NONE;
			}
		}

		return !$this->errorCode;
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