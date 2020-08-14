<div class="wrap">
	<h1>
		<?= $CONTENT__DATA['TITLE']; ?>
	</h1>
	<h2>
		<?= $CONTENT__DATA['SUBTITLE']; ?>
	</h2>
	<form method="post" enctype="multipart/form-data" id="get-profit" class="base__form">
		<input type="text" id="num" placeholder="<?= $CONTENT__DATA['NUMBER_OF_TICKET']; ?>">
		<input type="text" id="inv" placeholder="<?= $CONTENT__DATA['PAYMENT_ACCOUNT_NUMBER']; ?>">
		<input type="password" id="pas" placeholder="<?= $CONTENT__DATA['TICKET_PASSWORD']; ?>">
		<input type="text" id="wallet" placeholder="<?= $CONTENT__DATA['WALLET_NUMBER']; ?>">
		<input type="text" id="mail" placeholder="<?= $CONTENT__DATA['EMAIL']; ?>">
		<button>
			<?= $CONTENT__DATA['REQUEST_PAYMENT']; ?>
		</button>
	</form>
</div>