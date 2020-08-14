<div class="wrap">
	<h1><?= $CONTENT__DATA['TITLE']; ?></h1>
	<h2><?= $CONTENT__DATA['SUBTITLE']; ?></h2>
	<p class="p__lottery-number">
		<span class="num__step">Step<span>1</span></span>
		<?
			if ($TICKET['FROM_PLAY_PAGE'] == 'true') echo $CONTENT__DATA['USER_SELECT_NUMS'];
			else echo $CONTENT__DATA['SELECT_DEF_NUMS'];
			echo '<span class="accent selected-numbers">';
			echo $TICKET[0].' - '.$TICKET[1].' - '.$TICKET[2].' - '.$TICKET[3].' - '.$TICKET[4].' - '.$TICKET[5].' - '.$TICKET[6];
			echo '</span><br>';
		?>
		<?= $CONTENT__DATA['STEP_1']; ?>
		<span class="number_in_block">
			<span class="accent">
				<?= $TICKET['NUMBERS_AS_LINE'] ?>
			</span>
		</span>
	</p>
	<p class="p__lottery-number">
		<span class="num__step">Step<span>2</span></span>
		<?= $CONTENT__DATA['STEP_2']; ?>
		<span class="number_in_block swipe-block">
			<span class="accent">
				<?= $TICKET['HASH_OF_LINE']; ?>
			</span>
		</span>
		<span class="horizontal-swipe"></span>
		<span class="sml_text">
			<span class="question"></span>
			<?= $CONTENT__DATA['ALGORITHM_1']; ?>
			<a href="<?= $CONTENT__DATA__ALL_PAGE['MD5_WIKI_LINK']; ?>" target="_blank">
				<?= $CONTENT__DATA['ALGORITHM_WIKI']; ?>
			</a>.
			<?= $CONTENT__DATA['ALGORITHM_2']; ?>
			<a href="<?= $CONTENT__DATA['MD5_GOOGLE_LINK']; ?>" target="_blank">
				<?= $CONTENT__DATA['ALGORITHM_GOOGLE']; ?>
			</a>.
		</span>
	</p>
	<p class="p__lottery-number">
		<span class="num__step">Step<span>3</span></span>
		<?= $CONTENT__DATA['STEP_3']; ?>
		<span class="number_in_block swipe-block">
			<span class="accent">
				<?= $TICKET['HASH_WITHOUT_LETTERS']; ?>
			</span>
		</span>
		<span class="horizontal-swipe"></span>
	</p>
	<p class="p__lottery-number">
		<span class="num__step">Step<span>4</span></span>
		<?= $CONTENT__DATA['STEP_4']; ?>
		<span class="number_in_block swipe-block">
			<span class="accent">
				<?= $TICKET['OPTIM_MD5_HASH_OF_AMOUNT']; ?>
			</span>
		</span>
		<span class="horizontal-swipe"></span>
	</p>

	<h2><?= $CONTENT__DATA__ALL_PAGE['HAVE_QUESTS']; ?></h2>
	<br><br>
	<form action="" method="post" enctype="multipart/form-data" id="send__feedback">
		<input type="text" id="name__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['NAME']; ?>">
		<input type="text" id="mail__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['MAIL']; ?>">
		<textarea id="msg__fb" placeholder="<?= $CONTENT__DATA__ALL_PAGE['QUESTION']; ?>"></textarea>
		<button id="submit__fb"><?= $CONTENT__DATA__ALL_PAGE['SEND__MSG']; ?></button>
		<span><?= $CONTENT__DATA__ALL_PAGE['PRIVACY_POLICY']; ?></span>
	</form>
</div>