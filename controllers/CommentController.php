<?php

class CommentController extends GenericController
{
	/**
     * Overriding the parent variables
     */
	protected static $className = 'Comment';
	protected static $queryClassName = 'CommentQuery';

	/**
     * Author variables
     */
	protected static $authorClassName = 'User';
	protected static $authorQueryClassName = 'UserQuery';

	/**
	 * Add new record
	 *
	 * @param     object $params contains all the params required to create the new record.
	 * @return    object
	 */
	public static function postAdd($params)
	{
		try {
			$authorQueryClassName = static::$authorQueryClassName;
			if (empty($params['user_id'])) {
				throw new Exception('User ID cannot be empty'); 
			}
			$authorRecord = $authorQueryClassName::create()->findPK($params['user_id']);
			$className = static::$className;
			$record = new $className();
			$record->setComment($params['comment']);
			$record->setUser($authorRecord);
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
		// Nothing to implement here
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