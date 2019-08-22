<?php
require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://139.59.8.35/social_login/index.php');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'snapmalldbusr');
define( 'DB_PASSWORD', 'H34KDJf3^34%@sdk');
define( 'DB_NAME', 'spsbrands.comkedb');


//Facebook App Details
define('FB_APP_ID', '1123964184360659');
define('FB_APP_SECRET', 'e75461e4b6fe9034a6053165e72983db');
define('FB_REDIRECT_URI', 'http://139.59.8.35/');

//Google App Details
define('GOOGLE_APP_NAME', 'spsbrands.com');
define('GOOGLE_OAUTH_CLIENT_ID', '1076691509028-nlcl9s78ldcsgihu85pv3mc5cebceada');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'tQfGjZtcjOKd3W9ox4rWuqMk');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://139.59.8.35/');
define("GOOGLE_SITE_NAME", 'http://139.59.8.35/');

//Twitter login
define('TWITTER_CONSUMER_KEY', 'J9P4N6HXbk4WT5g3X2q74amLp');
define('TWITTER_CONSUMER_SECRET', 'HaTaipUjvBd3MIFPnV6LeOKhnh4mEz8bA7V0yNcDR2WcgTfWM8');
define('TWITTER_OAUTH_CALLBACK', 'http://139.59.8.35/');

function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}