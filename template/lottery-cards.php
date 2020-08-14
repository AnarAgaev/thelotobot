<div class="select__lottery">
	<a href="/<?= $_SESSION['LANG']; ?>/play/week">
		<h2>
			<?= $CONTENT__DATA__ALL_PAGE['PLAY_WEEK']; ?>
		</h2>
		<? if($DATA__WEEK__LOTTERY) : ?>
			<p><?= $CONTENT__DATA__ALL_PAGE['LOTTERY'] . ' ' .
					$DATA__WEEK__LOTTERY['lottery_type'] .
					$DATA__WEEK__LOTTERY['id_lottery']; ?></p>
			<p><?= $CONTENT__DATA__ALL_PAGE['RAFFLE_THROUGH']; ?></p>
			<div><?= dataToString($DATA__WEEK__LOTTERY['date'], $CONTENT__DATA__ALL_PAGE, $_SESSION['LANG']); ?></div>
			<p><?= $CONTENT__DATA__ALL_PAGE['PRIZE_FUND']; ?><span><?echo ($DATA__WEEK__LOTTERY['profit']/100000000);?> Bitcoin</span></p>
		<? else: ?>
			<p><? echo $CONTENT__DATA__ALL_PAGE['NO_LOTTERY']. ' ' .$CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_W']; ?>.
			<br><br><?= $CONTENT__DATA__ALL_PAGE['NEW_LOTTERY_NEAR']; ?>.</p>
		<? endif; ?>
	</a>

	<a href="/<?= $_SESSION['LANG']; ?>/play/month">
		<h2>
			<?= $CONTENT__DATA__ALL_PAGE['PLAY_MONTH']; ?>
		</h2>
		<? if($DATA__MONTH__LOTTERY) : ?>
			<p><?= $CONTENT__DATA__ALL_PAGE['LOTTERY'] . ' ' .
			    $DATA__MONTH__LOTTERY['lottery_type'] .
			    $DATA__MONTH__LOTTERY['id_lottery']; ?></p>
			<p><?= $CONTENT__DATA__ALL_PAGE['RAFFLE_THROUGH']; ?></p>
			<div><?= dataToString($DATA__MONTH__LOTTERY['date'], $CONTENT__DATA__ALL_PAGE, $_SESSION['LANG']); ?></div>
			<p><?= $CONTENT__DATA__ALL_PAGE['PRIZE_FUND']; ?><span><?echo ($DATA__MONTH__LOTTERY['profit']/100000000);?> Bitcoin</span></p>
		<? else: ?>
			<p><? echo $CONTENT__DATA__ALL_PAGE['NO_LOTTERY']. ' ' .$CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_M']; ?>.
			<br><br><?= $CONTENT__DATA__ALL_PAGE['NEW_LOTTERY_NEAR']; ?>.</p>
		<? endif; ?>
	</a>

	<a href="/<?= $_SESSION['LANG']; ?>/play/quarter">
		<h2>
			<?= $CONTENT__DATA__ALL_PAGE['PLAY_QUARTER']; ?>
		</h2>
		<? if($DATA__QUARTER__LOTTERY) : ?>
			<p><?= $CONTENT__DATA__ALL_PAGE['LOTTERY'] . ' ' .
				$DATA__QUARTER__LOTTERY['lottery_type'] .
				$DATA__QUARTER__LOTTERY['id_lottery']; ?></p>
			<p><?= $CONTENT__DATA__ALL_PAGE['RAFFLE_THROUGH']; ?></p>
			<div><?= dataToString($DATA__QUARTER__LOTTERY['date'], $CONTENT__DATA__ALL_PAGE, $_SESSION['LANG']); ?></div>
			<p><?= $CONTENT__DATA__ALL_PAGE['PRIZE_FUND']; ?><span><?echo ($DATA__QUARTER__LOTTERY['profit']/100000000);?> Bitcoin</span></p>
		<? else: ?>
			<p> <?echo $CONTENT__DATA__ALL_PAGE['NO_LOTTERY']. ' ' .$CONTENT__DATA__ALL_PAGE['LOTTERY_TYPE_Q']; ?>.
			<br><br><?= $CONTENT__DATA__ALL_PAGE['NEW_LOTTERY_NEAR']; ?>.</p>
		<? endif; ?>
	</a>
</div>