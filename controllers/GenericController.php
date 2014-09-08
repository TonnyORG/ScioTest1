<?php

abstract class GenericController
{
	protected static $className;
	protected static $queryClassName;

	/**
	 * Retrieves the total of records
	 *
	 * @return    int
	 */
	public static function countAll()
	{
		$queryClassName = static::$queryClassName;
		return $queryClassName::create()->count();
	}

	/**
	 * Retrieves all the records as object
	 *
	 * @param     int    $per_page=10 defines the max number of results per page. User 0 to display all.
	 * @param     int    $show_page=1 defines the page to paginate based on max number of results per page.
	 * @param     string $field defines the field to sort the data.
	 * @param     string $order defines the order (asc/desc).
	 * @return    object
	 */
	public static function getAll($per_page=10, $page=1, $field=null, $order='desc')
	{
		$queryClassName = static::$queryClassName;
		$query = $queryClassName::create();
		if($per_page > 0) {
			$current_item = ($page-1) * $per_page;
			$query->offset($current_item);
			$query->limit($per_page);
		}
		if($field != null && ($order == 'asc'|| $order == 'desc')) {
			$sortMethod = 'orderBy'.$field;
			$query->$sortMethod($order);
		}
		return $query->find()->toArray();
	}

	/**
	 * Add new record
	 *
	 * @param     object $params contains all the params required to create the new record.
	 * @return    object
	 */
	abstract public static function postAdd($params);

	/**
	 * Edit record
	 *
	 * @param     int    id the record ID.
	 * @param     object $params contains all the params required to create the new record.
	 * @return    object
	 */
	abstract public static function postEdit($id, $params);

	/**
	 * Delete record
	 *
	 * @param     int    id the record ID.
	 * @return    boolean
	 */
	abstract public static function postDelete($id);
}