<?
	session_start();

	require_once '../config/connect.php'; // Connection to db

	$id__ticket = htmlspecialchars(strip_tags(trim($_POST['id__added__ticket'])));

	$numbers_as_line = ''; // line for numbers

	for ($x = 0; $x < 7; $x++) {
		$num[$x] = htmlspecialchars(strip_tags(trim($_POST['num'.$x])));
		$numbers_as_line .= $num[$y];
	}

	$hash_of_numbers_as_line = md5($numbers_as_line); // hashing numbers as line
	$hash_without_letters = preg_replace('~[^0-9]+~', '', $hash_of_numbers_as_line); // cut out all but the numbers
	$optim_md5_hash_of_amount  = trim($hash_without_letters, '0'); // cut out zeros at the beginning and end of the line

	mysqli_query($link, "UPDATE `ticket` SET
		`num1`='$num[0]',
		`num2`='$num[1]',
		`num3`='$num[2]',
		`num4`='$num[3]',
		`num5`='$num[4]',
		`num6`='$num[5]',
		`num7`='$num[6]',
		`optim_md5hash`='$optim_md5_hash_of_amount',
		`date_create_ticket`=NOW(),
		`error`='NOT_PAID'
		WHERE `id_ticket`='$id__ticket'");
	$resault = mysqli_fetch_assoc(mysqli_query($link, "SELECT
		`id_ticket`,
		`id_lottery`,
		`address`,
		`invoice`,
		`num1`,
		`num2`,
		`num3`,
		`num4`,
		`num5`,
		`num6`,
		`num7`,
		`optim_md5hash`,
		`date_create_ticket`,
		`error`
		FROM `ticket`
		WHERE `id_ticket`='$id__ticket'"))	;

	require_once 'generate-password.php'; // connection password generator
	$password = passwordGenerator(10);

	$PAY__STATUS__PAID = htmlspecialchars(strip_tags(trim($_POST['pay__status__paid'])));
  $PAY__STATUS__NOT__PAID = htmlspecialchars(strip_tags(trim($_POST['pay__status__not__paid'])));

	if ($resault['error'] == 'NOT_PAID') $resault['error'] = $PAY__STATUS__NOT__PAID;
	else if ($resault['error'] == 'PAID') $resault['error'] = $PAY__STATUS__PAID;

	$resault['date_create_ticket'] = date("Y-m-d h:i A", strtotime($resault['date_create_ticket']));

	$hash = password_hash($password, PASSWORD_DEFAULT); // Hash of password
	mysqli_query($link, "UPDATE `data` SET `hash`='$hash' WHERE `id_ticket`='$id__ticket'");

	$resault += ['passw' => $password];

	$json = defined('JSON_UNESCAPED_UNICODE')
	  ? json_encode($resault, JSON_UNESCAPED_UNICODE)
	  : json_encode($resault);

	echo $json;
?>