<div class="order-details">
	<article class="column shipping">
		<h4><?php echo Yii::t('checkout','Shipping Address'); ?></h4>
		<div class="address-block">
			<p class="webstore-label confirmation">
				<?php
				echo $cart->shipaddress->first_name . ' ' . $cart->shipaddress->last_name . '<br>' . $cart->htmlShippingAddress;
				?>
				<span class="controls">
						<?php echo $cart->status ? null : CHtml::link(Yii::t('checkout', 'Change'), array('/checkout/shipping'));?>
					</span>
			</p>
		</div>
	</article>
	<article class="column payment">
		<h4><?php echo Yii::t('checkout','Payment Details'); ?></h4>
		<p <?= $cart->payment->payment_card ? '' : 'class="sim"'?> >
			<?php if ($cart->payment->payment_card): ?>
				<img src="/images/creditcards/<?= $cart->payment->payment_card ?>.png" class="card-tiny">
				<?php echo Yii::t('checkout','Card ending in '); ?><?php echo $cart->payment->card_digits ?><br>
			<?php else : ?>
				<b><?php echo $cart->payment->payment_name; ?></b><br>
			<?php endif; ?>

			<?php
			if (Yii::app()->getComponent($cart->payment->payment_module)->uses_credit_card)
				echo $cart->htmlbillingaddress;
			else
				echo $cart->payment->instructions;

			echo $cart->status ? null : CHtml::link(Yii::t('checkout', 'Change'), array('/checkout/final'));
			?>
		</p>
	</article>
</div>
