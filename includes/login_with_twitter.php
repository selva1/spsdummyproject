<?php
session_start();

include_once ('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', '9Iq6Y2mSiT70dpxiNHcTWEzwd');
define('CONSUMER_SECRET', 'vfHNgAazKIKcMB3ra88KlYBDTy2nIqrs0GFWx2MfiBYYR5vsW4');
define('OAUTH_CALLBACK', 'http://139.59.8.35/includes/twiter_auth.php');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

switch ($connection->http_code) {
    case 200:
        $url = $connection->getAuthorizeURL($token);
        header('Location: ' . $url);
        break;
    default:
        echo 'Could not connect to Twitter. Refresh the page or try again later.';
}

?>