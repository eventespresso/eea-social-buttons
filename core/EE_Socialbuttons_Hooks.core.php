<?php
/**
 * This file contains the main socialbuttons class for adding social buttons to EE.
 *
 * @since %VER%
 * @package EE Socialbuttons
 * @subpackage main
 */

/**
 * Main class used for setting up all hooks etc used for adding social buttons to EE
 *
 * @since %VER%
 * @package EE Socialbuttons
 * @subpackage main
 * @author Seth Shoultes
 */
class EE_Socialbuttons_Hooks {

	/**
	 * contains all hooks used for socialbuttons
	 *
	 * @since %VER%
	 *
	 * @return void
	 */
	public static function init_hooks() {

		//hook format example
		//add_action( 'wp_head', array( __CLASS__, 'hook_callback' ), 10 );

		//Facebook
		//add_action( 'AHEE__thank_you_page_overview_template__content', array( __CLASS__, 'ee_social_thank_you_fb'), 10, 1 );
		add_action( 'AHEE__thank_you_page_overview_template__bottom', array( __CLASS__, 'ee_social_thank_you_fb'), 10, 1 );

	}

	/*
	//example callback for thing_to_hook_into action.
	public static function hook_callback() {		
		//Display an alert on the front-facing pages
		$output="<script> alert('Page is loading...'); </script>";
		echo $output;
	}
	*/

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

		//Output the buttons
		?>

		<h3 class="ee-registration-socialbuttons-h3"><?php echo __('Support us on Social Media -- Spread the Word', 'event_espresso'); ?></h3>

		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $transaction->primary_registration()->event()->get_permalink(); ?>" data-text="<?php echo sprintf(__('I just registered for %1s at %2s', 'event_espresso'), $event_name, EE_Registry::instance()->CFG->organization->name); ?>"  data-via="<?php echo $co_twitter; ?>" data-size="large"><?php echo __('Tweet', 'event_espresso'); ?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		<div id="fb-root"></div>

		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo EE_Registry::instance()->CFG->organization->facebook; ?>";
				fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="fb-like" data-href="<?php echo $transaction->primary_registration()->event()->get_permalink(); ?>" data-send="true" data-width="450" data-show-faces="true"></div>

		<?php
		//Finish up
		
	}
	
} //end EE_Socialbuttons_Hooks

EE_Socialbuttons_Hooks::init_hooks();
