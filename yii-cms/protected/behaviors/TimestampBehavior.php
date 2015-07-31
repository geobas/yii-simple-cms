<?php
/**
 * Populate audit history columns when creating or updating a model
 */
class TimestampBehavior extends CActiveRecordBehavior
{
	/**
	* Override the parent method and populate create_time|update_time property
	* @param CModelEvent $event
	*/
	public function beforeSave($event)
	{
		if ( $this->owner->isNewRecord ) // actionCreate
			$this->owner->create_time = new CDbExpression('NOW()');
		else // actionUpdate
			$this->owner->update_time = new CDbExpression('NOW()');
	}	
}