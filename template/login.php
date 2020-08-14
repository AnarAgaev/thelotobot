<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE'];?></h1>
	<?
		$SHOW__FORM = false; // Show login form or not
		$DONT__HAVE__REFERRALS = false; // Does the user have referrals

		if ( isset($_POST['num']) and isset($_POST['mail']) and isset($_POST['pas']) ) {
			$ID__REFERRER = htmlspecialchars(strip_tags(trim($_POST['num'])));
			$MAIL = htmlspecialchars(strip_tags(trim($_POST['mail'])));
			$PASSWORD = htmlspecialchars(strip_tags(trim($_POST['pas'])));

			$HASH__FROM__DB = mysqli_fetch_assoc(mysqli_query($link,
				"SELECT `hash`
				FROM `referrer`
				WHERE `id_referrer`='$ID__REFERRER'
				AND `mail`='$MAIL'"));

			if ( password_verify($PASSWORD, $HASH__FROM__DB['hash']) ) {
				echo '<div class="text__content">';

					// get all the referrals and payouts
					$RESULT = mysqli_query($link,
						"SELECT
							`id_ticket`,
							`id_lottery`,
							`amount`,
							`date_create_ticket`,
							`error`
						FROM `ticket`
						WHERE `id_referrer`='$ID__REFERRER'
						AND `error`<>'NOT_ACTIVE'
						ORDER BY
							`id_lottery` DESC,
							`id_ticket` DESC");

					$LOTTERIES = array();

					// If the user has no referrals, change the corresponding variable.
					if ( !mysqli_num_rows($RESULT) ) $DONT__HAVE__REFERRALS = true;

					// create an empty array of lotteries and add it's zero element to the corresponding lottery data
					for ( $i = 0; $i < mysqli_num_rows($RESULT); $i++ ) {
						$row = mysqli_fetch_row($RESULT);

						$ID_LOTTERY = $row[1];
						$LOTTERY__DATA = mysqli_fetch_assoc(mysqli_query($link,
							"SELECT
								`lottery_type`,
								`date`,
								`price`,
								`completed`
							FROM `lottery`
							WHERE `id_lottery`='$ID_LOTTERY'"));

						// get referral cash payment from db
						$REFERRER__PROFIT = mysqli_fetch_assoc(mysqli_query($link,
							"SELECT
								`id_payment`,
								`profit`,
								`address`,
								`request_date`,
								`pyment_date`
							FROM `payment`
							WHERE `id_lottery`='$ID_LOTTERY'
							AND `id_referrer`='$ID__REFERRER'"));

						$LOTTERY__DATA['profit'] = $REFERRER__PROFIT['profit'];
						$LOTTERY__DATA['address'] = $REFERRER__PROFIT['address'];
						$LOTTERY__DATA['id_payment'] = $REFERRER__PROFIT['id_payment'];
						$LOTTERY__DATA['request_date'] = $REFERRER__PROFIT['request_date'];
						$LOTTERY__DATA['pyment_date'] = $REFERRER__PROFIT['pyment_date'];

						// add data of the lottery in $LOTTERIES array
						$LOTTERIES[$ID_LOTTERY] = array();
						array_push($LOTTERIES[$ID_LOTTERY], $LOTTERY__DATA);
					}

					mysqli_data_seek($RESULT, 0);

					// add to each element of the array a sub-array with a tickets
					for ( $i = 0; $i < mysqli_num_rows($RESULT); $i++ ) {
						$row = mysqli_fetch_row($RESULT);

						$ID_LOTTERY = $row[1];
						$TICKET = array();
						$TICKET['ID'] = $row[0];
						$TICKET['AMOUNT'] = $row[2];
						$TICKET['DATE'] = $row[3];
						$TICKET['STATUS'] = $row[4];

						array_push($LOTTERIES[$ID_LOTTERY], $TICKET);
					}

					foreach( $LOTTERIES as $LOT__ID => $LOT__DATA ) {
						$PROFIT = 0;
						?>
							<h2 class="first-letter-uppercase ref-lottery-caption"><?= $CONTENT__DATA__ALL_PAGE['LOTTERY']; ?> <?= $LOT__DATA[0]['lottery_type'].$LOT__ID; ?></h2>
							<table class="table__ref__tickets ref-lottery-table">
								<thead>
									<tr>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_TYPE']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA_PLAY']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET_PRICE']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_STATUS']; ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_TYPE']; ?>">
											<?= $CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_'.$LOT__DATA[0]['lottery_type']]; ?>
										</td>
										<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA_PLAY']; ?>">
											<?= $LOT__DATA[0]['date']; ?>
										</td>
										<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET_PRICE']; ?>">
											<?= (($LOT__DATA[0]['price'])/100000000); ?> Bitcoin
										</td>
										<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_STATUS']; ?>">
											<?
												if ($LOT__DATA[0]['completed']) {
													echo $CONTENT__DATA__ALL_PAGE['HAVE_CLOSE'];
												} else {
													echo $CONTENT__DATA__ALL_PAGE['HAVE_PASSING'];
												}
											?>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table__ref__tickets">
								<thead>
									<tr>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['ADDED']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['STATUS']; ?></th>
										<th><?= $CONTENT__DATA__ALL_PAGE['TICKET_PAYED']; ?> BTC</th>
									</tr>
								</thead>
								<tbody>
									<?
										foreach( $LOT__DATA as $TICKET__ID => $TICKET__DATA ){
											if ($TICKET__ID == 0) continue;
											$PROFIT = $PROFIT + $TICKET__DATA['AMOUNT'];
											?>
												<tr>
													<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET']; ?>">
														<?= $LOT__ID.'/'.$TICKET__DATA['ID'];?>
													</td>
													<td data__label="<?= $CONTENT__DATA__ALL_PAGE['ADDED']; ?>">
														<?= date('Y-m-d',strtotime($TICKET__DATA['DATE'])); ?>
													</td>
													<td data__label="<?= $CONTENT__DATA__ALL_PAGE['STATUS']; ?>">
														<?
															switch ($TICKET__DATA['STATUS']) {
																case 'NOT_ERROR':
																	echo $CONTENT__DATA__ALL_PAGE['PAID'];
																	break;
																case 'NOT_PAID':
																	echo $CONTENT__DATA__ALL_PAGE['NOT_PAID'];
																	break;
																case 'NOT_ACTIVE':
																	echo $CONTENT__DATA__ALL_PAGE['NOT_ACTIVE'];
																	break;
                              }
														?>
													</td>
													<td data__label="<?= $CONTENT__DATA__ALL_PAGE['TICKET_PAYED']; ?> BTC">
														<?= $TICKET__DATA['AMOUNT']/100000000; ?>
													</td>
												</tr>
											<?
										}
									?>
									<tr class="finish">
										<td colspan="3"><?= $CONTENT__DATA__ALL_PAGE['TOTAL']; ?></td>
										<td><?= $PROFIT/100000000; ?> BTC</td>
									</tr>
									<tr class="finish">
										<? if ($LOT__DATA[0]['profit'] == 0) : ?>
											<td colspan="3"><?= $CONTENT__DATA__ALL_PAGE['REFERRAL_INCOME']; ?></td>
											<td>
												<?
													$NUMBER_PROFIT = number_format(($PROFIT/100000000)*0.05, 10, ".", "");
													$NUMBER_PROFIT = rtrim($NUMBER_PROFIT,"0");
													$NUMBER_PROFIT = rtrim($NUMBER_PROFIT,".");
													echo $NUMBER_PROFIT;
												?>
												BTC
											</td>
										<?else:?>
											<td colspan="3"><?= $CONTENT__DATA__ALL_PAGE['HAVE_PAID']; ?></td>
											<td>
												<?
													$NUMBER_PAY = number_format(( $LOT__DATA[0]['profit']/100000000 ), 10, ".", "");
													$NUMBER_PAY = rtrim($NUMBER_PAY,"0");
													$NUMBER_PAY = rtrim($NUMBER_PAY,".");
													echo $NUMBER_PAY;
												?>
												BTC
											</td>
										<?endif;?>
									</tr>
								</tbody>
							</table>

							<? if (!$LOT__DATA[0]['completed'] == '') : // if lottery completed, show footer with data of pay profit

								if( $LOT__DATA[0]['id_payment'] == '' and $PROFIT != 0 ):?>
									<form class="get-profit"
												id="form_get_profit_<?= $LOT__ID; ?>"
												data-query-result="<?= $CONTENT__DATA__ALL_PAGE['REQUEST_PROCESSED']; ?>" >
										<span><?= $CONTENT__DATA__ALL_PAGE['GET_TO_WALLET']; ?></span>
										<input type="hidden" class="id_lottery" value="<?echo $LOT__ID;?>">
										<input type="hidden" class="id_refferrer" value="<?echo $ID__REFERRER;?>">
										<input type="text" class="wallet" placeholder="<?= $CONTENT__DATA__ALL_PAGE['PAYMENT_WALLET']; ?>">
										<button><?= $CONTENT__DATA__ALL_PAGE['WITHDRAW']; ?></button>
									</form>
								<? endif;

								if ($LOT__DATA[0]['id_payment'] != '' and $LOT__DATA[0]['pyment_date'] == 0) : ?>
									<form class="get-profit">
										<font><?= $CONTENT__DATA__ALL_PAGE['REQUEST_PROCESSED']; ?></font>
									</form>
								<? endif;

								if ($LOT__DATA[0]['id_payment'] != '' and $LOT__DATA[0]['pyment_date'] != 0) : ?>
									<form class="get-profit">
										<font>
											<?= $CONTENT__DATA__ALL_PAGE['PAYMENT'] . ' #' . $LOT__DATA[0]['id_payment']; ?>
											<?= $CONTENT__DATA__ALL_PAGE['FROM'] . ' ' . date("Y.m.d",strtotime($LOT__DATA[0]['pyment_date'])); ?>
											<?= $CONTENT__DATA__ALL_PAGE['TO_WALLET'] . ': ' . $LOT__DATA[0]['address']; ?>
										</font>
									</form>
								<? endif;

							else : ?>
								<form class="get-profit">
									<font><?= $CONTENT__DATA__ALL_PAGE['GET_PROFIT_WARNING']; ?></font>
								</form>
							<? endif;
					}
				echo '</div>';
			} else $SHOW__FORM = true;
		} else $SHOW__FORM = true;
	?>

	<? if ( $DONT__HAVE__REFERRALS ) : ?>
		<h2><?= $CONTENT__DATA__ALL_PAGE['NO_REFERENCES']; ?></h2>
		<table class="ref__anchor<? if ($_SESSION['LANG'] == 'no') echo ' ref__anchor__long'; ?>">
			<caption><?= $CONTENT__DATA__ALL_PAGE['YOUR_REF_LINK']; ?></caption>
			<tr>
				<td class="swipe-block">thelotobot.com/?ref=<?= htmlspecialchars(strip_tags(trim($_POST['num'])));?></td>
				<td class="horizontal-swipe"></td>
			</tr>
		</table>
	<? endif; ?>

	<? if( $SHOW__FORM ) : ?>
		<h2><?= $CONTENT__DATA__ALL_PAGE['SUBTITLE']; ?></h2>
		<form action="/<?= $_SESSION['LANG']?>/login/" method="post" enctype="multipart/form-data" id="show__ref__date" class="base__form">
			<input type="text" id="num" name="num" placeholder="<?= $CONTENT__DATA__ALL_PAGE['YOUR_UNIC_NUM']; ?>">
			<input type="text" id="mail" name="mail" placeholder="<?= $CONTENT__DATA__ALL_PAGE['MAIL']; ?>">
			<input type="password" id="pas" name="pas" placeholder="<?= $CONTENT__DATA__ALL_PAGE['PASSWORD']; ?>">
			<button><?= $CONTENT__DATA__ALL_PAGE['SHOW_DATA']; ?></button>
		</form>
	<? endif; ?>
</div>