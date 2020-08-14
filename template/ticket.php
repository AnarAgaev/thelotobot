<div class="wrap">
	<h1><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA']; ?></h1>
	<h2 id="title__show__ticket"><?= $CONTENT__DATA['SUBTITLE']; ?></h2>
	<form action="" method="post" enctype="multipart/form-data" id="show__ticket" class="base__form">
		<input type="text" id="num" placeholder="<?= $CONTENT__DATA__ALL_PAGE['TICKET_NUMBER']; ?>">
		<input type="text" id="inv" placeholder="<?= $CONTENT__DATA__ALL_PAGE['TICKET_INVOICE_NUMBER']; ?>">
		<input type="password" id="pas" placeholder="<?= $CONTENT__DATA__ALL_PAGE['TICKET_PASS']; ?>">
		<button><?= $CONTENT__DATA__ALL_PAGE['SHOW_DATA']; ?></button>
	</form>
	<table class="data__ticket">
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_NUMBER']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="num__ticket"></td></tr>
		<tr>
			<td><?= $CONTENT__DATA__ALL_PAGE['TICKET_WALLET']; ?>
				<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td>
			<td id="num__wallet" class="swipe-block"></td>
			<td class="horizontal-swipe"></td>
		</tr>
		<tr>
			<td><?= $CONTENT__DATA__ALL_PAGE['INVOICE_NUMBER']; ?>
				<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td>
			<td id="num__invoice" class="swipe-block"></td>
			<td class="horizontal-swipe"></td>
		</tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_SELECTED_NUMBER']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="nums"></td></tr>
		<tr>
			<td><?= $CONTENT__DATA__ALL_PAGE['TICKET_PLAY_NUMBER']; ?>
				<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td>
			<td id="optim_md5hash" data-description="<?= $CONTENT__DATA__ALL_PAGE['HOW_GET_NUMBER']; ?>?">
				<span class="number"></span>
				<span class="anchor"></span>
			</td>
		</tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATE_CREATE']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="date__create"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATE_PAY']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="date__get__pay"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_PAYED']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="sum__get__pay"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_NUMBER']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="num__lottery"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_TYPE']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="type__lottery"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_DATA_PLAY']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="date__lottery"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_PRICE']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="price"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_PROFIT_FOND']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="profit"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_LOTTERY_STATUS']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="lottery__status"></td></tr>
		<tr><td><?= $CONTENT__DATA__ALL_PAGE['TICKET_STATUS']; ?>
			<? if ($_SESSION['LANG'] != 'ja' && $_SESSION['LANG'] != 'ko' && $_SESSION['LANG'] != 'zh-cn' && $_SESSION['LANG'] != 'zh-tw') echo ':'; ?>
			</td><td id="num__error"></td></tr>
	</table>
	<div class="w100">
		<button id="next__ticket"><?= $CONTENT__DATA['SHOW_ANOTHER_TICKET']; ?></button>
	</div>
</div>

<form method="post" action="/<?echo $_SESSION['LANG'];?>/lottery-number" target="_blank" id="lottery-number-form" style="display:none;">
	<input type="text" id="selected_number_1" name="selected_number_1">
	<input type="text" id="selected_number_2" name="selected_number_2">
	<input type="text" id="selected_number_3" name="selected_number_3">
	<input type="text" id="selected_number_4" name="selected_number_4">
	<input type="text" id="selected_number_5" name="selected_number_5">
	<input type="text" id="selected_number_6" name="selected_number_6">
	<input type="text" id="selected_number_7" name="selected_number_7">
</form>