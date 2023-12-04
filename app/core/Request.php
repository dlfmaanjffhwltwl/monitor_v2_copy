<?php

/*
 * Request Class
 * Run callback function
 */

class Request {
	
	public static function method($type, $callback) {
		// If request is what we want, run callback
		// if(!isset($_SERVER["HTTPS"])) { 
		// 	header('Location:https://localhost/monitor_v2');
		// }
		if ($_SERVER['REQUEST_METHOD'] === $type) {
			$callback();
		}
	}
}