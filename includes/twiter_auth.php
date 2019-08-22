<?php
session_start();
include_once 'config.php';
include_once 'db.php';
include_once 'functions.php';
$conn = dbconnection();
include_once ('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', '9Iq6Y2mSiT70dpxiNHcTWEzwd');
define('CONSUMER_SECRET', 'vfHNgAazKIKcMB3ra88KlYBDTy2nIqrs0GFWx2MfiBYYR5vsW4');
define('OAUTH_CALLBACK', 'http://139.59.8.35/includes/twiter_auth.php');

if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
    $_SESSION['oauth_status'] = 'oldtoken';
    // header('Location: ./destroysessions.php');
    session_start();
    session_destroy();
    $twitter_url=SITE_URL."login-with-twitter/?type=twitter";
    header('Location: '.$twitter_url);
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
//save new access tocken array in session
$_SESSION['access_token'] = $access_token;

//unset($_SESSION['oauth_token']);
//unset($_SESSION['oauth_token_secret']);

if (200 == $connection->http_code) {
    $_SESSION['status'] = 'verified';
    if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
        // header('Location: ./destroysessions.php');
        session_start();
        session_destroy();
        $twitter_url=SITE_URL."login-with-twitter/?type=twitter";
        header('Location: '.$twitter_url);
    }
    $access_token = $_SESSION['access_token'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

   // $parameter_array=array('include_email'=>true);
    /* If method is set change API call made. Test is called by default. */
    $content = $connection->get('account/verify_credentials',['include_email' => 'true']);

    $user_name = $content->name;
    $email = $content->email;
    $id = $content->id;
    $login_type = 'TWITTER';
    $currentDate = date("Y-m-d H:s");

    $user_data=[];
    $query="select id,email,user_name from hm_users where email='$email' AND login_type='$login_type'";
    $conn->set_charset("utf8");

    $user_details = mysqli_query($conn,$query);
    $numrows = mysqli_num_rows($user_details);

    if($numrows>0){
        while($result = mysqli_fetch_array($user_details)){
            $user_data['id']=$result['id'];
            $user_data['email']=$result['email'];
            $user_data['user_name']=$result['user_name'];

        }
    } else {
        $user_data=[];
    }

    if (empty($user_data)) {
        $stmtQaf = "INSERT INTO hm_users (`user_name`, `email`,accepted_terms,login_type,created_on) 
                VALUES 
                ('$user_name','$email','0','$login_type','$currentDate')";
        $results = $conn->query($stmtQaf);
        if ($results) {
            //$this->send_registration_mail($google_email,$google_fname);
            $last_id = $conn->insert_id;
            $_SESSION['userid'] 	    = $last_id;
            $_SESSION['userName']    	= $user_name;
            $_SESSION['resultEmail'] 	= $email;
            $subject = "Welcome to snapmal";
            $message = "
		<html>
		<head>
			<title>Registration successful with .</title>
				</head>
				<body>
				<table>
				<tr><td>Dear ".$user_name .", </td></tr>
				<br><br>
				<tr>
				<tr><td>Welcome to spsbrands </td></tr>
				<br><br>
				<tr>
				<td>You have been successfully registered with spsbrands. To access further please login with below user name.</td>
				</tr>
				<br><br>
				<tr>
				<td>User Name : ".$email."</td>
				</tr>
				<br><br>
				
				</table>
				</body>
				</html>
				";

            
            $to = $email;
            $from = 'testing@gmail.com';
            $headers1 = "From:  Newsletter <$from>\n";
            $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers1 .= "X-Priority: 1\r\n";
            $headers1 .= "X-MSMail-Priority: High\r\n";
            $headers1 .= "X-Mailer: Contact request\r\n";
            sendGridEmail($from,$to,$cc,$bcc,$subject,$message);

            echo "<script>window.close();window.opener.location.reload();</script>";
        } else {
            echo "0";
        }
    }
    else {
        $_SESSION['userid'] 	    = $user_data['id'];
        $_SESSION['userName']    	= $user_data['user_name'];
        $_SESSION['resultEmail'] 	= $user_data['email'];
        //echo "1";
        echo "<script>window.close();window.opener.location.reload();</script>";

        //header('Location:'.SITE_URL);
    }
} else {
    session_start();
    session_destroy();
    $twitter_url=SITE_URL."login-with-twitter/?type=twitter";
    header('Location: '.$twitter_url);
   // header('Location: ./destroysessions.php');
}

?>