<?php

Yii::import('application.modules.admin.models.*');

class UserTest extends CDbTestCase
{
	public $fixtures = array(
							'users'=>'User',
						);

	public function testCreate()
	{
		// Create a new user
		$new_user = new User();
		$username = 'dummyuser';
		$new_user->setAttributes(
				array(
					'fname' => 'akis',
					'lname' => 'testakis',
					'username' => $username,
					'password' => 'jiQLBgEynkHadahx9uETljHbVKZYHrCaLdwJqjbQh4K0la6SS',
					'email' => 'ksenera@yahoo.com',
					'role_id' => 1,
					'last_login_time' => '2016-05-04 19:05:41',
					'create_time' => '2016-05-04 19:05:41',
					'update_time' => '2016-05-04 19:05:41',				
				)
			);
		$this->assertTrue($new_user->save(false));

		// Read the newly created user
		$retrievedUser = User::model()->findByPk($new_user->id);
		$this->assertTrue($retrievedUser instanceof User);
		$this->assertEquals($username, $retrievedUser->username);
	}

	public function testRead()
	{
		$retrievedUser = $this->users('user1');
		$this->assertTrue($retrievedUser instanceof User);
		$this->assertEquals('admin', $retrievedUser->username);		
	}

	public function testUpdate()
	{
		$user = $this->users('user1');
		$updatedFirstName = 'george';
		$user->fname = $updatedFirstName; 
		$this->assertTrue($user->save(false));

		// Read the record again to ensure the update worked
		$updatedUser = User::model()->findByPk($user->id);
		$this->assertTrue($updatedUser instanceof User);
		$this->assertEquals($updatedFirstName, $updatedUser->fname);		
	}

	public function testDelete()
	{
		$user = $this->users('user2');
		$savedUserId = $user->id;
		$this->assertTrue($user->delete());
		$deletedUser = User::model()->findByPk($savedUserId);
		$this->assertEquals(NULL, $deletedUser);		
	}

	public function testUserRoleAssignment()
	{
		$user = $this->users('user1');
		$user->role_id = 2;
		$this->assertTrue($user->save(false));
		$this->assertEquals('staff', $user->role->type);
	}

	public function testUserRole()
	{
		$user = $this->users('user1');
		$userRole = $user->role->type;
		$this->assertEquals('admin', $userRole);
	}

	public function testUserIsGuest()
	{
		$this->assertTrue( Yii::app()->user->isGuest );
	}

	public function testSuccesfullLogin()
	{
		$this->authenticateUser('admin','admin');
		echo "\n\nlogin()";		
		$this->checkUser();

		Yii::app()->user->logout();
		Yii::app()->user->clearStates();
		// unset($_SESSION);
		echo "logout()";
		$this->checkUser();		
	}

	public function testFailedLogin()
	{
		$this->authenticateUser('testadmin','12345');
		echo "\n\nlogin()";		
		$this->checkUser();

		Yii::app()->user->logout();
		Yii::app()->user->clearStates();
		echo "logout()";
		$this->checkUser();		
	}	

	private function authenticateUser($user, $pass)
	{
		$identity = new UserIdentity($user, $pass);
		$identity->authenticate();    		

		// supress error "session_regenerate_id(): Cannot regenerate session id - headers already sent"
		$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
		Yii::app()->setComponent('session', $mockSession);			
		
		Yii::app()->user->login($identity, 0);		
	}

    private function checkUser()
    {
        echo "\n\nStatus of current user:\n";
        echo "--------------------------\n";
        echo "User ID: ".Yii::app()->user->id."\n";
        echo "User Name: ".Yii::app()->user->name."\n";
        if (Yii::app()->user->isGuest)
                echo "There is NO user logged in.\n\n";
        else 
                echo "The user is logged in.\n\n";
    }	

    public function testLastLoginTime()
    {
		$identity = new UserIdentity('author', 'admin');
		$identity->authenticate();    				
		Yii::app()->user->login($identity, 0);		
		$this->assertEquals(1462377941, Yii::app()->user->lastLoginTime);
    }
}