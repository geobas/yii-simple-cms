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

	public function testUserRole()
	{
		$user = $this->users('user2');
		$userRole = $user->role->type;
		$this->assertEquals('staff', $userRole);
	}
}