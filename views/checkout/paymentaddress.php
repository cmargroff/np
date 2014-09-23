<?php
$form = $this->beginWidget(
	'CActiveForm',
	array(
		'htmlOptions' => array('class' => "section-content",'id' => "payment", 'novalidate' => '1','autocomplete'=>'on'
		)
	)
);
?>
<nav class="steps">
	<ol>
		<li class="completed"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Shipping')?></li>
		<li class="current"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Payment')?></li>
		<li class=""><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Confirmation')?></li>
	</ol>
</nav>

<h1><?php Yii::t('checkout', 'Payment')?></h1>

<div class="outofbandpayment">
	<?php
	$count = 0;
	foreach ($model->getSimPaymentModulesNoCard() as $id => $module):
		if ($count % 3 == 0)
			echo '<div class="buttons">';

		echo CHtml::htmlButton(
			Yii::t('checkout', $module),
			array(
				'type' => 'submit',
				'name' => 'PaymentProvider',
				'value' => $id,
			)
		);
		$count++;

		if ($count % 3 == 0)
			echo '</div><div style="margin: 5px 0"> </div>';

	endforeach;
	if ($count % 3 != 0)
		echo '</div>'
	?>

	<div class="or-block"></div>
</div>
<div class="creditcard creditcard-nosubmit">
	<div class="error-holder"><?= $error ?></div>

	<!------------------------------------------------------------------------------------------------------------	CREDIT CARD FORM -------------------------------------------------------------------------------------------------->

	<?php $this->widget('ext.wscreditcardform.wscreditcardform', array('model' => $model, 'form' => $form)); ?>

	<!------------------------------------------------------------------------------------------------------------	CREDIT CARD FORM  ------------------------------------------------------------------------------------------------>

	<!------------------------------------------------------------------------------------------------------------	Layout Markup -------------------------------------------------------------------------------------------------->
	<label class="shippingasbilling">
		<input type="checkbox" checked="checked" value="<?= $checkbox['id'] ?>" onclick="$('.address-form').fadeToggle();$('footer').fadeToggle();" name="<?= $checkbox['name'] ?>"/>
			<span class="text">
				<?php
				echo Yii::t('checkout', $checkbox['label'])
				?>
				<br>
				<span class="address-abbr">
					<?php
					echo $checkbox['address'];
					?>
				</span>
			</span>
	</label>

	<div class="address-form" style="display: none">
		<h4><?php echo Yii::t('checkout','Billing Address'); ?></h4>
		<ol class="address-blocks">
			<?php if(count($model->objAddresses) > 0): ?>
				<?php foreach ($model->objAddresses as $objAddress): ?>
					<li class="address-block address-block-pickable">
						<p class="webstore-label">
							<?php
							echo $objAddress->formattedblockcountry;
							?>
							<span class="controls">
							<a href="#">Edit Address</a> or <a class="delete">Delete</a>
						</span>
						</p>
						<div class="buttons">
							<?php
							echo CHtml::htmlButton(
								Yii::t('checkout', $objAddress->id == $model->intShippingAddress ? 'Use shipping address' : 'Use this address'),
								array(
									'type' => 'submit',
									'class' => $objAddress->id == $model->intBillingAddress ? 'small default' : 'small',
									'name' => 'BillingAddress',
									'id' => 'BillingAddress',
									'onclick' => '$("form").removeClass("error").end().find(".required").remove().end().find(".form-error").remove().end()',
									'value' => $objAddress->id
								)
							);
							?>
						</div>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
			<li class="add">
				<button class="small">Add New Address</button>
			</li>
		</ol>
	</div>
	<!------------------------------------------------------------------------------------------------------------	Layout Markup -------------------------------------------------------------------------------------------------->

	<footer>
		<?php
		echo CHtml::submitButton(
			'Submit',
			array(
				'type' => 'submit',
				'class' => 'button',
				'name' => 'Payment',
				'id' => 'Payment',
				'value' => Yii::t('checkout', "Review and Confirm Order")
			)
		);
		?>
	</footer>

<?php $this->endWidget(); ?>
</div>

<aside class="section-sidebar webstore-sidebar-summary">
	<?php $this->renderPartial('_ordersummary'); ?>
</aside>
