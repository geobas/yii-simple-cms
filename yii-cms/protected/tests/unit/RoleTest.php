<?php

Yii::import('application.modules.admin.models.*');

class RoleTest extends CDbTestCase
{
	public $fixtures = array(
							'roles'=>'Role',
						);

	public function testCreate()
	{
		// Create a new role
		$new_role = new Role();
		$roleType = 'guest';
		$new_role->setAttributes(
				array(
					'type' => $roleType,
					'create_time' => '2016-05-04 19:05:41',
					'update_time' => '2016-05-04 19:05:41',	
				)
			);
		$this->assertTrue($new_role->save(false));

		// Read the newly created role
		$retrievedRole = Role::model()->findByPk($new_role->id);
		$this->assertTrue($retrievedRole instanceof Role);
		$this->assertEquals($roleType, $retrievedRole->type);
	}

	public function testRead()
	{
		$retrievedRole = $this->roles('role1');
		$this->assertTrue($retrievedRole instanceof Role);
		$this->assertEquals('admin', $retrievedRole->type);		
	}

	public function testUpdate()
	{
		$role = $this->roles('role2');
		$updatedType = 'author';
		$role->type = $updatedType; 
		$this->assertTrue($role->save(false));

		// Read the record again to ensure the update worked
		$updatedRole = Role::model()->findByPk($role->id);
		$this->assertTrue($updatedRole instanceof Role);
		$this->assertEquals($updatedType, $updatedRole->type);		
	}

	public function testDelete()
	{
		$role = $this->roles('role3');
		$savedRoleId = $role->id;
		$this->assertTrue($role->delete());
		$deletedRole = Role::model()->findByPk($savedRoleId);
		$this->assertEquals(NULL, $deletedRole);		
	}
}