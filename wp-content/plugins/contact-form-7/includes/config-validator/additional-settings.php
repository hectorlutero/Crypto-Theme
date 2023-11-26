<?php

trait WPCF7_ConfigValidator_AdditionalSettings {

	/**
	 * Runs error detection for the additional settings section.
	 */
	public function validate_additional_settings() {
<<<<<<< HEAD
		$section = 'additional_settings.body';

		if ( $this->supports( 'deprecated_settings' ) ) {
			$deprecated_settings_used =
				$this->contact_form->additional_setting( 'on_sent_ok' ) ||
				$this->contact_form->additional_setting( 'on_submit' );

			if ( $deprecated_settings_used ) {
				$this->add_error( $section, 'deprecated_settings',
					array(
						'message' => __( "Deprecated settings are used.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'deprecated_settings' );
			}
=======
		$deprecated_settings_used =
			$this->contact_form->additional_setting( 'on_sent_ok' ) ||
			$this->contact_form->additional_setting( 'on_submit' );

		if ( $deprecated_settings_used ) {
			return $this->add_error( 'additional_settings.body',
				'deprecated_settings',
				array(
					'message' => __( "Deprecated settings are used.", 'contact-form-7' ),
				)
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}
	}

}
