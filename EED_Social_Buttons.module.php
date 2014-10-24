<?php
/**
 * This file contains the main social_buttons class for adding social buttons to EE.
 *
 * @since %VER%
 * @package EE Social_Buttons
 * @subpackage main
 */

/**
 * Main class used for setting up all hooks etc used for adding social buttons to EE
 *
 * @since %VER%
 * @package EE Social_Buttons
 * @subpackage main
 * @author Seth Shoultes
 */
class EED_Social_Buttons {

	/**
	 * contains all hooks used for social_buttons
	 *
	 * @since %VER%
	 *
	 * @return void
	 */
	public static function set_hooks() {

		//Facebook
		//add_action( 'AHEE__thank_you_page_overview_template__content', array( __CLASS__, 'ee_social_thank_you_fb'), 10, 1 );
		add_action( 'AHEE__thank_you_page_overview_template__bottom', array( __CLASS__, 'ee_social_thank_you_fb'), 10, 1 );

	}

	/**
	  *    run - initial module setup
	  *
	  * @access    public
	  * @param  WP $WP
	  * @return    void
	  */
	 public function run( $WP ) {
		 add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
	 }


	/**
	 * 	enqueue_scripts - Load the scripts and css
	 *
	 *  @access 	public
	 *  @return 	void
	 */
	public function enqueue_scripts() {
		//Check to see if the new_addon JS file exists in the '/uploads/espresso/' directory
		if ( is_readable( EVENT_ESPRESSO_UPLOAD_DIR . "scripts/espresso_social_buttons.js")) {
			//This is the url to the JS file if available
			wp_register_script( 'espresso_social_buttons', EVENT_ESPRESSO_UPLOAD_URL . 'scripts/espresso_social_buttons.js', array( 'jquery' ), EE_SOCIAL_BUTTONS_VERSION, TRUE );
		} else {
			wp_register_script( 'espresso_social_buttons', EE_SOCIAL_BUTTONS_URL . 'scripts/espresso_social_buttons.js', array( 'jquery' ), EE_SOCIAL_BUTTONS_VERSION, TRUE );
		}
		
	}


	//Facebook
	public static function ee_social_thank_you_fb($transaction) {
		//Debug
		//d($transaction);
		
		//Get the Twitter handle, else use EventEspresso as the default
		$co_twitter = EE_Registry::instance()->CFG->organization->twitter;
		if (!empty($co_twitter)){
			$urlparts = array("twitter.com/","http://","https://");
			$co_twitter = str_replace($urlparts, "", $co_twitter);
		}else{
			$co_twitter = "EventEspresso";
		}

		//Get the event name
		$event_name = '';
		foreach ( $transaction->registrations() as $registration ) {
			if ( $registration instanceof EE_Registration ) {
				if ( $event_name != $registration->event_name() ) {
					$event_name = $registration->event_name();
				}
			}
		}

		$social_buttons_js_vars = array( 
     		'facebook' => EE_Registry::instance()->CFG->organization->facebook,
  		);
		wp_localize_script( 'social_buttons_js_handle', 'ee_social_buttons', $social_buttons_js_vars );
		

		//Output the buttons
		?>

		<h3 class="ee-registration-social_buttons-h3"><?php echo __('Support us on Social Media -- Spread the Word', 'event_espresso'); ?></h3>

		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $transaction->primary_registration()->event()->get_permalink(); ?>" data-text="<?php echo sprintf(__('I just registered for %1s at %2s', 'event_espresso'), $event_name, EE_Registry::instance()->CFG->organization->name); ?>"  data-via="<?php echo $co_twitter; ?>" data-size="large"><?php echo __('Tweet', 'event_espresso'); ?></a>
		<script>/*!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');*/</script>

		<div id="fb-root"></div>

		<script>/*
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo EE_Registry::instance()->CFG->organization->facebook; ?>";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		*/</script>

		<div class="fb-like" data-href="<?php echo $transaction->primary_registration()->event()->get_permalink(); ?>" data-send="true" data-width="450" data-show-faces="true"></div>

		<?php
		//Finish up
		
	}
	
} //end EE_Social_Buttons_Hooks