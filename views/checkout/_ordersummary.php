<div class="summary">
	<h2><?php echo Yii::t('checkout', "Order Summary") ?></h2>
	<table>
		<tbody>
		<tr>
			<th><?php echo Yii::t('checkout', "Merchandise") ?></th>
			<td id="CartSubtotal"><?php echo _xls_currency(Yii::app()->shoppingcart->subtotal) ?></td>
		</tr>
		<tr>
			<th><?php echo Yii::t('checkout', "Estimated Shipping") ?></th>
			<td><?php echo _xls_currency(Yii::app()->shoppingcart->shipping_sell) ?></td>
		</tr>
		<tr id="PromoCodeLine" class="<?php echo Yii::app()->shoppingcart->promoCode ? 'webstore-promo-line' : 'webstore-promo-line hide-me';?>" >
			<th><?php echo Yii::t('checkout', "Promo: ")?><span id="PromoCodeName"><?php echo Yii::app()->shoppingcart->promoCode ?></span></th>
			<td><?php echo "<span id='PromoCodeStr'>".Yii::app()->shoppingcart->totalDiscountFormatted."</span>" ?></td>
		</tr>

		<?php if (Yii::app()->shoppingcart->tax_total > 0): ?>
		<tr>
			<th><?php echo Yii::t('checkout', "Tax")?></th>
			<td><?php echo _xls_currency(Yii::app()->shoppingcart->tax_total) ?></td>
		</tr>
		<?php endif; ?>

		</tbody>
		<tfoot>
		<tr>
			<th><?php echo Yii::t('cart', "Total")?></th>
			<td id="totalCart"><?php
				echo _xls_currency(Yii::app()->shoppingcart->totalFormatted) ?></td>
		</tr>
		</tfoot>
	</table>
	<div class="promo">
		<?php
		echo CHtml::tag(
			'div',
			array(
				'id' => CHtml::activeId('Checkout','promoCode') . '_em_',
				'class' => 'form-error',
				'style' => 'display: none'
			),
			'<p>&nbsp;</p>'
		);
		?>
		<div style="position:relative;">
		<?php
		echo CHtml::textField(
			CHtml::activeId('Checkout','promoCode'),
			(Yii::app()->shoppingcart->promoCode !== null ? Yii::app()->shoppingcart->promoCode : ''),
			array(
				'placeholder' => Yii::t('cart','Promo Code'),
				'class' => "",
				'onkeypress' => 'return ajaxTogglePromoCodeEnterKey(event, ' .
					json_encode(CHtml::activeId('Checkout','promoCode')) .
					');'
			)
		);
		echo CHtml::htmlButton (
			Yii::app()->shoppingcart->promoCode !== null ? Yii::t('cart', 'Remove') : Yii::t('cart', 'Apply'),
			array(
				'type' => 'button',
				'class' => 'inset promocode-apply' . (Yii::app()->shoppingcart->promoCode !== null ? ' promocode-applied' : ''),
				'onclick' => 'ajaxTogglePromoCode(' .
					json_encode(CHtml::activeId('Checkout', 'promoCode')) .
					');'
			)
		);
		?>
		</div>
		<div class="form-error" style="display: none;">
			<p><?php echo Yii::t('checkout', "Something bad happened.")?></p>
		</div>
	</div>
</div>
<div>
	<div class="contact">
		<h3 class="registered-name"><?php echo Yii::app()->params['STORE_NAME']; ?></h3>
		<p>
			<?php echo Yii::app()->params['STORE_PHONE']; ?><br>
			<a href="mailto:orders@mystore.com"><?php echo Yii::app()->params['EMAIL_FROM']; ?></a>
		</p>
	</div>
	<div class="account">
		<h3><?php echo Yii::t('checkout', "Save time")?></h3>
		<p><?php echo Yii::t('checkout', "Shopped with us before?")?><br>
			<?php echo CHtml::link(Yii::t('checkout','Login to your Account'), '/checkout'); ?>
		<p class="hint"><?php echo Yii::t('checkout', "Don't have an account? You can create one after checkout.")?></p>
	</div>
</div>
