<h1><?php echo Yii::t('checkout', "Payment")?></h1>
<div class="outofbandpayment">
	<div class="buttons">

		<?php echo CHtml::htmlButton(
			Yii::t('checkout', "Pay with PayPal"),
			array(
				'type' => 'button',
				'class' => 'paypal',
			)
		);?>

	</div>
	<div class="or-block"></div>
</div>

<div class="creditcard">
	<div class="card-details">
		<ol class="field-containers field-container-gap">
			<li class="field-container">
				<?php echo $form->labelEx(
					$model,
					'cardNumber',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Credit Card Number')
				);
				echo $form->textField(
					$model,
					'cardNumber',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Credit Card Number"),'class' => "creditcard-number", 'required' => "required")
				);
				?>
			</li>
		</ol>

		<ol class="field-containers field-containers-small cart-details-secondary">
			<li class="field-container">
				<?php echo $form->labelEx(
					$model,
					'cardExpiry',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Expiration')
				);
				echo $form->textField(
					$model,
					'cardExpiry',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "MM / YY"),'size' => "6", 'required' => "required")
				);
				?>
			</li>
			<li class="field-container">
				<?php echo $form->labelEx(
					$model,
					'cardCVV',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'CCV')
				);
				echo $form->textField(
					$model,
					'cardCVV',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "CCV"),'size' => "4", 'required' => "required")
				);
				?>
			</li>
			<li class="card-logo">
				<img src="/images/creditcards/visa.png" class="visa">
				<img src="/images/creditcards/mastercard.png" class="mastercard">
				<img src="/images/creditcards/discover.png" class="discover">
				<img src="/images/creditcards/amex.png" class="amex">
			</li>
		</ol>
	</div>

	<label class="shippingasbilling">
		<?php echo $form->checkBox(
			$model,
			'isShippingAsBilling',
			$htmlOptions = array(
				'boolean',
				'trueValue' => 'on',
				'onclick' => '$(".address-form").fadeToggle();',
				'checked' => "checked"
			)
		);
		?>
		<span class="text">
				<?php echo Yii::t('checkout', "Use my shipping address as my billing address") ?><br>
				<span class="address-abbr">
					<?php
					//Yii::app()->$this->shippingAddressFull
					?>
				</span>
			</span>
	</label>

<!--	end of credit card info section-->


	<h4><?php echo Yii::t('checkout','Billing Address')?></h4>
	<ol class="address-blocks">
		<li class="address-block address-block-pickable">
			<p class="label">
				James Bond, 007<br>
				His Majesty's Secret Service<br>
				Thames Building<br>
				PO Box 500<br>
				London SW1P 1AE, England

							<span class="controls">
								<a href="#">Edit Address</a> or <a class="delete">Delete</a>
							</span>
			</p>

			<div class="buttons">
				<button class="small default">Use this address</button>
			</div>
		</li>
		<li class="address-block address-block-pickable">
			<p class="label">
				The Queen<br>
				Buckingham Palace<br>
				London SW1A 1AA, England

							<span class="controls">
								<a class="small secondary">Edit Address</a> or <a class="delete">Delete</a>
							</span>
			</p>
			<div class="buttons">
				<button class="small">Use this address</button>
			</div>
		</li>
		<li class="address-block address-block-pickable">
			<p class="label">
				The King<br>
				Graveyard<br>
				London SW1A 1AA, England

							<span class="controls">
								<a class="small secondary">Edit Address</a> or <a class="delete">Delete</a>
							</span>
			</p>
			<div class="buttons">
				<button class="small">Use this address</button>
			</div>
		</li>
		<li class="add">
			<button class="small">Add New Address</button>
		</li>
	</ol>
</div>

</form>

