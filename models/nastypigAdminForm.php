<?php

class nastypigAdminForm extends ThemeForm
{

	/*
	 * Information keys that are used for display in Admin Panel
	 * and other functionality.
	 *
	 * These can all be accessed by Yii::app()->theme->info->keyname
	 *
	 * for example: echo Yii::app()->theme->info->version
	 */
	protected $name = "Nastypig";
	protected $thumbnail = "np.png";
	protected $version = 1;
	protected $description = "Our new default template, suitable for any type of business.";
	protected $credit = "Designed by LightSpeed";
	protected $useCustomFolderForCustomcss = false;
	protected $parent = "brooklyn"; //Used when a theme is a copy of another theme to control inheritance
	protected $bootstrap = null;
	protected $viewset = "cities3";
	protected $cssfiles = "base,style,light,_2014";
	protected $GoogleFonts = "Dosis:700,500,400|Ropa+Sans"; // use this value to load Google Fonts for your design, i.e. $GoogleFonts = "Tangerine|Inconsolata|Droid+Sans"
	protected $newCheckout = true;

	/*
	 * IMAGE SIZES
	 */
	protected $DETAIL_IMAGE_WIDTH = 256; //Image size used on product detail page
	protected $DETAIL_IMAGE_HEIGHT = 256;
	protected $LISTING_IMAGE_WIDTH = 190; //Image size used on grid view
	protected $LISTING_IMAGE_HEIGHT = 190;
	protected $MINI_IMAGE_WIDTH = 30; //Image size used in shopping cart
	protected $MINI_IMAGE_HEIGHT = 30;
	protected $PREVIEW_IMAGE_WIDTH = 45;
	protected $PREVIEW_IMAGE_HEIGHT = 45;
	protected $SLIDER_IMAGE_WIDTH = 90; //Image used on a slider appearing on a custom page
	protected $SLIDER_IMAGE_HEIGHT = 90;


	/*
	 * Define any keys here that should be available for the theme
	 * These can be accessed via Yii::app()->theme->config->keyname
	 *
	 * for example: echo Yii::app()->theme->config->CHILD_THEME
	 *
	 * The values specified here are defaults for your theme
	 *
	 * keys that are in ALL CAPS are written as xlsws_configuration keys as well for
	 * backwards compatibility.
	 *
	 * If you wish to have values that are part of config, but not available to the user (i.e. hardcoded values),
	 * you can add them to this as well. Anything "public" will be saved as part of config, but only
	 * items that are listed in the getAdminForm() function below are available to the user to change
	 *
	 */

	public $activecss = array('base','style','light', '_2014'); //Required for fresh installations
	public $CHILD_THEME = "light"; //Required, to be backwards compatible with CHILD_THEME key
	public $PRODUCTS_PER_PAGE = 12;


	public $disableGridRowDivs = true;
	//public $testvar;

	public $menuposition = "left";
	public $column2file = "column2";


	// cart and checkout variables
	/**
	 * Users may want to use a different logo from their
	 * header/banner image on these pages. This variable
	 * stores the path to that logo.
	 *
	 * @var $imgLogo
	 * @type string
	 */

	public $strPathImgLogo;

	/**
	 * Path to the full screen background image
	 *
	 * @var $imgBackground
	 * @type string
	 */

	public $strPathImgBackground;


	/**
	 * Hex code of the background color
	 *
	 * @var $colorBackground
	 * @type string
	 */

	public $colorBackground;


	/**
	 * Hex code of the background text color
	 *
	 * @var $colorTextBackground
	 * @type string
	 */

	public $colorTextBackground;


	/**
	 * Hex code of color of buttons and links
	 *
	 * @var $colorButtonsAndLinks
	 * @type string
	 */

	public $colorButtonsAndLinks;


	/**
	 * Hex code of the color of the text displayed
	 * that confirms item was added to the cart
	 *
	 * @var $colorTextConfirmation
	 * @type string
	 */

	public $colorTextConfirmation;


	/**
	 * Heading Font Url
	 *
	 * @var $fontUrlHeading
	 * @type string
	 */

	public $fontUrlHeading;


	/**
	 * Text font url
	 *
	 * @var $fontUrlText
	 * @type string
	 */

	public $fontUrlText;


	/**
	 * Url to generate the preview modal window
	 *
	 * @var $previewLink
	 * @type string
	 */


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('CHILD_THEME','required'),
			array('strPathImgBackground, strPathImgLogo', 'safe'),
			array('colorBackground, colorTextBackground, colorButtonsAndLinks, colorTextConfirmation', 'safe'),
			array('fontUrlHeading, fontUrlText', 'safe'),
		);
	}


	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'CHILD_THEME'=>ucfirst(_xls_regionalize('color')).' set',
			'strPathImgLogo' => 'Checkout Logo Image',
			'strPathImgBackground' => 'Checkout Background Image',
			'colorBackground' => 'Checkout Background Color',
			'colorTextBackground' => 'Checkout Background Text Color',
			'colorButtonsAndLinks' => 'Checkout Button & Link Text Color',
			'colorTextConfirmation' => 'Checkout Confirmation Text Color',
			'fontUrlHeading' => 'Checkout Font URL for Headers',
			'fontUrlText' => 'Checkout Font URL for Text',
		);
	}

	/*
	 * Form definition here
	 *
	 * See http://www.yiiframework.com/doc/guide/1.1/en/form.builder#creating-a-simple-form
	 * for additional information
	 */
	public function getAdminForm()
	{

		return array(
			//'title' => 'Set your funky options for this theme!',

			'elements'=>array(
				'CHILD_THEME'=>array(
					'type'=>'dropdownlist',
					'items'=>array('light'=>'Light'),
				),

				'strPathImgLogo' => array(
					'type' => 'dropdownlist',
					'items' => array(0 => '') + Gallery::ImageList(1)
				),
				'strPathImgBackground' => array(
					'type' => 'dropdownlist',
					'items' => array(0 => '') + Gallery::ImageList(1)
				),
				'colorBackground' => array(
					'type' => 'ext.SMiniColors.SActiveColorPicker',
				),
				'colorTextBackground' => array(
					'type' => 'ext.SMiniColors.SActiveColorPicker',
				),
				'fontUrlHeading' => array(
					'type' => 'text'
				),
				'fontUrlText' => array(
					'type' => 'text'
				),
				'colorButtonsAndLinks' => array(
					'type' => 'ext.SMiniColors.SActiveColorPicker',
				),
				'colorTextConfirmation' => array(
					'type' => 'ext.SMiniColors.SActiveColorPicker',
				),
			),
		);
	}




}
