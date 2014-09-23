<?php $this->beginContent('/layouts/checkout-main'); ?>
<div id="wrapper">
		<div class="webstore-overlay webstore-modal-overlay webstore-overlay-aside webstore-checkout" id="checkout">
			    <section>
				    <header class="overlay">
					    <h1>
						    <a href="/" class="logo-placement">
							    <span class="registered-name"><?php echo Yii::app()->params['STORE_NAME']; ?></span>
						    </a>
					    </h1>
					    <?php echo CHtml::link(Yii::t('cart','Continue Shopping'), '/', array('class' => 'exit')); ?>
				    </header>

				    <div class="section-inner">

					    <?php echo $content; ?>

				    </div>

				    <footer>
					    <p>
						    <?php
						    if (Yii::app()->params['ENABLE_SSL'] == 1)
							    echo CHtml::tag(
								    'p',
								    array(),
								    CHtml::image(
									    '/images/lock.png',
									    'lock image ',
									    array(
										    'height'=> 14
									    )
								    ).
								    CHtml::tag('strong',array(),'Safe &amp; Secure ').
								    'Bank-grade SSL encryption protects your purchase'
							    );
						    ?>
						    <a href="/privacy-policy" target="_blank">Privacy Policy</a>
					    </p>
				    </footer>
				</section>
		</div>
</div>


<?php $this->endContent(); ?>
