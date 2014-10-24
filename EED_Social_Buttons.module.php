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
		//add_action( 'AHEE__thank_you_page_overview_template__content', array( __CLASS__, 'ee_social_thank_you'), 10, 1 );
		add_action( 'AHEE__thank_you_page_overview_template__bottom', array( __CLASS__, 'ee_social_thank_you'), 10, 1 );

	}

	/**
	  *    run - initial module setup
	  *
	  * @access    public
	  * @param  WP $WP
	  * @return    void
	  */
	 public function run( $WP ) {
		 //This doesn't seem to work\
		 //add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
	 }


	/**
	 * 	enqueue_scripts - Load the scripts and css
	 *
	 *  @access 	public
	 *  @return 	void
	 */
	public function enqueue_scripts() {
		//This doesn't seem to work, so moved below
		/*
		//Check to see if the new_addon JS file exists in the '/uploads/espresso/' directory
		if ( is_readable( EVENT_ESPRESSO_UPLOAD_DIR . "scripts/espresso_social_buttons.js")) {
			//This is the url to the JS file if available
			wp_register_script( 'social_buttons_js_handle', EVENT_ESPRESSO_UPLOAD_URL . 'scripts/espresso_social_buttons.js' );
		} else {
			wp_register_script( 'social_buttons_js_handle', EE_SOCIAL_BUTTONS_URL . 'scripts/espresso_social_buttons.js' );
		}

		wp_enqueue_script( 'social_buttons_js_handle' );
		*/
	}


	//Facebook
	public static function ee_social_thank_you($transaction) {
		//Debug
		//d($transaction);
		
		//Check to see if the new_addon JS file exists in the '/uploads/espresso/' directory
		if ( is_readable( EVENT_ESPRESSO_UPLOAD_DIR . "scripts/espresso_social_buttons.js")) {
			//This is the url to the JS file if available
			wp_register_script( 'social_buttons_js_handle', EVENT_ESPRESSO_UPLOAD_URL . 'scripts/espresso_social_buttons.js' );
		} else {
			wp_register_script( 'social_buttons_js_handle', EE_SOCIAL_BUTTONS_URL . 'scripts/espresso_social_buttons.js' );
		}
		wp_enqueue_script( 'social_buttons_js_handle' );

		//JS vars
		$social_buttons_js_vars = array( 
     		'facebook' => EE_Registry::instance()->CFG->organization->facebook,
  		);
		wp_localize_script( 'social_buttons_js_handle', 'ee_social_buttons', $social_buttons_js_vars );


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


		//Template vars
		$template_args = array( 
			'template_file'			=> 'espresso-social-buttons-template.template.php', //Default template file
			'event_permalink' 		=> $transaction->primary_registration()->event()->get_permalink(),
			'organization_name' 	=> EE_Registry::instance()->CFG->organization->name,
			'event_name' 			=> $event_name,
			'co_twitter' 			=> $co_twitter,
		 );

		// now filter the array of locations to search for templates
		add_filter( 'FHEE__EEH_Template__locate_template__template_folder_paths', array( __CLASS__, 'template_folder_paths' ));

		$social_buttons_template = EEH_Template::locate_template( $template_args['template_file'], $template_args );
		
		return $social_buttons_template;		
	}

	/**
	 *    template_folder_paths
	 *
	 * @access    public
	 * @param array $template_folder_paths
	 * @return    array
	 */
	public function template_folder_paths( $template_folder_paths = array() ) {
		$template_folder_paths[] = EE_SOCIAL_BUTTONS_TEMPLATES;
		return $template_folder_paths;
	}
	
} //end EE_Social_Buttons_Hooks