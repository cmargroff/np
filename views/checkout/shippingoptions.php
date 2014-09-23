<?php
$form = $this->beginWidget(
	'CActiveForm',
	array(
		'htmlOptions' => array(
			'class' => "section-content",
			'id' => "shipping",
			'novalidate' => '1'
		)
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
	<h1><?php echo Yii::t('checkout','Shipping'); ?></h1>
	<p class="introduction">
		<?php
		echo Yii::t('checkout', "Confirm your shipping address and choose your preferred shipping method.");
		?>
	</p>
	<div class="address-block address-block-alter">
		<p class="webstore-label">
			<?php
			echo $model->recipientName . '<br>' . $model->htmlShippingAddress;
			?>
		</p>
		<button class="small">
			<?php
			echo CHtml::link(Yii::t('cart','Change Address'), Yii::app()->user->IsGuest ? '/checkout/shipping/' : '/checkout/shippingaddress');
			?>
		</button>
	</div>
	<h3><?php echo Yii::t('checkout','Shipping Options'); ?></h3>
<div class="error-holder">
	<?php echo $error; ?>
</div>
	<table class="shipping-options">
		<thead>
			<tr>
				<th>
					<?php
					echo Yii::t('checkout', 'Shipping Method');
					?>
				</th>
			</tr>
		</thead>
		<?php
		echo $form->radioButtonList(
			$model,
			'shippingPriority',
			$model->shippingOptionsOnly,
			array(
				'template' => '<tr><td>{input} {label}</td></tr>',
				'separator' => '',
				'labelOptions' => array('style' => 'display: inline; font-weight: bold'),
				'style' => 'vertical-align: baseline;'
			)
		);
		?>
	</table>

	<footer class="submit submit-small">
		<?php
		echo CHtml::submitButton(
			'Submit',
			array(
				'type' => 'submit',
				'class' => 'button',
				'value' => Yii::t('checkout', "Proceed to Payment")
			)
		);
		?>
	</footer>

<?php $this->endWidget(); ?>

<aside class="section-sidebar webstore-sidebar-summary">
	<?php $this->renderPartial('_ordersummary'); ?>
</aside>












