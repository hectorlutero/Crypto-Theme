<?php
<<<<<<< HEAD

=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
/**
 * The quic.cloud class.
 *
 * @since      	2.4.1
 * @package    	LiteSpeed
 * @subpackage 	LiteSpeed/src/cdn
 * @author     	LiteSpeed Technologies <info@litespeedtech.com>
 */
<<<<<<< HEAD

=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace LiteSpeed\CDN;

use LiteSpeed\Cloud;
use LiteSpeed\Base;

<<<<<<< HEAD
defined('WPINC') || exit;

class Quic extends Base
{
=======
defined( 'WPINC' ) || exit;

class Quic extends Base {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
	const LOG_TAG = '☁️';

	const TYPE_REG = 'reg';

	protected $_summary;
<<<<<<< HEAD
	public function __construct()
	{
=======
	public function __construct() {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		$this->_summary = self::get_summary();
	}

	/**
	 * Notify CDN new config updated
	 *
	 * @access public
	 */
<<<<<<< HEAD
	public static function try_sync_config()
	{
		self::cls()->try_sync_conf();
	}

	public function try_sync_conf($force = false)
	{
		$options = $this->get_options();

		if (!$options[self::O_CDN_QUIC]) {
			if (!empty($this->_summary['conf_md5'])) self::save_summary(array('conf_md5' => ''));
=======
	public static function try_sync_config() {
		self::cls()->try_sync_conf();
	}

	public function try_sync_conf() {
		$options = $this->get_options();

		if ( ! $options[ self::O_CDN_QUIC ] ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			return false;
		}

		// Security: Remove cf key in report
		$secure_fields = array(
			self::O_CDN_CLOUDFLARE_KEY,
			self::O_OBJECT_PSWD,
		);
<<<<<<< HEAD
		foreach ($secure_fields as $v) {
			if (!empty($options[$v])) {
				$options[$v] = str_repeat('*', strlen($options[$v]));
			}
		}
		unset($options[self::O_MEDIA_LQIP_EXC]);

		// Remove overflow multi lines fields
		foreach ($options as $k => $v) {
			if (is_array($v) && count($v) > 30) {
				$v = array_slice($v, 0, 30);
				$options[$k] = $v;
			}
		}

		// Rest url
		$options['_rest'] = function_exists('rest_get_url_prefix') ? rest_get_url_prefix() : apply_filters('rest_url_prefix', 'wp-json');
		$options['_home_url'] = home_url('/');

		// Add server env vars
		$options['_server'] = $this->server_vars();

		// Append hooks
		$options['_tp_cookies'] = apply_filters('litespeed_vary_cookies', array());

		$conf_md5 = md5(json_encode($options));
		if (!empty($this->_summary['conf_md5']) && $conf_md5 == $this->_summary['conf_md5']) {
			if (!$force) {
				self::debug('Bypass sync conf to QC due to same md5', $conf_md5);
				return;
			}
			self::debug('!!!Force sync conf even same md5');
		}

		self::save_summary(array('conf_md5' => $conf_md5));
		self::debug('sync conf to QC', $options);

		Cloud::post(Cloud::SVC_D_SYNC_CONF, $options);
	}
}
=======
		foreach ( $secure_fields as $v ) {
			if ( ! empty( $options[ $v ] ) ) {
				$options[ $v ] = str_repeat( '*', strlen( $options[ $v ] ) );
			}
		}
		unset( $options[ self::O_MEDIA_LQIP_EXC ] );

		// Rest url
		$options[ '_rest' ] = function_exists( 'rest_get_url_prefix' ) ? rest_get_url_prefix() : apply_filters( 'rest_url_prefix', 'wp-json' );
		$options[ '_home_url' ] = home_url( '/' );

		// Add server env vars
		$options[ '_server' ] = $this->server_vars();

		// Append hooks
		$options[ '_tp_cookies' ] = apply_filters( 'litespeed_vary_cookies', array() );

		$conf_md5 = md5( json_encode( $options ) );
		if ( ! empty( $this->_summary[ 'conf_md5' ] ) && $conf_md5 == $this->_summary[ 'conf_md5' ] ) {
			self::debug( 'Bypass sync conf to QC due to same md5', $conf_md5 );
			return;
		}

		self::save_summary( array( 'conf_md5' => $conf_md5 ) );
		self::debug('sync conf to QC', $options);

		Cloud::post( Cloud::SVC_D_SYNC_CONF, $options );
	}

}
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
