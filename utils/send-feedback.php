<?php
	// Send message from contacts page
	$EMAIL = 'support@thelotobot.com';

	if ( isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['msg']) ) {

		$NAME = htmlspecialchars(strip_tags(trim($_POST['name'])));
		$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));
		$MSG = htmlspecialchars(strip_tags(trim($_POST['msg'])));
		$FROM_PAGE = htmlspecialchars(strip_tags(trim($_POST['from_page'])));

		$MESSAGE = "Hello. There is a new message from the Lotobot website, on ". $FROM_PAGE ." page.\r\n\n";
		$MESSAGE .= "*******\r\n";
		$MESSAGE .= "Website visitor data:\r\n";
		$MESSAGE .= "Name: ".$NAME."\r\n";
		$MESSAGE .= "Mail: ".$MAIL."\r\n";
		$MESSAGE .= "Message: ".$MSG."\r\n";
		$MESSAGE .= "*******\r\n\n\n";
		$MESSAGE .= "Please contact the website visitor in the near future according to the contact details indicated in the letter.\r\n\n";
		$SUBJECT = "Message from the Lotobot website visitor.";
		$SUBJECT = "=?utf-8?b?". base64_encode($SUBJECT) ."?=";
		$FROM = "thelotobot.com - bitcoin lottery";
		$FROM = "=?utf-8?b?". base64_encode($FROM) ."?=";
		$HEADER = "Content-type: text/plain; charset=utf-8\r\n";
		$HEADER .= "From: ".$FROM."<hi@thelotobot.com>\r\n";
		$HEADER .= "MIME-Version: 1.0\r\n";
		$HEADER .= "Date: ".date('D, d M Y h:i:s O');

		if( mail($EMAIL, $SUBJECT, $MESSAGE, $HEADER) ) {
			echo 'true';
		}	else {
			echo 'false';
		}
	} else {
		echo 'false';
	}
?>
