<?php
/*
Plugin Name: Indeed Apply for WordPress
Plugin URI: http://www.indeed.com/hire/indeed-apply
Description: Add Indeed Apply buttons to any WordPress website using shortcodes
Version: 1.5
Author: Indeed.com
Author URI: http://www.indeed.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/

/**
 * Class Indeed_Apply
 *
 * @since v1.0
 */
class Indeed_Apply {

	/**
	 * Setup the plugin
	 *
	 * @since  v1.1
	 * @author Taylor McCaslin
	 */
	public function __construct() {
		// set shortcode
		add_shortcode( 'indeed-apply', array( $this, 'shortcode' ) );
		//support missing dash
		add_shortcode( 'indeedapply', array( $this, 'shortcode' ) );
		$this->load_textdomain();
		$this->run( $this );
	}

	/**
	 * Setup plugin for localization
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	function load_textdomain() {

		// Set filter for plugin's languages directory
		$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
		$lang_dir = apply_filters( 'indeed_apply_languages_directory', $lang_dir );


		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'indeed-apply' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'ia', $locale );

		// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/indeed-apply/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/indeed-apply folder
			load_textdomain( 'indeed-apply', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/indeed-apply/languages/ folder
			load_textdomain( 'indeed-apply', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'indeed-apply', false, $lang_dir );
		}

	}

	/**
	 * Add needed actions and filters on instantiation
	 *
	 * @since  v1.2
	 * @author Taylor McCaslin
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_filter( 'plugin_action_links', array( $this, 'add_link' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_init', array( $this, 'restrict_options_page' ) );

		//check that setup has been completed
		$this->setup_complete();

	}

	/**
	 * Check that setup has been completed, if not add a notice to the admin
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	private function setup_complete() {
		// are Indeed API token and secret present?
		if ( !get_option( 'ikey' ) || !get_option( 'skey' ) ) {
			add_action( 'admin_notices', array( $this, 'unconfigured_error' ) );
			//return false;
		}

	}

	/**
	 * Execute the shortcode
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $data array shortcode attribute/value array
	 *
	 * @return string formatted indeed apply button hmtl
	 */
	public function shortcode( $data ) {

		//add indeed apply initialization script to footer
		add_action( 'wp_footer', array( $this, 'add_ia_script' ) );

		return $this->generate_html( $data );
	}


	// render output with shortcode

	/**
	 * Generate the Indeed Apply Button HTML
	 *
	 * @since    v1.5
	 * @author   Taylor McCaslin
	 *
	 * @param $data array shortcode attribute/value array
	 *
	 * @internal param string $encrypted_email hex encrypted email
	 *
	 * @return string formatted indeed apply button hmtl
	 */
	private function generate_html( $data ) {


		//get api token
		$apitoken = get_option( 'ikey' );

		//get current page url
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];

		//starting html
		$html = '<span class="indeed-apply-widget" ';

		//add apitoken HTML
		$html .= $this->attribute_builder( 'apiToken', $apitoken );

		//add current page url HTML
		$html .= $this->attribute_builder( 'jobUrl', $current_url );

		//drive indeed users to site
		$html .= $this->attribute_builder( 'allow-apply-on-indeed', 0 );

		//flag as WordPress
		$html .= $this->attribute_builder( 'jobMeta', 'WordPress' );

		//iterate through shortcode attribute key/value pair
		foreach ( $data as $k => $v ) {

			// append appropriate HTML for each supported shortcode attribute
			switch ( $k ) {

				case 'jobtitle':
					$html .= $this->attribute_builder( 'jobTitle', $v );
					break;

				case 'emailapplicationto':
					// validate email
					$email = sanitize_email( $v );

					if ( is_email( $email ) ) {

						$encrypted_email = $this->encrypt_email( $email );

						$html .= $this->attribute_builder( 'email', $encrypted_email );

					}
					break;

				case 'jobcompanyname':
					$html .= $this->attribute_builder( 'jobCompanyName', $v );
					break;

				//case for improper attribute name for jobcompanyname, fallback
				case 'companyname':
					$html .= $this->attribute_builder( 'jobCompanyName', $v );
					break;

				case 'joblocation':
					$html .= $this->attribute_builder( 'jobLocation', $v );
					break;

				case 'phone':
					//ensure value is allowable
					if ( in_array( strtolower( $v ), array( 'optional', 'hidden', 'required' ) ) ) {
						$html .= $this->attribute_builder( 'phone', $v );
					}
					break;

				case 'coverletter':
					//ensure value is allowable
					if ( in_array( strtolower( $v ), array( 'optional', 'hidden', 'required' ) ) ) {
						$html .= $this->attribute_builder( 'coverletter', $v );
					}
					break;

				case 'continueurl':
					//ensure url includes http
					$parsed = parse_url( $v );
					if ( empty( $parsed[ 'scheme' ] ) ) {
						$v = 'http://' . $v;
					}

					//validate url is only http or https
					$v = esc_url_raw( $v, array( 'http', 'https' ) );

					$html .= $this->attribute_builder( 'continueUrl', $v );
					break;

				case 'debug':
					//ensure value is allowable
					if ( strtolower( $v ) == 'true' ) {
						$this->debug_to_console( $data );
					}
					break;

				break;

			}

		}

