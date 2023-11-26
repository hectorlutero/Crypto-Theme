<?php

trait WPCF7_ConfigValidator_Messages {

	/**
	 * Runs error detection for the messages section.
	 */
	public function validate_messages() {
		$messages = (array) $this->contact_form->prop( 'messages' );

		if ( ! $messages ) {
			return;
		}

<<<<<<< HEAD
		if (
			isset( $messages['captcha_not_match'] ) and
			! wpcf7_use_really_simple_captcha()
		) {
=======
		if ( isset( $messages['captcha_not_match'] )
		and ! wpcf7_use_really_simple_captcha() ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			unset( $messages['captcha_not_match'] );
		}

		foreach ( $messages as $key => $message ) {
			$section = sprintf( 'messages.%s', $key );
<<<<<<< HEAD

			if ( $this->supports( 'html_in_message' ) ) {
				if ( $this->detect_html_in_message( $section, $message ) ) {
					$this->add_error( $section, 'html_in_message',
						array(
							'message' => __( "HTML tags are used in a message.", 'contact-form-7' ),
						)
					);
				} else {
					$this->remove_error( $section, 'html_in_message' );
				}
			}
=======
			$this->detect_html_in_message( $section, $message );
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}
	}


	/**
	 * Detects errors of HTML uses in a message.
	 *
	 * @link https://contactform7.com/configuration-errors/html-in-message/
	 */
	public function detect_html_in_message( $section, $content ) {
		$stripped = wp_strip_all_tags( $content );

<<<<<<< HEAD
		if ( $stripped !== $content ) {
			return true;
=======
		if ( $stripped != $content ) {
			return $this->add_error( $section,
				'html_in_message',
				array(
					'message' => __( "HTML tags are used in a message.", 'contact-form-7' ),
				)
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		return false;
	}

}
