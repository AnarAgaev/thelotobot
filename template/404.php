<div class="wrap">
	<h1><span class="pnf-logo">404...</span><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?></h2>
	<div class="text__content big__mb">
		<p><?= $CONTENT__DATA['RECOMMENDATION__TITLE']; ?><br>
			1. <?= $CONTENT__DATA['RECOMMENDATION__1']; ?><br>
			2. <?= $CONTENT__DATA['RECOMMENDATION__2']; ?>
		</p>
		<a href="/"><button><?= $CONTENT__DATA__ALL_PAGE['TO_INDEX_PAGE']; ?></button></a>
	</div>
	<h2><?= $CONTENT__DATA__ALL_PAGE['ERROR_FORM_TITLE']; ?></h2>
	<form action="" method="post" enctype="multipart/form-data" id="send__feedback">
		<input type="hidden" id="from__fb" value="Contacts">
		<input type="text" id="name__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['NAME']; ?>">
		<input type="text" id="mail__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['MAIL']; ?>">
		<textarea id="msg__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['QUESTION']; ?>"></textarea>
		<button id="submit__fb"><?= $CONTENT__DATA__ALL_PAGE['SEND__MSG']; ?></button>
		<span><?= $CONTENT__DATA__ALL_PAGE['PRIVACY_POLICY']; ?></span>
	</form>
</div>