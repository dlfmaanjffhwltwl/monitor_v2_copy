<?php

/*
 * Initialization file
 * Contains defined variables
 * Sets the autoloader
 */


// Root for the app directory
define('APP_ROOT', dirname(__FILE__));

// Root for the public directory
define('PUBLIC_ROOT', dirname(__FILE__).'/../public');

// Public URL
define('URL', 'http://localhost/monitor_v2_copy');
define('MAP_KEY','a642546bb20c9bb18081e8d301d4cb75');	//카카오 api 키


//로컬 		: a642546bb20c9bb18081e8d301d4cb75
//가비아 	: 36dddc2d2217897b62d232df9530f3a5


define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'space0522');
define('DB_NAME', 'monitor_v2');


// define('DB_HOST', 'db.spacesensing.com');
// define('DB_USER', 'spacesen');
// define('DB_PASS', 'spacesensing0919');
// define('DB_NAME', 'spacesensing');



// File maximum size, in mb
define('FILE_MAX_SIZE', 4);

// Allowed extensions
define('FILE_EXT', array(
	'jpg',
	'jpeg',
	'png',
));

// Root for the upload directory
define('UPLOAD_ROOT', PUBLIC_ROOT.'/uploads');

// Cookie expiry time in seconds
define("COOKIE_EXPIRY", 7 * 86400);

// Start session
session_start();

// Autoload classes
spl_autoload_register(function ($class) {
    require_once 'core/' . $class . '.php';
});