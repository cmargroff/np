<?php
$form = $this->beginWidget(
	'CActiveForm',
	array(
		'action' => array('/checkout/confirmation'),
		'enableClientValidation' => false,
		'htmlOptions' => array('class' => "section-content",'id' => "payment", 'novalidate' => '1',
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

<h1><?php echo Yii::t('checkout', 'Payment')?></h1>

<div class="outofbandpayment">
	<?php
	$count = 0;
	foreach ($model->getSimPaymentModules() as $id => $module):
		if ($count % 3 == 0)
			echo '<div class="buttons">';

		echo CHtml::htmlButton(
			Yii::t('checkout', $module),
			array(
				'type' => 'submit',
				'name' => 'CheckoutForm[paymentProvider]',
				'value' => $id
			)
		);
		$count++;

		if ($count % 3 == 0)
			echo '</div><div style="margin: 5px 0"> </div>';

	endforeach;
	if ($count % 3 != 0)
		echo '</div>'
	?>


<!------------------------------------------------------------------------------------------------------------	Layout Markup -------------------------------------------------------------------------------------------------->

	<div class="or-block"></div>
</div>

<div class="creditcard">
	<h3><?php echo Yii::t('checkout', "Pay with Credit Card")?></h3>
	<p class="large"><?php echo Yii::t('checkout', "Review and confirm your order. You'll be forwarded to our secure payment partner to enter your credit cart details.")?></p>


<!------------------------------------------------------------------------------------------------------------	Layout Markup -------------------------------------------------------------------------------------------------->
	<label class="shippingasbilling">
		<?php echo $form->checkBox(
			$model,
			'billingSameAsShipping',
			$htmlOptions = array(
				'boolean',
				'trueValue' => 'on',
				'onclick' => '$(".address-form").fadeToggle();',
				'checked' => "checked"
			)
		);
		?>
		<span class="text" id="payment">
				<?php
				echo Yii::t('checkout', "Use my shipping address as my billing address")
				?>
			<br>
				<span class="address-abbr">
					<?php
					echo $model->strShippingAddress;
					?>
				</span>
			</span>
	</label>
	<div class="address-form" style="display: none;">
		<h4><?php echo Yii::t('checkout', "Billing Address ") ?></h4>
		<ol class="field-containers-small field-container-gap">
			<li class="field-container field-container-nobottomborder">
				<?php echo $form->labelEx(
					$model,
					'billingAddress1',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Address 1')
				);
				echo $form->textField(
					$model,
					'billingAddress1',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Mailing address"), 'required' => "required")
				);
				?>
			</li>
			<li class="field-container">
				<?php echo $form->labelEx(
					$model,
					'billingAddress2',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Address 2')
				);
				echo $form->textField(
					$model,
					'billingAddress1',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Suite, Floor, etc."))
				);
				?>
			</li>
			<li class="fieldgroup">
				<ol>
					<li class="field-container">
						<?php echo $form->labelEx(
							$model,
							'billingPostal',
							$htmlOptions = array('class' => 'placeheld'),
							array('label' => 'Zip')
						);
						echo $form->textField(
							$model,
							'billingPostal',
							$htmlOptions = array('placeholder' => Yii::t('checkout', "Zip Code"),'size' => "10", 'required' => "required")
						);
						?>
					</li>
					<li class="field-container field-container-select"  style="display: none;">



						<!--TODO select city/State-->
						<label class="placeheld">City / State</label>
						<select name="city_state"></select>
						<!--TODO select city/State-->
					</li>

					<!--TODO confirm whether we need all of these in the getdestinationstates-->
					<li class="field-container field-container-select field-container-select-no-handle country">
						<?php
						echo $form->dropDownList($model,
							'shippingCountry',
							$model->getCountries(),
							$htmlOptions = array('class' => 'modal-accent-color'),
							array(
								'ajax' => array(
									'type'=>'POST',
									'url'=>CController::createUrl('cart/getdestinationstates'),
									'success'=>'js:function(data){
											$("#' . CHtml::activeId( $model, 'shippingState') .'").html(data);
											$("#' . CHtml::activeId( $model, 'shippingProvider') .'").html("");
											$("#' . CHtml::activeId( $model, 'shippingPriority') .'").html(""); }',
									'data' => 'js:{"'.'country_id'.'": $("#'.CHtml::activeId($model,'shippingCountry').
										' option:selected").val()}',)
							)
						);?>
					</li>
				</ol>
		</ol>
	</div>

<footer class="submit">
	<?php
	echo CHtml::submitButton(
		'Submit',
		array(
			'type' => 'submit',
			'class' => 'button',
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
