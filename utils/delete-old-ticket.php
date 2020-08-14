<?
	/*
	 * This script delete old ticket.
	 * Will be delete tickets with date more 1 month ago.
	*/

	require_once dirname(__DIR__).'/config/connect.php'; // Connection to db

	// delete not activated tickets
  $RESULT_NOT_ACTIVE = mysqli_query($link, "
    SELECT `id_ticket`
    FROM `ticket`
    WHERE `amount` = 0
    AND `error` = 'NOT_ACTIVE'
    AND DATE(`date_create_ticket`) < NOW() - INTERVAL 1 MONTH");

  for ($i = 0; $i < mysqli_num_rows($RESULT_NOT_ACTIVE); $i++) {
    $ID__TICKET = mysql_result($RESULT_NOT_ACTIVE, $i, "id_ticket");

    // delete ticket from db
    mysqli_query($link, "DELETE FROM `ticket` WHERE `id_ticket` = '$ID__TICKET'");

    // delete data of ticket from data table
    mysqli_query($link, "DELETE FROM `data` WHERE `id_ticket`= '$ID__TICKET'");
  }

  // delete unpaid tickets
  $RESULT_NOT_PAID = mysqli_query($link, "
    SELECT `id_ticket`
    FROM `ticket`
    WHERE `amount` = 0
    AND `error` = 'NOT_PAID'
    AND DATE(`date_create_ticket`) < NOW() - INTERVAL 1 YEAR");

  for ($j = 0; $j < mysqli_num_rows($RESULT_NOT_PAID); $j++) {
    $TICKET = mysql_result($RESULT_NOT_PAID, $j, "id_ticket");

    // delete ticket from db
    mysqli_query($link, "DELETE FROM `ticket` WHERE `id_ticket` = '$TICKET'");

    // delete data of ticket from data table
    mysqli_query($link, "DELETE FROM `data` WHERE `id_ticket`= '$TICKET'");
  }
?>