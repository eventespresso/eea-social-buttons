<?php
/*
  Plugin Name: Event Espresso - Social Sharing (EE4.4.4+)
  Plugin URI: http://www.eventespresso.com
  Description: The Event Espresso Social Sharing add-on displays social media buttons on the registration overview page, after a successful registration in Event Espresso. Compatible with Event Espresso 4.4.4 or higher.

  Version: 1.0.0.rc.008
  Author: Event Espresso
  Author URI: http://www.eventespresso.com
  Copyright 2014 Event Espresso (email : support@eventespresso.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA02110-1301USA
 *
 * ------------------------------------------------------------------------
 *
 * Event Espresso
 *
 * Event Registration and Management Plugin for WordPress
 *
 * @ package		Event Espresso
 * @ author			Event Espresso
 * @ copyright	(c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license		http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link				http://www.eventespresso.com
 * @ version	 	EE4
 *
 * ------------------------------------------------------------------------
 */
define( 'EE_SOCIAL_BUTTONS_CORE_VERSION_REQUIRED', '4.8.0.rc.0000' );
define( 'EE_SOCIAL_BUTTONS_VERSION', '1.0.0.rc.008' );
define( 'EE_SOCIAL_BUTTONS_PLUGIN_FILE',  __FILE__ );
define( 'EE_SOCIAL_BUTTONS_BASE_NAME', plugin_basename(__FILE__) );
function load_espresso_social_buttons() {
  if ( class_exists( 'EE_Addon' )) {
  	require_once ( plugin_dir_path( __FILE__ ) . 'EE_Social_Buttons.class.php' );
  	EE_Social_Buttons::register_addon();
  }
}
add_action( 'AHEE__EE_System__load_espresso_addons', 'load_espresso_social_buttons' );

// End of file espresso_social_buttons.php
// Location: wp-content/plugins/espresso-social_buttons/espresso_social_buttons.php
