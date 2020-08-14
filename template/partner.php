<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?></h2>

	<div class="text__content">
		<p><?= $CONTENT__DATA['DESCRIPTION']; ?></p>
		<h2><?= $CONTENT__DATA['RULES_TITLE']; ?></h2>
		<ul>
			<li><?= $CONTENT__DATA['RULE_1']; ?></li>
			<li><?= $CONTENT__DATA['RULE_2']; ?></li>
			<li><?= $CONTENT__DATA['RULE_3']; ?></li>
			<li><?= $CONTENT__DATA['RULE_4']; ?></li>
			<li><?= $CONTENT__DATA['RULE_5']; ?></li>
		</ul>

		<h2><?= $CONTENT__DATA['CHECK_TITLE']; ?></h2>
		<p><?= $CONTENT__DATA['CHECK_DESCRIPTION']; ?></p>

		<h2><?= $CONTENT__DATA['BECOME_PARTNER_TITLE']; ?></h2>
		<p><?= $CONTENT__DATA['BECOME_PARTNER_DESCRIPTION']; ?></p>

		<form action="" method="post" enctype="multipart/form-data" id="define__partner" class="base__form">
			<input type="text" id="mail" placeholder="<?= $CONTENT__DATA__ALL_PAGE['NOTIFICATION_EMAIL']; ?>">
			<button id="btn__define__partner"><?= $CONTENT__DATA__ALL_PAGE['CREATE_PARTNER']; ?></button>
			<table id="resault__define__partner">
				<caption><?= $CONTENT__DATA__ALL_PAGE['REFERRAL_DATA']; ?></caption>
				<tr>
					<td><?= $CONTENT__DATA__ALL_PAGE['UNIQUE_NUMBER']; ?>:</td>
					<td id="id__partner"></td>
				</tr>
				<tr>
					<td><?= $CONTENT__DATA__ALL_PAGE['PASSWORD']; ?>:</td>
					<td id="pas__partner"></td>
				</tr>
				<tr>
					<td><?= $CONTENT__DATA__ALL_PAGE['MAIL']; ?>:</td>
					<td id="mail__partner"></td>
				</tr>
				<tr>
					<td><?= $CONTENT__DATA__ALL_PAGE['REFERENCE_LINK']; ?>:</td>
					<td id="link__partner"></td>
				</tr>
				<tr>
					<td colspan="2" id="tfoot"><?= $CONTENT__DATA__ALL_PAGE['SAVE_DATA']; ?></td>
				</tr>
			</table>
		</form>
	</div>
</div>