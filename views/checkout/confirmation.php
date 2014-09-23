<div class="section-content" id="confirm">
	<nav class="steps">
		<ol>
			<li class="completed"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Shipping')?></li>
			<li class="completed"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Payment')?></li>
			<li class="current"><span class="webstore-label"></span><?php echo Yii::t('checkout', 'Confirmation')?></li>
		</ol>
	</nav>
	<h1><?php echo Yii::t('checkout', 'Confirm Your Order')?></h1>
	<?php
		$form = $this->beginWidget(
			'CActiveForm',
			array(
				'htmlOptions' => array('novalidate' => '1'
				)
			)
		);
	?>
	<div class="error-holder"><?= $error ?></div>
	<div class="final-confirmation" style="border-bottom: 1px solid #ddd; padding-bottom: 30px;">
		<?php
		echo CHtml::htmlButton(
			Yii::t('checkout', 'Place Order'),
			array('class' => 'button', 'id' => 'place-order', 'type'=>'submit', 'name' => 'Confirmation')
		);?>
		<label class="checkbox">
			<?php
			echo $form->checkBox(
				$model,
				'receiveNewsletter',
				$htmlOptions = array('checked'=> Yii::app()->params['DISABLE_ALLOW_NEWSLETTER'] ? '' : 'checked')
			);
			?>
			<?php echo Yii::t('checkout',"I'd like to receive special offers and product information by email"); ?>
		</label>
		<div class="comments">
			<a href="#" onclick="$('.comments a').hide(); $('.comments textarea').fadeToggle().focus(); return false;">Add a comment or special request</a>
			<textarea placeholder="Enter your comment or special request"></textarea>
		</div>
		<p class="terms">
			<?php echo Yii::t('checkout','By clicking "Place Order" you agree to our ');
			echo CHtml::link(
				Yii::t('checkout', 'Terms and Conditions'),
				array("/terms-and-conditions"),
				array('target' => "_blank" )
			);
			echo $form->checkBox(
				$model,
				'acceptTerms',
				$htmlOptions = array('checked'=> 'checked', 'style' => 'display: none')
			);
			?>
		</p>
	</div>
	<?php

	echo $form->hiddenField($model, 'billingSameAsShipping');
	echo $form->hiddenField($model, 'intBillingAddress');
	echo $form->hiddenField($model, 'billingAddress1');
	echo $form->hiddenField($model, 'billingAddress2');
	echo $form->hiddenField($model, 'billingCity');
	echo $form->hiddenField($model, 'billingState');
	echo $form->hiddenField($model, 'billingPostal');
	echo $form->hiddenField($model, 'billingCountry');
	echo $form->hiddenField($model, 'paymentProvider');
	echo $form->hiddenField($model, 'cardNameOnCard');
	echo $form->hiddenField($model, 'cardNumber');
	echo $form->hiddenField($model, 'cardCVV');
	echo $form->hiddenField($model, 'cardExpiryMonth');
	echo $form->hiddenField($model, 'cardExpiryYear');
	echo $form->hiddenField($model, 'cardType');

	$this->endWidget();
	?>

	<?php $this->renderPartial('_orderdetails', array('cart' => Yii::app()->shoppingcart)); ?>


	<article class="cart">
		<?php
		$this->widget(
			'zii.widgets.grid.CGridView', array(
				'htmlOptions'=> array('class'=>'lines lines-container'),
				'id' => 'user-grid',
				'itemsCssClass' => 'lines',
				'dataProvider' => Yii::app()->shoppingcart->dataProvider,
				'summaryText' => '',
				'columns' => array(
					array(
						'type'=>'raw',
						'value'=>'"<strong>".$data->qty."</strong>".CHtml::numberField("CartItem_qty[$data->id]",$data->qty,array(
	                                        "data-pk"=>$data->id,
	                                        "size" => "2",
	                                        "onchange" =>"updateCart(this)",
	                                    ))',
						'htmlOptions' => array(
							'class' => 'quantity',
							'size'=>'2'
						),
					),
					//TODO:use renderSellPrice to render formatted unit price with strike through...
					array(
						'type'=>'raw',
						'value'=>'CHtml::image(
						   Images::GetLink($data -> product -> image_id,ImagesType::slider))
						   .CHtml::tag("td",array("class" => "description"),
						   CHtml::link("<strong>".$data -> product->title." "."</strong>"
						   ."<span class=\'price\'> ".$data->sellFormatted."ea</span> ", $data -> product->Link, array())
						   )',
						'htmlOptions' => array(
							'class' => 'image'
						),
					),
					array(
						'type' => 'raw',
						'value'=>'CHtml::link("Edit","#",array(
//									"data-pk"=>$data->id,"class"=>"edit", "onclick"=>"$(this).closest(\'tr\').addClass(\'active\'); $(this).closest(\'input\').focus();  return false;")
									"data-pk"=>$data->id,"class"=>"edit", "onclick"=>"$(this).closest(\'tr\').addClass(\'active\'); $(this).closest(\'input\').focus();")
									).CHtml::link("&times;","#",array("data-pk"=>$data->id,"class"=>"remove", "onclick"=>"removeItem(this)"))',
						'htmlOptions' => array(
							'class' => 'controls'
						),

					),
					array(
						'type' => 'raw',
						'value' => '$data->sellTotalFormatted',
						'htmlOptions' => array(
							'class' => 'subtotal'
						),
					),
				),
				'rowHtmlOptionsExpression' => 'array("id" => "cart_row_".$data->id)',
			)
		);
		?>

		<div class="lines-footer">
			<form class="promo">
				<?php
				echo CHtml::tag(
					'div',
					array(
						'id' => CHtml::activeId('Confirmation','promoCode') . '_em_',
						'class' => 'form-error',
						'style' => 'display: none'
					),
					'<p>&nbsp;</p>'
				);?>
				<div style="position:relative;">
					<?php
					echo CHtml::textField(
						CHtml::activeId('Confirmation','promoCode'),
						(Yii::app()->shoppingcart->promoCode !== null ? Yii::app()->shoppingcart->promoCode : ''),
						array(
							'placeholder' => Yii::t('cart','Promo Code'),
							'onkeypress' => 'return ajaxTogglePromoCodeEnterKey(event, ' .
								json_encode(CHtml::activeId('Confirmation','promoCode')) .
								');'
						)
					);
					echo CHtml::htmlButton (
						Yii::app()->shoppingcart->promoCode !== null ? Yii::t('cart', 'Remove') : Yii::t('cart', 'Apply'),
						array(
							'type' => 'button',
							'class' => 'inset' . ' promocode-apply' . (Yii::app()->shoppingcart->promoCode !== null ? ' promocode-applied' : ''),
							'style' => 'position:absolute;',
							'onclick' => 'ajaxTogglePromoCode(' .
								json_encode(CHtml::activeId('Confirmation','promoCode')) .
								');'
						)
					);
					?>
				</div>
				<div class="form-error" style="display: none">
					<p>something bad happened...</p>
				</div>
				<p class="description"><?php echo Yii::t('cart','Specials, promotional offers and discounts') ?></p>
			</form>

			<table class="totals">
					<tbody>
					<tr id="PromoCodeLine" class="<?php echo Yii::app()->shoppingcart->promoCode ? 'webstore-promo-line' : 'webstore-promo-line hide-me';?>" >
						<th colspan='3'>
							<?php echo Yii::t('cart','Promo & Discounts')." <td id=\"PromoCodeStr\">" . Yii::app()->shoppingcart->totalDiscountFormatted; ?></td>
						</th>
					</tr>
					<tr>
						<th colspan='3'><?php echo Yii::t('cart','Shipping'); ?>
							<small><?php echo Yii::app()->shoppingcart->shipping->shipping_data; ?></small>
						</th>
						<!--							TODO: get shipping total-->
						<td><?php echo _xls_currency(Yii::app()->shoppingcart->shipping_sell) ?></td>
					</tr>
					<tr>
						<th colspan='3'><?php echo Yii::t('cart','Tax'); ?>