		//append ending Indeed Apply Button HTML
		$html .= '></span>';

		return $html;

	}

	/**
	 * Helper function to build formatted Indeed Apply data attributes
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $atr   string attribute name
	 * @param $value string attribute value
	 *
	 * @return string
	 */
	public function attribute_builder( $atr, $value ) {
		return ' data-indeed-apply-' . $atr . '="' . $value . '"';
	}

	/**
	 * Encrypt an email address with AES cbc PKCS7 using 16 byte iv
	 *
	 * @since  v1.0
	 * @author Parker Seidel, Taylor McCaslin
	 *
	 * @param $email string plain text email address
	 *
	 * @return string hex encrypted email
	 */
	private function encrypt_email( $email ) {

		require_once 'includes/padCrypt.php';
		require_once 'includes/AES_Encryption.php';

		$apisecret      = get_option( 'skey' );
		$apisecret_utf8 = utf8_encode( $apisecret );
		$apisecret_seg  = substr( $apisecret_utf8, 0, 16 );
		$iv             = str_repeat( "\0", 16 );
		$mode           = "cbc";
		$padding        = "PKCS7";
		$AES            = new AES_Encryption( $apisecret_seg, $iv, $padding, $mode );
		$encrypted      = $AES->encrypt( $email );
		$hex            = bin2hex( $encrypted );

		return $hex;

	}

	/**
	 * Allow structured shortcode attributes to be logged to the console
	 * Useful when debugging the shortcode: add debug="true" to consol.log the shortcode attributes
	 * debug=true should never be used in a production site
	 *
	 * @since  v1.2
	 * @author Taylor McCaslin
	 *
	 * @param $data array shortcode attribute/value array
	 */
	private function debug_to_console( $data ) {
		if ( is_array( $data ) || is_object( $data ) ) {
			echo( "<script>console.log('PHP: " . json_encode( $data ) . "');</script>" );
		} else {
			echo( "<script>console.log('PHP: " . $data . "');</script>" );
		}
	}

	/**
	 * Indeed Apply Button Initialization Script
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin, Parker Seidel, Indeed Inc.
	 */
	public function add_ia_script() {

		?>
		<script type="text/javascript">
			(function (d, s, id) {
				var js, iajs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.id = id;
				js.setAttribute('data-indeed-apply-qs', 'WordPress');
				js.async = true;
				js.src = "https://apply.indeed.com/indeedapply/static/scripts/app/bootstrap.js";
				iajs.parentNode.insertBefore(js, iajs);
			}(document, 'script', 'indeed-apply-js'));
		</script>

	<?php
	}

	/**
	 * Add Indeed Apply Settings menu to WP Admin Settings Menu
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function add_menu_page() {
		add_options_page( 'Indeed Apply Settings', 'Indeed Apply', 'edit_pages', 'indeed-apply', array( $this, 'ia_settings_page' ) );

	}

	/**
	 * Render the Indeed Apply Settings page
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function ia_settings_page() {
		?>
		<div class="wrap">
			<h2>Indeed Apply Settings</h2>

			<form action="options.php" method="post">
				<?php settings_fields( 'indeed-apply' ); ?>
				<?php do_settings_sections( 'indeed-apply' ); ?>
				<p class="submit">
					<input name="Submit" type="submit" class="button primary-button"
						   value="<?php esc_attr_e( 'Save Changes' ); ?>"/>
				</p>
			</form>
		</div>
	<?php
	}

	/**
	 * Render Help Text
	 *
	 * @since  v1.4
	 * @author Taylor McCaslin
	 */
	public function ia_settings_text() {
		echo "<p>See the <a target='_blank' href='http://wordpress.org/plugins/indeed-apply-shortcode/installation/'>Indeed Apply Shortcode plugin page</a> for details about shortcode usage.</p>";
		echo "<p>You can retrieve your Indeed API Token and Secret by logging in to the <a target='blank' href='https://secure.indeed.com/account/apikeys'>Indeed API Page</a>.</p>";
	}

	/**
	 * Add Token Key Field
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function settings_ikey() {
		$ikey = esc_attr( get_option( 'ikey' ) );
		echo "<input id='ikey' name='ikey' size='64' type='text' value='$ikey' />";
	}

	/** Add Secret Key Field
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function settings_skey() {
		$skey = esc_attr( get_option( 'skey' ) );
		echo "<input id='skey' name='skey' size='64' type='password' value='$skey' autocomplete='off' />";
	}

	/**
	 * Validate API Token Key
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $ikey string 64 character Indeed Apply API Token
	 *
	 * @return string Indeed Apply Token
	 */
	public function ikey_validate( $ikey ) {
		if ( ( strlen( $ikey ) != 64 ) || ( !preg_match( '/^[a-zA-Z0-9]+$/', $ikey ) ) ) {
			$this->add_custom_error( 'skey_error' );

			return "";
		} else {
			return $ikey;
		}
	}

	/**
	 * Add Custom Validation Error Messages
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $type string validation error type
	 */
	public function add_custom_error( $type ) {
		switch ( $type ) {

			case 'ikey_error':
				add_settings_error( 'ikey', '', 'Your Indeed API Token is not valid. You can retrieve your API key by logging in to the <a target="blank" href="https://secure.indeed.com/account/apikeys">Indeed API Page</a>.' );
				break;

			case 'skey_error':
				add_settings_error( 'skey', '', 'Your Indeed API Secret is not valid. You can retrieve your API secret key by logging in to the <a target="blank" href="https://secure.indeed.com/account/apikeys">Indeed API Page</a>.' );
				break;

				break;


		}
	}

	/**
	 * Validate API Secret Key
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $skey string 64 character Indeed Apply API Secret
	 *
	 * @return string Indeed Apply API Secret
	 */
	public function skey_validate( $skey ) {
		if ( strlen( $skey ) != 64 ) {
			$this->add_custom_error( 'skey_error' );

			return "";
		} else {
			return $skey;
		}
	}

	/**
	 * Remove Options Page Based on User Permission
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function restrict_options_page() {
		// If the user does not have access to publish posts
		if ( !current_user_can( 'publish_pages' ) ) {
			// Remove the "Tools" menu
			remove_menu_page( 'indeed-apply' );
		}
	}

	/**
	 * Add Settings Link to Plugin Listing
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 * @param $links
	 * @param $file
	 *
	 * @return mixed
	 */
	public function add_link( $links, $file ) {
		static $this_plugin;
		if ( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );

		if ( $file == $this_plugin ) {
			$settings_link = '<a href="options-general.php?page=indeed-apply">' . __( "Settings", "wp-indeed-apply" ) . '</a>';
			array_unshift( $links, $settings_link );
		}

		return $links;
	}

	/**
	 * Display General Admin Error if Plugin isn't configured
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 *
	 */
	public function unconfigured_error() {
		global $pagenow;

		// don't show on the options-general menu
		if ( $pagenow != 'options-general.php' ) {

			if ( current_user_can( 'publish_pages' ) ) {

				?>
				<div class="error">
					<p><?php _e( 'Indeed Apply for WordPress is not configured, visit <a href="options-general.php?page=indeed-apply">Indeed Apply Settings</a> to complete setup.', 'wp-indeed-apply' ); ?></p>
				</div>
			<?php
			} else {
				?>
				<div class="error">
					<p><?php _e( 'Indeed Apply for WordPress is not configured, please contact your site admin to configure the plugin', 'wp-indeed-apply' ); ?></p>
				</div>
			<?php
			}
		}
	}

	/**
	 * Initiate Indeed Apply Settings Menu Page
	 *
	 * @since  v1.0
	 * @author Taylor McCaslin
	 */
	public function admin_init() {
		add_settings_section( 'ia-settings', 'Indeed Apply Settings', array( $this, 'ia_settings_text' ), 'indeed-apply' );
		add_settings_field( 'ikey', 'Token', array( $this, 'settings_ikey' ), 'indeed-apply', 'ia-settings' );
		add_settings_field( 'skey', 'Secret', array( $this, 'settings_skey' ), 'indeed-apply', 'ia-settings' );
		register_setting( 'indeed-apply', 'ikey', array( $this, 'ikey_validate' ) );
		register_setting( 'indeed-apply', 'skey', array( $this, 'skey_validate' ) );

	}


} // end Indeed_Apply class

// instantiate our plugin's class
$indeed_apply = new Indeed_Apply();