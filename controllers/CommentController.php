<?php

class CommentController {
	public static function countAll() {
		return CommentQuery::create()->count();
	}
}