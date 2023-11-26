<?php
<<<<<<< HEAD

=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
/**
 * Check if any plugins that could conflict with LiteSpeed Cache are active.
 * @since		4.7
 */

namespace LiteSpeed\Thirdparty;

<<<<<<< HEAD
defined('WPINC') || exit;

class LiteSpeed_Check
{

	public static $_incompatible_plugins =
	array(
		// 'autoptimize/autoptimize.php',
		'breeze/breeze.php',
		'cache-enabler/cache-enabler.php',
		'cachify/cachify.php',
		'cloudflare/cloudflare.php',
		'comet-cache/comet-cache.php',
		'docket-cache/docket-cache.php',
		'fast-velocity-minify/fvm.php',
		'hummingbird-performance/wp-hummingbird.php',
		'nginx-cache/nginx-cache.php',
		'nitropack/main.php',
		'pantheon-advanced-page-cache/pantheon-advanced-page-cache.php',
		'powered-cache/powered-cache.php',
		'psn-pagespeed-ninja/pagespeedninja.php',
		'sg-cachepress/sg-cachepress.php',
		'simple-cache/simple-cache.php',
		// 'redis-cache/redis-cache.php',
		'w3-total-cache/w3-total-cache.php',
		'wp-cloudflare-page-cache/wp-cloudflare-page-cache.php',
		'wp-fastest-cache/wpFastestCache.php',
		'wp-meteor/wp-meteor.php',
		'wp-optimize/wp-optimize.php',
		'wp-performance-score-booster/wp-performance-score-booster.php',
		'wp-rocket/wp-rocket.php',
		'wp-super-cache/wp-cache.php',
	);
=======
defined( 'WPINC' ) || exit;

class LiteSpeed_Check {

	public static $_incompatible_plugins =
		array(
			// 'autoptimize/autoptimize.php',
			'breeze/breeze.php',
			'cache-enabler/cache-enabler.php',
			'cachify/cachify.php',
			'cloudflare/cloudflare.php',
			'comet-cache/comet-cache.php',
			'docket-cache/docket-cache.php',
			'fast-velocity-minify/fvm.php',
			'hummingbird-performance/wp-hummingbird.php',
			'nginx-cache/nginx-cache.php',
			'nitropack/main.php',
			'pantheon-advanced-page-cache/pantheon-advanced-page-cache.php',
			'powered-cache/powered-cache.php',
			'sg-cachepress/sg-cachepress.php',
			'simple-cache/simple-cache.php',
			// 'redis-cache/redis-cache.php',
			'w3-total-cache/w3-total-cache.php',
			'wp-cloudflare-page-cache/wp-cloudflare-page-cache.php',
			'wp-fastest-cache/wpFastestCache.php',
			'wp-meteor/wp-meteor.php',
			'wp-optimize/wp-optimize.php',
			'wp-performance-score-booster/wp-performance-score-booster.php',
			'wp-rocket/wp-rocket.php',
			'wp-super-cache/wp-cache.php',
		);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8

