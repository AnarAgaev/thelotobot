<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?></h2>
	<form action="" method="post" enctype="multipart/form-data" id="send__feedback">
		<input type="hidden" id="from__fb" value="Contacts">
		<input type="text" id="name__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['NAME']; ?>">
		<input type="text" id="mail__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['MAIL']; ?>">
		<textarea id="msg__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['QUESTION']; ?>"></textarea>
		<button id="submit__fb"><?= $CONTENT__DATA__ALL_PAGE['SEND__MSG']; ?></button>
		<span><?= $CONTENT__DATA__ALL_PAGE['PRIVACY_POLICY']; ?></span>
	</form>
</div>