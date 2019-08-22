<?php 
function contact_form_submit(){
	
	$name = $_POST['name'];
	$email= $_POST['email'];
	$message=$_POST['message'];
	echo '<script type="text/javascript">hello</script>';
				$subject = "Contact form submission in spsbrands.com";

				$message = "
				<html>
				<head>
				<title>spsbrands.com : someone tried to contact you.</title>
				</head>
				<body>
				<table>
				<tr><td>Person with the following details contacted you </td></tr>
				<br><br>
				<tr>
				<td>Name :".$name." </td></tr>
				<tr>
				<td>Email : ".$email."</td> 
				</tr>
				<br><br>
				<tr>
				<td> Message : ".$message."</td></tr>
				<br><br>
				</table>
				</body>
				</html>
				";

				
				$to="srikumaranonline@gmail.com";
				$headers1 = "From: Contact request <$email>\n";
				$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
				$headers1 .= "X-Priority: 1\r\n";
				$headers1 .= "X-MSMail-Priority: High\r\n";
				$headers1 .= "X-Mailer: Contact Request\r\n";
				$sentmail = mail ( $to, $subject, $message, $headers1,"-f $email" );
				
}

?>