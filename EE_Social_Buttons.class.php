<?php if ( ! defined( 'EVENT_ESPRESSO_VERSION' )) { exit(); }
/**
 * ------------------------------------------------------------------------
 *
 * Class  EE_Social_Buttons
 *
 * @package			Event Espresso
 * @subpackage		espresso-social_buttons
 * @author			    Brent Christensen
 * @ version		 	$VID:$
 *
 * ------------------------------------------------------------------------
 */
// define the plugin directory path and URL
define( 'EE_SOCIAL_BUTTONS_PATH', plugin_dir_path( __FILE__ ));
define( 'EE_SOCIAL_BUTTONS_URL', plugin_dir_url( __FILE__ ));
define( 'EE_SOCIAL_BUTTONS_ADMIN', EE_SOCIAL_BUTTONS_PATH . 'admin' . DS . 'social_buttons' . DS );
define( 'EE_SOCIAL_BUTTONS_TEMPLATES', EE_SOCIAL_BUTTONS_PATH . DS . 'templates' . DS );
Class  EE_Social_Buttons extends EE_Addon {

	/**
	 * class constructor
	 */
	public function __construct() {
	}

	public static function register_addon() {
		// register addon via Plugin API
		EE_Register_Addon::register(
			'Social_Buttons',
			array(
				'version' 				=> EE_SOCIAL_BUTTONS_VERSION,
				'min_core_version' 		=> '4.4.4',
				'main_file_path' 		=> EE_SOCIAL_BUTTONS_PLUGIN_FILE,
				'module_paths' 			=> array( EE_SOCIAL_BUTTONS_PATH .  'EED_Social_Buttons.module.php' ),
				'pue_options'			=> array(
					'pue_plugin_slug' 	=> 'eea-social_buttons',
					'plugin_basename' 	=> EE_SOCIAL_BUTTONS_BASE_NAME,
					'checkPeriod' 		=> '24',
					'use_wp_update' 	=> FALSE
				),
			)
		);
	}



	/**
	 * 	additional_admin_hooks
	 *
	 *  @access 	public
	 *  @return 	void
	 */
	public function additional_admin_hooks() {}



	/**
	 * plugin_actions
	 *
	 * Add a settings link to the Plugins page, so people can go straight from the plugin page to the settings page.
	 * @param $links
	 * @param $file
	 * @return array
	 */
	public function plugin_actions( $links, $file ) {}


}
// End of file EE_Social_Buttons.class.php
// Location: wp-content/plugins/espresso-social_buttons/EE_Social_Buttons.class.php
