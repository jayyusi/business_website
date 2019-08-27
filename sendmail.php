<?php
//require 'PHPMailerAutoload.php';
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.aanddflooring.ca';  // Specify main and backup SMTP servers
//$mail->Host = 'mail.spiderwebsolution.net';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->SMTPAuth = false;                               // Enable SMTP authentication
$mail->Username = 'submit_form@jayyusi.net';                 // SMTP username
$mail->Password = '1SendEmailForAll!';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$nameField = $_POST['name'];
$emailField = $_POST['email'];
$subjectField = $_POST['subject'];
$messageField = $_POST['message'];

//$mail->From = 'from@example.com';
//$mail->FromName = 'Mailer';
$mail->From = $emailField;
$mail->FromName = $nameField;
$mail->addAddress('info@aanddflooring.ca', 'A & D Flooring');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
$mail->addReplyTo($emailField, $nameField);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

//$mail->Subject = 'Here is the subject';
//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->Subject = $subjectField;
$mail->Body    = $messageField;
$mail->AltBody = $messageField;

$theResults = <<<EOD
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Message Sent</title>
<style type="text/css">
body p {
	font-family: Aldhabi, Algerian, Aharoni;
	font-size: xx-large;
	text-align: center;
}
</style>
</head>

<body>
<p>Thank you for contacting A and D Flooring, we have received your message, we will reply to you as soon as possible.</p>
<p>Please wait, you will be redirected to the home page in 4 seconds.</p>
</body>
</html>
EOD;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "$theResults";
	header('refresh: 4; url=http://www.aanddflooring.ca');
}