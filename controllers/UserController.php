<?php

class UserController {
	public static function countAll() {
		return UserQuery::create()->count();
	}
}