<?php

class UserController extends GenericController
{
	/**
     * Overriding the parent variables
     */
	protected static $className = 'User';
	protected static $queryClassName = 'UserQuery';

	/**
	 * Add new record
	 *
	 * @param     object $params contains all the params required to create the new record.
	 * @return    object
	 */
	public static function postAdd($params)
	{
		try {
			$className = static::$className;
			$record = new $className();
			if (empty($params['user_name'])) {
				throw new Exception('Username cannot be empty'); 
			}
			$record->setUserName($params['user_name']);
			$now = new DateTime;
			$record->setCreatedDate($now->getTimestamp());
			$record->save();
			return $record;
		} catch (Exception $e) {
			return null;
		}
	}

	/**
	 * Edit record
	 *
	 * @param     int    id the record ID.
	 * @param     object $params contains all the params required to create the new record.
	 * @return    object
	 */
	public static function postEdit($id, $params)
	{
		try {
			$queryClassName = static::$queryClassName;
			if (empty($id)) {
				throw new Exception('User ID cannot be empty'); 
			}
			$record = $queryClassName::create()->findPK($id);
			if (empty($params['user_name'])) {
				throw new Exception('Username cannot be empty'); 
			}
			$record->setUserName($params['user_name']);
			$record->save();
			return $record;
		} catch (Exception $e) {
			return null;
		}
	}

	/**
	 * Delete record
	 *
	 * @param     int    id the record ID.
	 * @return    boolean
	 */
	public static function postDelete($id)
	{
		try {
			$queryClassName = static::$queryClassName;
			if (empty($id)) {
				throw new Exception('User ID cannot be empty'); 
			}
			$record = $queryClassName::create()->findPK($id);
			$record->delete();
			return ($record->isDeleted())? true: false;
		} catch (Exception $e) {
			return null;
		}
	}
}