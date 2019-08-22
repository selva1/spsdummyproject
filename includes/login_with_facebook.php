<?php
include_once 'config.php';
include_once 'db.php';
include_once 'functions.php';
$conn = dbconnection();

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$id = $_POST['id'];
$login_type = 'FACEBOOK';
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
        $subject = "Welcome to spsbrands";
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
        $headers1 = "From: xcvx Newsletter <$from>\n";
        $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers1 .= "X-Priority: 1\r\n";
        $headers1 .= "X-MSMail-Priority: High\r\n";
        $headers1 .= "X-Mailer: Contact request\r\n";
        sendGridEmail($from,$to,$cc,$bcc,$subject,$message);
        echo "1";
        // echo "1";
        //exit;
    } else {
        echo "0";
        // exit;

    }
}
else {
    $_SESSION['userid'] 	    = $user_data['id'];
    $_SESSION['userName']    	= $user_data['user_name'];
    $_SESSION['resultEmail'] 	= $user_data['email'];

    echo "1";
    // exit;

}

?>