<!--							TODO: get tax rate-->
<!--							<small>--><?php //echo Yii::app()->shoppingcart->TaxRate; ?><!--</small>-->
						</th>
						<td><?php echo _xls_currency(Yii::app()->shoppingcart->TaxTotal); ?></td>
					</tr>
					<tr class="total">
						<th colspan='3'><?php echo Yii::t('cart','Total'); ?></th>
						<td id="CartTotal"><?php echo _xls_currency(Yii::app()->shoppingcart->total); ?></td>
					</tr>
					</tbody>
			</table>
		</div>
	</article>
</div>

<?php
Yii::app()->clientScript->registerScript(
	'editable',
	"
	function removeItem(input) {
		var pk = input.getAttribute('data-pk');
		input.id = 'CartItem_qty_' + pk;
		input.value = 0;
		updateCart(input);
	};
   function updateCart(input) {
			var pk = input.id;
			var obj = {'YII_CSRF_TOKEN': '".Yii::app()->request->csrfToken."'};
					obj[pk] = input.value;

                    $.ajax({url: '".Yii::app()->controller->createUrl('cart/updatecart')."',
                            type: 'POST',
                            dataType: 'json',
                            success: function(data) {
                                if(data.action=='success') {
                                    redrawCart(JSON.parse(data.cartitems));
                                }
	                            else if(data.errorId === 'invalidQuantity'){
                                    var qty = $('#' + pk);
                                    qty.val(data.availQty);
                                    checkout.tooltip.createTooltip(pk, '<strong>Only ' + data.availQty + ' are available at this time.</strong><br> If you&quot;d like to order more please return at a later time or contact us.');
                                }
                                else {
                                    alert(data.errormsg);
                                }
                            },
							error: function(data) { alert('error'); },
							data: obj
					});

			}",
	CClientScript::POS_HEAD
);
?>