	private static $_option = 'thirdparty_litespeed_check';
	private static $_msg_id = 'id="lscwp-incompatible-plugin-notice"';

<<<<<<< HEAD
	public static function detect()
	{
		if (!is_admin()) {
=======
	public static function detect() {
		if ( ! is_admin() ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			return;
		}

		/**
		 * Check for incompatible plugins when `litespeed-cache` is first activated.
		 */
<<<<<<< HEAD
		$plugin = basename(LSCWP_DIR) . '/litespeed-cache.php';
		register_deactivation_hook($plugin, function ($_network_wide) {
			\LiteSpeed\Admin_Display::delete_option(self::$_option);
		});
		if (!\LiteSpeed\Admin_Display::get_option(self::$_option)) {
			self::activated_plugin($plugin, null);
			\LiteSpeed\Admin_Display::add_option(self::$_option, true);
=======
		$plugin = basename( LSCWP_DIR ) . '/litespeed-cache.php';
		register_deactivation_hook( $plugin, function( $_network_wide ) {
			\LiteSpeed\Admin_Display::delete_option( self::$_option );
		} );
		if ( ! \LiteSpeed\Admin_Display::get_option( self::$_option ) ) {
			self::activated_plugin( $plugin, null );
			\LiteSpeed\Admin_Display::add_option( self::$_option, true );
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		/**
		 * Check for incompatible plugins when any plugin is (de)activated.
		 */
<<<<<<< HEAD
		add_action('activated_plugin', __CLASS__ . '::activated_plugin', 10, 2);
		add_action('deactivated_plugin', __CLASS__ . '::deactivated_plugin', 10, 2);

		if (class_exists('PagespeedNinja')) {
			\LiteSpeed\Admin_Display::error(
				'<div ' . self::$_msg_id . '>'
					. esc_html__(
						'Please consider disabling the following detected plugins, as they may conflict with LiteSpeed Cache:',
						'litespeed-cache'
					)
					. '<p style="color: red; font-weight: 700;">'
					. 'PageSpeed Ninja'
					. '</p>'
					. '</div>',
				false,
				true
			);
		}
	}

	public static function activated_plugin($plugin, $network_wide)
	{
		self::incompatible_plugin_notice($plugin, $network_wide, 'activated');
	}

	public static function deactivated_plugin($plugin, $network_wide)
	{
		self::incompatible_plugin_notice($plugin, $network_wide, 'deactivated');
=======
		add_action( 'activated_plugin', __CLASS__ . '::activated_plugin', 10, 2 );
		add_action( 'deactivated_plugin', __CLASS__ . '::deactivated_plugin', 10, 2 );
	}

	public static function activated_plugin( $plugin, $network_wide ) {
		self::incompatible_plugin_notice( $plugin, $network_wide, 'activated' );
	}

	public static function deactivated_plugin( $plugin, $network_wide ) {
		self::incompatible_plugin_notice( $plugin, $network_wide, 'deactivated' );
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
	}

	/**
	 * Detect any incompatible plugins that are currently `active` and `valid`.
	 * Show a notification if there are any.
	 */
<<<<<<< HEAD
	public static function incompatible_plugin_notice($plugin, $_network_wide, $action)
	{
=======
	public static function incompatible_plugin_notice( $plugin, $_network_wide, $action ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		self::update_messages();

		/**
		 * The 'deactivated_plugin' action fires before
		 * `wp_get_active_and_valid_plugins` can see the change, so we'll need to
		 * remove `$plugin` from the list.
		 */
<<<<<<< HEAD
		$deactivated = 'deactivated' === $action ? array($plugin) : array();

		$incompatible_plugins =
			array_map(
				function ($plugin) {
					return WP_PLUGIN_DIR . '/' . $plugin;
				},
				array_diff(self::$_incompatible_plugins, $deactivated)
=======
		$deactivated = 'deactivated' === $action ? array( $plugin ) : array();

		$incompatible_plugins =
			array_map(
				function( $plugin ) { return WP_PLUGIN_DIR . '/' . $plugin; },
				array_diff( self::$_incompatible_plugins, $deactivated )
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			);

		$active_incompatible_plugins =
			array_map(
<<<<<<< HEAD
				function ($plugin) {
					$plugin = get_plugin_data($plugin, false, true);
					return $plugin['Name'];
				},
				array_intersect($incompatible_plugins, wp_get_active_and_valid_plugins())
			);

		if (empty($active_incompatible_plugins)) {
=======
				function( $plugin ) {
					$plugin = get_plugin_data( $plugin, false, true );
					return $plugin['Name'];
				},
				array_intersect( $incompatible_plugins, wp_get_active_and_valid_plugins() )
			);

		if ( empty( $active_incompatible_plugins ) ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			return;
		}

		\LiteSpeed\Admin_Display::error(
			'<div ' . self::$_msg_id . '>'
<<<<<<< HEAD
				. esc_html__(
					'Please consider disabling the following detected plugins, as they may conflict with LiteSpeed Cache:',
					'litespeed-cache'
				)
				. '<p style="color: red; font-weight: 700;">'
				. implode(', ', $active_incompatible_plugins)
				. '</p>'
				. '</div>',
=======
			. esc_html__(
				'Please consider disabling the following detected plugins, as they may conflict with LiteSpeed Cache:',
				'litespeed-cache'
			)
			. '<p style="color: red; font-weight: 700;">'
			. implode( ', ', $active_incompatible_plugins )
			. '</p>'
			. '</div>',
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			false,
			true
		);
	}

	/**
	 * Prevent multiple incompatible plugin notices, in case an admin (de)activates
	 * a number of incompatible plugins in succession without dismissing the
	 * notice(s).
	 */
<<<<<<< HEAD
	private static function update_messages()
	{
=======
	private static function update_messages() {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		$messages =
			\LiteSpeed\Admin_Display::get_option(
				\LiteSpeed\Admin_Display::DB_MSG_PIN,
				array()
			);
<<<<<<< HEAD
		if (is_array($messages)) {
			foreach ($messages as $index => $message) {
				if (strpos($message, self::$_msg_id) !== false) {
					unset($messages[$index]);
					if (!$messages) {
=======
		if ( is_array( $messages ) ) {
			foreach ( $messages as $index => $message ) {
				if ( strpos( $message, self::$_msg_id ) !== false ) {
					unset( $messages[ $index ] );
					if ( ! $messages ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
						$messages = -1;
					}
					\LiteSpeed\Admin_Display::update_option(
						\LiteSpeed\Admin_Display::DB_MSG_PIN,
						$messages
					);
					break;
				}
			}
		}
	}
}
