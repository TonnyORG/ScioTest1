<?php

class CommentController extends GenericController
{
	/**
     * Overriding the parent variables
     */
	protected static $className = 'Comment';
	protected static $queryClassName = 'CommentQuery';


	public static function postAdd($params) {}
	public static function postEdit($id, $params) {}
	public static function postDelete($id) {}
}