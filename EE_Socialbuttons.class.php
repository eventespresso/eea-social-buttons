<?php if ( ! defined( 'EVENT_ESPRESSO_VERSION' )) { exit(); }
/**
 * ------------------------------------------------------------------------
 *
 * Class  EE_Socialbuttons
 *
 * @package			Event Espresso
 * @subpackage		espresso-socialbuttons
 * @author			    Brent Christensen
 * @ version		 	$VID:$
 *
 * ------------------------------------------------------------------------
 */
// define the plugin directory path and URL
define( 'EE_SOCIALBUTTONS_PATH', plugin_dir_path( __FILE__ ));
define( 'EE_SOCIALBUTTONS_URL', plugin_dir_url( __FILE__ ));
define( 'EE_SOCIALBUTTONS_ADMIN', EE_SOCIALBUTTONS_PATH . 'admin' . DS . 'socialbuttons' . DS );
Class  EE_Socialbuttons extends EE_Addon {

	/**
	 * class constructor
	 */
	public function __construct() {
		//load main class for hooks
		require_once EE_SOCIALBUTTONS_PATH .  'core/EE_Socialbuttons_Hooks.core.php';
	}

	public static function register_addon() {
		// register addon via Plugin API
		EE_Register_Addon::register(
			'Socialbuttons',
			array(
				'version' 					=> EE_SOCIALBUTTONS_VERSION,
				'min_core_version' => '4.4.4',
				'main_file_path' 				=> EE_SOCIALBUTTONS_PLUGIN_FILE,
				'pue_options'			=> array(
					'pue_plugin_slug' => 'eea-socialbuttons',
					'plugin_basename' => EE_SOCIALBUTTONS_BASE_NAME,
					'checkPeriod' => '24',
					'use_wp_update' => FALSE
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
// End of file EE_Socialbuttons.class.php
// Location: wp-content/plugins/espresso-socialbuttons/EE_Socialbuttons.class.php
