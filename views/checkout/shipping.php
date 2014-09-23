<?php
$form = $this->beginWidget(
	'CActiveForm',
	array(
		'enableClientValidation' => false,
		'htmlOptions' => array('class' => "section-content", 'id' => "shipping", 'novalidate' => '1',
		)
	)
);
?>
<nav class="steps">
	<ol>
		<li class="current"><span class="webstore-label"></span><?php echo Yii::t('checkout', "Shipping")?></li>
		<li class=""><span class="webstore-label"></span><?php echo Yii::t('checkout', "Payment")?></li>
		<li class=""><span class="webstore-label"></span><?php echo Yii::t('checkout', "Confirmation")?></li>
	</ol>
</nav>
<h1><?php echo Yii::t('checkout', 'Shipping'); ?></h1>
<div class="shipping-instore">
	<label class="checkbox">
		<?php echo $form->checkBox(
			$model,
			'shippingProvider',
			$htmlOptions = array(
				'class'=>'instore-toggle',
				'onclick' => 'updateShippingPriority(this.value)',
				'separator'=>'')
		); ?>
		<strong><?php echo Yii::t('checkout','In-Store Pickup'); ?></strong>

		<p class="description">
			<?php echo Yii::t('checkout',"Near our store? You can pickup your order. We'll email you as soon as your items are ready."); ?>
		</p>

	</label>

	<div class="shipping-instore-details modal-conditional-block">
		<h4>
			<?php
			echo Yii::t('global','Store Details');
			?>
		</h4>
		<p class="contact-info">
			<?php
			$objAddress = CustomerAddress::StoreAddress();
			echo $objAddress->htmlblock;
			?>
		</p>

		<p class="contact-info">
			<?php
			echo Yii::t('checkout', _xls_get_conf('STORE_HOURS'));
			?>
		</p>

		<ol class="field-containers-small" style="overflow:visible">
			<li class="field-container">
				<label class="placeheld">
					<?php
					echo Yii::t('checkout', "Name");
					?>
				</label>
				<?php
				echo $form->textField(
					$model,
					'pickupPerson',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Person picking up"),'required' => "required", 'autofocus' => "autofocus")
				);?>
			</li>
		</ol>
		<p class="tip"><?php echo Yii::t('checkout',"We'll contact this person when the order is ready."); ?></p>

		<ol class="field-containers-small field-container-gap">
			<li class="field-container field-container-nobottomborder">
				<label class="placeheld"><?php echo Yii::t('global', "Email")?></label>
				<?php
				echo $form->emailField(
					$model,
					'pickupPersonEmail',
					$htmlOptions = array('placeholder' => Yii::t('cart', "Email"))
				);
				?>
				<p class="hint"><?php echo Yii::t('checkout', "Optional")?></p>
			</li>
			<li class="field-container">
				<label class="placeheld"><?php echo Yii::t('checkout', "Mobile Phone")?></label>
				<?php
				echo $form->telField(
					$model,
					'pickupPersonPhone',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Mobile Phone"))
				);
				?>
				<p class="hint"><?php echo Yii::t('checkout', "Optional")?></p>
			</li>
		</ol>
		<footer class="submit submit-small">

			<?php
			echo CHtml::submitButton(
				'Submit',
				array(
					'type' => 'submit',
					'class' => 'button',
					'value' => Yii::t('checkout', "Proceed to Payment"),
				)
			); ?>
		</footer>
	</div>
</div>

