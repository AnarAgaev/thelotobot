<div class="wrap">
	<? if ($TYPE__LOTTERY and $TYPE__LOTTERY != 'index') : ?>
		<h1><?= $CONTENT__DATA['TITLE']; ?></h1>

		<? if ($DATA_LOTTERY == '') : ?>
			<h2>
				<?
					echo $CONTENT__DATA['SUBTITLE_1'];
					echo $CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_'.$TYPE__LOTTERY];
					echo '. ';
					echo $CONTENT__DATA['SUBTITLE_2'];
				?>
			</h2>
		<?else:?>
			<h2 class="black__mb play-subtitle">
				<span>
					<?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_TYPE']; ?><? if ($COLON) echo ':';?>
				</span>
				<?= $CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_'.$TYPE__LOTTERY]; ?>
				<br>
				<span>
					<?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_NUMBER']; ?><? if ($COLON) echo ':';?>
				</span>
				<?= $DATA_LOTTERY['lottery_type'].$DATA_LOTTERY['id_lottery']; ?>
				<br>
				<span>
					<?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA_PLAY']; ?><? if ($COLON) echo ':';?>
				</span>
				<?= date("Y-m-d",strtotime($DATA_LOTTERY['date'])); ?>
				<br>
				<span>
					<?= $CONTENT__DATA__ALL_PAGE['TICKET_PROFIT_FOND']; ?><? if ($COLON) echo ':';?>
				</span>
				<?= $DATA_LOTTERY['profit']/100000000; ?> BTC
			</h2>
			<form action="#" id="data__ticket"></form>
			<div class="play__content">

				<div>
					<span>1</span>
					<p><?= $CONTENT__DATA['THINK_NUMBERS']; ?></p>
				</div>
				<div>
					<p><?= $CONTENT__DATA['ACTION_1']; ?></p>
					<div class="nums">
						<input type="text" maxlength="2" form="data__ticket" name="num0" id="num0">
						<input type="text" maxlength="2" form="data__ticket" name="num1" id="num1">
						<input type="text" maxlength="2" form="data__ticket" name="num2" id="num2">
						<input type="text" maxlength="2" form="data__ticket" name="num3" id="num3">
						<input type="text" maxlength="2" form="data__ticket" name="num4" id="num4">
						<input type="text" maxlength="2" form="data__ticket" name="num5" id="num5">
						<input type="text" maxlength="2" form="data__ticket" name="num6" id="num6">
					</div>
					<button id="generate_random_numbers"><?= $CONTENT__DATA['CREATE_RANDOM_NUMBERS']; ?></button>
				</div>

				<div>
					<span>2</span>
					<p><?= $CONTENT__DATA['PAY_TICKET']; ?></p>
					</div>
				<div>
					<p>
						<span class="big__txt">
							<?= $CONTENT__DATA__ALL_PAGE['PAY']; ?>
							<?= $LOTTERY__PRICE ;?> Bitcoin
						</span>
						<br><?= $CONTENT__DATA['TO_WALLET']; ?>
					</p>
					<input class="swipe-block copied-content" type="text" form="data__ticket" name="wallet_num" id="wallet_num" value="<?echo $result['address'];?>" readonly>
					<div class="horizontal-swipe"></div>
					<img src="https://bitaps.com/api/qrcode/png/<?echo $URL__MESSAGE;?>">
				</div>

				<div>
					<span>3</span>
					<p><?= $CONTENT__DATA['GET_NUMBER']; ?></p>
				</div>
				<div>
					<p><?= $CONTENT__DATA['LAST_STEP']; ?></p>
					<button id="add_ticket" value="<?= $ID__ADDED__TICKET; ?>" class="play__true" >
						<?= $CONTENT__DATA['ADD_TICKET']; ?>
						<text id="ticket__define__true">
							<?= $CONTENT__DATA['TICKET_ADDED']; ?>
						</text>
					</button>
					<input type="hidden" value="<?echo $ID__ADDED__TICKET;?>" id="id__added__ticket">
					<input type="hidden" value="<?= $CONTENT__DATA__ALL_PAGE['PAID']; ?>" id="pay__status__paid">
					<input type="hidden" value="<?= $CONTENT__DATA__ALL_PAGE['NOT_PAID']; ?>" id="pay__status__not__paid">
					<span>
						<?= $CONTENT__DATA['PRIVACY']; ?>
						<a href="/<?= $_SESSION['LANG']; ?>/rules" target="_blank"><?= $CONTENT__DATA['PRIVACY_LINK']; ?></a>.
					</span>
				</div>
			</div>

			<span class="define-ticket_title" id="define-ticket_title"><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA']; ?></span>
			<div class="result__define__ticket">
				<div>
					<p><?= $CONTENT__DATA['SEND_CHECK_DESCRIPTION']; ?></p>
					<div>
						<input type="text" id="mail" placeholder="email@example.com">
						<a><button id="send__ticket"><?= $CONTENT__DATA['SEND_CHECK']; ?></button></a>
					</div>
				</div>
				<div>
					<table>
						<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_NUMBER']; echo printColon($_SESSION['LANG']); ?><td class="copied-content" id="num__ticket"></td></tr>
						<tr>
							<td><?= $CONTENT__DATA__ALL_PAGE['PAY_TO_WALLET']; echo printColon($_SESSION['LANG']); ?></td>
							<td id="num__wallet" class="swipe-block"></td>
							<td class="horizontal-swipe"></td>
						</tr>
						<tr>
							<td><?= $CONTENT__DATA__ALL_PAGE['TICKET_INVOICE_NUMBER']; echo printColon($_SESSION['LANG']); ?></td>
							<td id="num__invoice" class="swipe-block"></td>
							<td class="horizontal-swipe"></td>
						</tr>
						<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_SELECTED_NUMBER']; echo printColon($_SESSION['LANG']); ?></td><td id="num__selected"></td></tr>
						<tr>
							<td><?= $CONTENT__DATA__ALL_PAGE['TICKET_PLAY_NUMBER']; echo printColon($_SESSION['LANG']); ?></td>
							<td id="optim_md5hash" data-description="<?= $CONTENT__DATA__ALL_PAGE['HOW_GET_NUMBER']; ?>">
								<span class="anchor"></span>
							</td>
						</tr>
						<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATE_CREATE']; echo printColon($_SESSION['LANG']); ?></td><td id="num__date"></td></tr>
						<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_STATUS']; echo printColon($_SESSION['LANG']); ?></td><td id="num__error"></td></tr>
						<tr>
							<td><?= $CONTENT__DATA__ALL_PAGE['PASSWORD']; echo printColon($_SESSION['LANG']); ?></td>
							<td>
								<div class="button" id="num__password"></div>
								<div><?= $CONTENT__DATA['WARNING']; ?></div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<form method="post" action="/<?= $_SESSION['LANG'];?>/lottery-number" target="_blank" id="lottery-number-form" style="display:none;">
				<input type="text" id="selected_number_1" name="selected_number_1">
				<input type="text" id="selected_number_2" name="selected_number_2">
				<input type="text" id="selected_number_3" name="selected_number_3">
				<input type="text" id="selected_number_4" name="selected_number_4">
				<input type="text" id="selected_number_5" name="selected_number_5">
				<input type="text" id="selected_number_6" name="selected_number_6">
				<input type="text" id="selected_number_7" name="selected_number_7">
			</form>
		<?endif;?>
	<? else: ?>
		<h1><?= $CONTENT__DATA__ALL_PAGE['CHOOSE_LOTTERY']; ?></h1>
		<h2><?= $CONTENT__DATA['YOUR_CHANCE']; ?></h2>
		<?
			// Import cards for select type of the lotteries
	    include SITE__DIR.'template/lottery-cards.php';
	  ?>
	<? endif; ?>
</div>