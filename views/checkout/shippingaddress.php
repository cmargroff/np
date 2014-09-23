<?php
$form = $this->beginWidget(
	'CActiveForm',
	array('htmlOptions' => array('class' => "section-content",'id' => "shipping", 'novalidate' => '1')
	)
);
?>
<nav class="steps">
	<ol>
		<li class="current"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Shipping')?></li>
		<li class=""><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Payment')?></li>
		<li class=""><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Confirmation')?></li>
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
			echo _xls_get_conf('STORE_HOURS');
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
			<li class="field-container">
				<label class="placeheld"><?php echo Yii::t('global', "Email")?></label>
				<?php
				echo $form->emailField(
					$model,
					'pickupPersonEmail',
					$htmlOptions = array('placeholder' => Yii::t('cart', "Email"))
				); ?>
				<p class="hint"> <?php echo Yii::t('checkout', "Optional")?></p>
			</li>
			<li class="field-container field-container-nobottomborder">
				<label class="placeheld"><?php echo Yii::t('checkout', "Mobile Phone")?></label>
				<?php
				echo $form->telField(
					$model,
					'pickupPersonPhone',
					$htmlOptions = array('placeholder' => Yii::t('checkout', "Mobile Phone"))
				); ?>
				<p class="hint"><?php Yii::t('checkout', "Optional")?></p>
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
<!------------------------------------------------------------------------------------------------------------	Layout Markup -------------------------------------------------------------------------------------------------->
<div class="modal-conditional-block active">
	<div class="or-block"></div>
	<div class="error-holder"><?= $error ?></div>
	<h3><?php echo Yii::t('checkout','Shipping Address'); ?></h3>
	<ol class="address-blocks">
		<?php if(count($model->objAddresses)>0): ?>
			<?php foreach ($model->objAddresses as $key => $objAddress): ?>
				<li class="address-block address-block-pickable">
					<p class="webstore-label">
						<?php
						echo $objAddress->formattedblockcountry;
						?>
						<span class="controls">
							<a href="/checkout/shipping">Edit Address</a> or <a class="delete">Delete</a>
						</span>
					</p>
					<div class="buttons">
						<button name="Address_id" value="<?= $objAddress->id ?>" class="small <?= $key == 0 ? 'default' : ''; ?>">Ship to this address</button>
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
<?php $this->endWidget();?>
<aside class="section-sidebar webstore-sidebar-summary">
	<?php $this->renderPartial('_ordersummary'); ?>
</aside>
