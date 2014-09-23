<div id="topbar" class="row-fluid page-header">
	<div class="span9">
	<!-- template header -->
		<div id="headerimage" class="logo">
			<?php echo CHtml::link(CHtml::image($this->pageHeaderImage),$this->createUrl("site/index")); ?>
		</div>

		<ul>
			<li>
				<a href="/editcart"><em>Cart</em>
					<small>
						<span id="cartItemsTotal">
							<?php
								echo Yii::app()->shoppingcart->totalItemCount;
							?>
						</span>
					</small>
				</a>
			</li>

			<!-- login Register -->
			<?php if(Yii::app()->user->isGuest && !Yii::app()->shoppingcart->itemCount):
				echo "<li>".CHtml::link(Yii::t('global', 'Login'), array("site/login"))."</li>";
				echo "<li>".CHtml::link(Yii::t('global', 'Register'), array("/myaccount/edit"))."</li>";
			elseif(Yii::app()->user->isGuest && Yii::app()->shoppingcart->itemCount):
				echo "<li>".CHtml::link(Yii::t('global', 'Checkout'), array("/checkout"))."</li>";
			elseif(!Yii::app()->user->isGuest && !Yii::app()->shoppingcart->itemCount):
				echo "<li>".CHtml::link(Yii::t('global', 'Account'), array("/myaccount"))."</li>";
				echo "<li>".CHtml::link(Yii::t('global', 'Logout'), array("site/logout"))."</li>";
			else:
				echo "<li>".CHtml::link(Yii::t('global', 'Account'), array("/myaccount"))."</li>";
				echo "<li>".CHtml::link(Yii::t('global', 'Logout'), array("site/logout"))."</li>";
			endif; ?>

			<!-- wish Lists -->
			<?php if(Yii::app()->user->isGuest):
				echo "<li>".CHtml::link(Yii::t('global', 'Wish Lists'), array("wishlist/search"))."</li>";
			else:
				echo "<li>".CHtml::link(Yii::t('global', 'Wish Lists'), array("/wishlist"))."</li>";
			endif; ?>
		</ul>
</div>
	<div class="span3">
		<?php if(_xls_get_conf('LANG_MENU',0)): ?>
			<div id="langmenu">
				<?php $this->widget('application.extensions.'._xls_get_conf('PROCESSOR_LANGMENU').'.'._xls_get_conf('PROCESSOR_LANGMENU')); ?>
				</div>
		<?php endif; ?>
	</div>
</div>
