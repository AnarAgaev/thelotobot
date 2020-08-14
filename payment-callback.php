<?
  // Number of confirmations in the system.
  // This parameter is set when create invoice for a lottery ticket
  // in the file /template/prolog/play.php
  // on the page / -your language parametr- /play/ -type of the lottery (week, month or other)- /
  define('CONFIRMATIONS_IN_THE_SYSTEM', 3);

  // Connect to db
  require_once 'config/connect.php';

  if (isset($_POST["tx_hash"])) $tx_hash = $_POST["tx_hash"];
    else $tx_hash = 'error';
  if (isset($_POST["address"])) $address = $_POST["address"];
    else $address = 'error';
  if (isset($_POST["invoice"])) $invoice = $_POST["invoice"];
    else $invoice = 'error';
  if (isset($_POST["code"])) $code = $_POST["code"];
    else $code = 'error';
  if (isset($_POST["amount"])) $amount = $_POST["amount"]; // Satoshi
    else $amount = 'error';
  if (isset($_POST["confirmations"])) $confirmations = $_POST["confirmations"];
    else $confirmations = 'error';
  if (isset($_POST["payout_tx_hash"])) $payout_tx_hash = $_POST["payout_tx_hash"]; // payout transaction hash
    else $payout_tx_hash = 'error';
  if (isset($_POST["payout_miner_fee"])) $payout_miner_fee = $_POST["payout_miner_fee"];
    else $payout_miner_fee = 'error';
  if (isset($_POST["payout_service_fee"])) $payout_service_fee = $_POST["payout_service_fee"];
    else $payout_service_fee = 'error';

  if (  isset($_POST["tx_hash"]) AND
        isset($_POST["address"]) AND
        isset($_POST["invoice"]) AND
        isset($_POST["code"]) AND
        isset($_POST["amount"]) AND
        isset($_POST["confirmations"]) AND
        isset($_POST["payout_tx_hash"]) AND
        isset($_POST["payout_miner_fee"]) AND
        isset($_POST["payout_service_fee"]) ) {

      foreach ($_POST as $key => $value) {
         $$key = htmlspecialchars(strip_tags(trim($value)));
      }

      if( $confirmations == CONFIRMATIONS_IN_THE_SYSTEM ) {
        // update ticket data in the database
        mysqli_query($link,
          "UPDATE `ticket`
          SET
            `confirmation`='$confirmations',
            `amount`='$amount',
            `tx_hash`='$tx_hash',
            `payout_tx_hash`='$payout_tx_hash',
            `payout_miner_fee`='$payout_miner_fee',
            `payout_service_fee`='$payout_service_fee',
            `date_payment_ticket`=NOW(),
            `error`='NOT_ERROR'
          WHERE `address`='$address'
          AND `invoice`='$invoice'");

        // get and update profit of the lottery in db
        $ID_LOTTERY = mysqli_fetch_assoc(mysqli_query($link,"
          SELECT `id_lottery`
          FROM `ticket`
          WHERE `address`='$address'
          AND `invoice`='$invoice'"));

        $ID_LOTTERY = $ID_LOTTERY['id_lottery'];

        $PROFIT = mysqli_fetch_assoc(mysqli_query($link, "
          SELECT `profit`
          FROM `lottery`
          WHERE `id_lottery` = '$ID_LOTTERY'"));

  			$PROFIT = $PROFIT['profit'] + $amount;

  			mysqli_query($link, "
  			  UPDATE `lottery`
  			  SET `profit`='$PROFIT'
  			  WHERE `id_lottery` = '$ID_LOTTERY'");
      }

      // At the end of the work with the callback, be sure to give back the payment bill
      // Use simple text format
      echo $invoice;
  }
  else echo 'ERROR DATE!';

  $mail = 'support@thelotobot.com';

  // Create and send mail
  $message = "Тест получения collback от сервиса bitaps.\r\n\n";
  $message .= "---------------------------------\r\n\n";
  $message .= "tx_hash: ".$tx_hash."\r\n";
  $message .= "address: ".$address."\r\n";
  $message .= "invoice: ".$invoice."\r\n";
  $message .= "payment code: ".$code."\r\n";
  $message .= "amount: ".$amount."\r\n";
  $message .= "confirmations: ".$confirmations."\r\n";
  $message .= "payout transaction hash: ".$payout_tx_hash."\r\n";
  $message .= "payout_miner_fee: ".$payout_miner_fee."\r\n";
  $message .= "payout_service_fee: ".$payout_service_fee."\r\n\n";

  $subject = "Тест получения collback от сервиса bitaps";
  $subject = "=?utf-8?b?". base64_encode($subject) ."?=";

  $from = "Bitaps colback";
  $from = "=?utf-8?b?". base64_encode($from) ."?=";
  $header = "Content-type: text/plain; charset=utf-8\r\n";
  $header .= "From: ".$from."<hi@thelotobot.com>\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Date: ".date('D, d M Y h:i:s O');

  mail($mail, $subject, $message, $header);
?>