<div class="modal-conditional-block active">
	<div class="or-block"></div>
	<h3><?php echo Yii::t('checkout', "Shipping Address")?></h3>
	<div class="address-form">
		<div class="error-holder">
			<?php echo $error; ?>
		</div>
		<ol class="field-containers-small field-container-gap">
			<li class="field-container field-container-narrowed">
				<label class="placeheld"><?php Yii::t('checkout', "Recipient Name")?></label>
				<?php
				echo $form->textField(
					$model,
					'recipientName',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Recipient Name"),'required' => "required", 'autofocus' => "autofocus")
				);
				?>
			</li>
			<li class="field-container-endcap">
				<a href="#" onclick="$('.field-container-narrowed').removeClass('field-container-narrowed'); $('.company-container').fadeIn(); $('.company-container').find('input').focus(); $('.field-container-endcap').remove(); return false;">Company</a>
			</li>
			<li class="field-container company-container" style="display: none;">
				<label class="placeheld"><?php Yii::t('checkout', "Company")?></label>
				<?php
				echo $form->textField(
					$model,
					'shippingCompany',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Company"),'required' => "required")
				);
				?>
			</li>
		</ol>
		<ol class="field-containers-small field-container-gap">
			<li class="field-container field-container-nobottomborder">
				<?php
				echo $form->labelEx(
					$model,
					'shippingAddress1',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Address 1')
				);
				echo $form->textField(
					$model,
					'shippingAddress1',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Mailing address"),'required' => "required")
				);
				?>
			</li>
			<li class="field-container">
				<?php
				echo $form->labelEx(
					$model,
					'shippingAddress2',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Address 2')
				);
				echo
				$form->textField(
					$model,
					'shippingAddress2',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Suite, Floor, etc."))
				);
				?>
			</li>
			<li class="fieldgroup">
				<ol>
					<li class="field-container">
						<?php
						echo $form->labelEx(
							$model,
							'shippingPostal',
							$htmlOptions = array('class' => 'placeheld'),
							array('label' => 'Zip')
						);
						echo $form->textField(
							$model,
							'shippingPostal',
							$htmlOptions = array('size' => '10', 'placeholder' => Yii::t('checkout', "Zip Code"), 'required' => "required" ),
							array(
								'ajax' => array(
									'type' => 'POST',
									'dataType' => 'json',
									'url' => CController::createUrl('cart/settax'),
									'success' => 'js:function(data){ updateTax(data) }',
									'data' => 'js:{"'.'state_id'.'": $("#'.CHtml::activeId($model,'shippingState').
										' option:selected").val(),
										"'.'postal'.'": $("#'.CHtml::activeId($model,'shippingPostal').'").val()}',
								)
							)
						);
						?>
					</li>
					<li class="field-container" id="ChooseCity">
						<?php
						echo $form->labelEx(
							$model,
							'shippingCity',
							$htmlOptions = array('class' => 'placeheld'),
							array('label' => 'City')
						);
						echo $form->textField(
							$model,
							'shippingCity',
							array('size' => '14', 'placeholder' => Yii::t('checkout', "City"), 'required' => 'required')
						);
						?>
					</li>
					<li class="field-container">
						<?php
						echo $form->labelEx(
							$model,
							'shippingState',
							$htmlOptions = array('class' => 'placeheld'),
							array('label' => 'State')
						);
						echo $form->textField(
							$model,
							'shippingState',
							array('size' => '5', 'placeholder' => Yii::t('checkout', "State"), 'required' => 'required')
						);
						?>
					</li>
					<li class="field-container field-container-select field-container-select-no-handle country">
						<?php
						echo $form->dropDownList(
							$model,
							'shippingCountry',
							$model->getCountries(),
							$htmlOptions = array('class' => 'modal-accent-color', 'options' => $this->countryCodes)
						);
						?>
					</li>
				</ol>
			</li>

		</ol>
		<ol class="field-containers-small">
			<li class="field-container">
				<?php echo $form->labelEx(
					$model,
					'contactPhone',
					$htmlOptions = array('class' => 'placeheld'),
					array('label' => 'Phone')

				);
				echo $form->textField(
					$model,
					'contactPhone',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Phone"))
				);
				?>
				<p class="hint">
					<?php echo Yii::t('checkout', "Optional"); ?>
				</p>
			</li>
		</ol>
		<p class="tip"><?php echo Yii::t('checkout', "May be printed on label to assist delivery.") ?></p>
		<footer class="submit submit-small">
			<?php
			echo CHtml::submitButton(
				'Submit',
				array(
					'type' => 'submit',
					'class' => 'button',
					'value' => Yii::t('checkout', "See Shipping Options"),
				)
			);
			?>
		</footer>
	</div>
</div>

<?php $this->endWidget();?>

<aside class="section-sidebar webstore-sidebar-summary">
	<?php $this->renderPartial('_ordersummary'); ?>
</aside>

