<?php

trait WPCF7_ConfigValidator_Mail {

	/**
<<<<<<< HEAD
	 * Replaces all mail-tags in the given content.
	 */
	public function replace_mail_tags( $content, $args = '' ) {
		$args = wp_parse_args( $args, array(
			'html' => false,
			'callback' =>
				array( $this, 'replace_mail_tags_with_minimum_input_callback' ),
		) );

		$content = new WPCF7_MailTaggedText( $content, $args );

		return $content->replace_tags();
	}


	/**
	 * Callback function for WPCF7_MailTaggedText. Replaces mail-tags with
	 * the most conservative inputs.
	 */
	public function replace_mail_tags_with_minimum_input_callback( $matches ) {
=======
	 * Callback function for WPCF7_MailTaggedText. Replaces mail-tags with
	 * the most conservative inputs.
	 */
	public function replace_mail_tags_with_minimum_input( $matches ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		// allow [[foo]] syntax for escaping a tag
		if ( $matches[1] === '[' and $matches[4] === ']' ) {
			return substr( $matches[0], 1, -1 );
		}

		$tag = $matches[0];
		$tagname = $matches[2];
		$values = $matches[3];

		$mail_tag = new WPCF7_MailTag( $tag, $tagname, $values );
		$field_name = $mail_tag->field_name();

		$example_email = 'example@example.com';
		$example_text = 'example';
		$example_blank = '';

		$form_tags = $this->contact_form->scan_form_tags(
			array( 'name' => $field_name )
		);

		if ( $form_tags ) {
			$form_tag = new WPCF7_FormTag( $form_tags[0] );

			$is_required = $form_tag->is_required() || 'radio' === $form_tag->type;

			if ( ! $is_required ) {
				return $example_blank;
			}

			if ( wpcf7_form_tag_supports( $form_tag->type, 'selectable-values' ) ) {
				if ( $form_tag->pipes instanceof WPCF7_Pipes ) {
					if ( $mail_tag->get_option( 'do_not_heat' ) ) {
						$before_pipes = $form_tag->pipes->collect_befores();
						$last_item = array_pop( $before_pipes );
					} else {
						$after_pipes = $form_tag->pipes->collect_afters();
						$last_item = array_pop( $after_pipes );
					}
				} else {
					$last_item = array_pop( $form_tag->values );
				}

				if ( $last_item and wpcf7_is_mailbox_list( $last_item ) ) {
					return $example_email;
				} else {
					return $example_text;
				}
			}

			if ( 'email' === $form_tag->basetype ) {
				return $example_email;
			} else {
				return $example_text;
			}

		} else { // maybe special mail tag
			// for back-compat
			$field_name = preg_replace( '/^wpcf7\./', '_', $field_name );

			if ( '_site_admin_email' === $field_name ) {
				return get_bloginfo( 'admin_email', 'raw' );

			} elseif ( '_user_agent' === $field_name ) {
				return $example_text;

			} elseif ( '_user_email' === $field_name ) {
				return $this->contact_form->is_true( 'subscribers_only' )
					? $example_email
					: $example_blank;

			} elseif ( str_starts_with( $field_name, '_user_' ) ) {
				return $this->contact_form->is_true( 'subscribers_only' )
					? $example_text
					: $example_blank;

			} elseif ( str_starts_with( $field_name, '_' ) ) {
				return str_ends_with( $field_name, '_email' )
					? $example_email
					: $example_text;

			}
		}

		return $tag;
	}


	/**
	 * Runs error detection for the mail sections.
	 */
	public function validate_mail( $template = 'mail' ) {
		if (
			$this->contact_form->is_true( 'demo_mode' ) or
			$this->contact_form->is_true( 'skip_mail' )
		) {
			return;
		}

		$components = (array) $this->contact_form->prop( $template );

		if ( ! $components ) {
			return;
		}

		if ( 'mail' !== $template and empty( $components['active'] ) ) {
			return;
		}

		$components = wp_parse_args( $components, array(
			'subject' => '',
			'sender' => '',
			'recipient' => '',
			'additional_headers' => '',
			'body' => '',
			'attachments' => '',
		) );

<<<<<<< HEAD
		$this->validate_mail_subject(
			$template,
			$components['subject']
		);

		$this->validate_mail_sender(
			$template,
			$components['sender']
		);

		$this->validate_mail_recipient(
			$template,
			$components['recipient']
		);

		$this->validate_mail_additional_headers(
			$template,
			$components['additional_headers']
		);

		$this->validate_mail_body(
			$template,
			$components['body']
		);

		$this->validate_mail_attachments(
			$template,
			$components['attachments']
		);
	}


	/**
	 * Runs error detection for the mail subject section.
	 */
	public function validate_mail_subject( $template, $content ) {
		$section = sprintf( '%s.subject', $template );

		if ( $this->supports( 'maybe_empty' ) ) {
			if ( $this->detect_maybe_empty( $section, $content ) ) {
				$this->add_error( $section, 'maybe_empty',
					array(
						'message' => __( "There is a possible empty field.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'maybe_empty' );
			}
		}
	}


	/**
	 * Runs error detection for the mail sender section.
	 */
	public function validate_mail_sender( $template, $content ) {
		$section = sprintf( '%s.sender', $template );

		if ( $this->supports( 'invalid_mailbox_syntax' ) ) {
			if ( $this->detect_invalid_mailbox_syntax( $section, $content ) ) {
				$this->add_error( $section, 'invalid_mailbox_syntax',
					array(
						'message' => __( "Invalid mailbox syntax is used.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'invalid_mailbox_syntax' );
			}
		}

		if ( $this->supports( 'email_not_in_site_domain' ) ) {
			$this->remove_error( $section, 'email_not_in_site_domain' );

			if ( ! $this->has_error( $section, 'invalid_mailbox_syntax' ) ) {
				$sender = $this->replace_mail_tags( $content );
				$sender = wpcf7_strip_newline( $sender );

				if ( ! wpcf7_is_email_in_site_domain( $sender ) ) {
					$this->add_error( $section, 'email_not_in_site_domain',
						array(
							'message' => __( "Sender email address does not belong to the site domain.", 'contact-form-7' ),
						)
					);
				}
			}
		}
	}


	/**
	 * Runs error detection for the mail recipient section.
	 */
	public function validate_mail_recipient( $template, $content ) {
		$section = sprintf( '%s.recipient', $template );

		if ( $this->supports( 'invalid_mailbox_syntax' ) ) {
			if ( $this->detect_invalid_mailbox_syntax( $section, $content ) ) {
				$this->add_error( $section, 'invalid_mailbox_syntax',
					array(
						'message' => __( "Invalid mailbox syntax is used.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'invalid_mailbox_syntax' );
			}
		}

		if ( $this->supports( 'unsafe_email_without_protection' ) ) {
			$this->remove_error( $section, 'unsafe_email_without_protection' );

			if ( ! $this->has_error( $section, 'invalid_mailbox_syntax' ) ) {
				if (
					$this->detect_unsafe_email_without_protection( $section, $content )
				) {
					$this->add_error( $section, 'unsafe_email_without_protection',
						array(
							'message' => __( "Unsafe email config is used without sufficient protection.", 'contact-form-7' ),
						)
					);
				}
			}
		}
	}


	/**
	 * Runs error detection for the mail additional headers section.
	 */
	public function validate_mail_additional_headers( $template, $content ) {
		$section = sprintf( '%s.additional_headers', $template );

		$invalid_mail_headers = array();
		$invalid_mailbox_fields = array();
		$unsafe_email_fields = array();

		foreach ( explode( "\n", $content ) as $header ) {
=======
		$callback = array( $this, 'replace_mail_tags_with_minimum_input' );

		$subject = new WPCF7_MailTaggedText(
			$components['subject'],
			array( 'callback' => $callback )
		);

		$subject = $subject->replace_tags();
		$subject = wpcf7_strip_newline( $subject );

		$this->detect_maybe_empty( sprintf( '%s.subject', $template ), $subject );

		$sender = new WPCF7_MailTaggedText(
			$components['sender'],
			array( 'callback' => $callback )
		);

		$sender = $sender->replace_tags();
		$sender = wpcf7_strip_newline( $sender );

		$invalid_mailbox = $this->detect_invalid_mailbox_syntax(
			sprintf( '%s.sender', $template ),
			$sender
		);

		if ( ! $invalid_mailbox and ! wpcf7_is_email_in_site_domain( $sender ) ) {
			$this->add_error( sprintf( '%s.sender', $template ),
				'email_not_in_site_domain',
				array(
					'message' => __( "Sender email address does not belong to the site domain.", 'contact-form-7' ),
				)
			);
		}

		$recipient = new WPCF7_MailTaggedText(
			$components['recipient'],
			array( 'callback' => $callback )
		);

		$recipient = $recipient->replace_tags();
		$recipient = wpcf7_strip_newline( $recipient );

		$this->detect_invalid_mailbox_syntax(
			sprintf( '%s.recipient', $template ),
			$recipient
		);

		$additional_headers = new WPCF7_MailTaggedText(
			$components['additional_headers'],
			array( 'callback' => $callback )
		);

		$additional_headers = $additional_headers->replace_tags();
		$additional_headers = explode( "\n", $additional_headers );
		$mailbox_header_types = array( 'reply-to', 'cc', 'bcc' );
		$invalid_mail_header_exists = false;

		foreach ( $additional_headers as $header ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			$header = trim( $header );

			if ( '' === $header ) {
				continue;
			}

<<<<<<< HEAD
			$is_valid_header = preg_match(
				'/^([0-9A-Za-z-]+):(.*)$/',
				$header,
				$matches
			);

			if ( ! $is_valid_header ) {
				$invalid_mail_headers[] = $header;
				continue;
			}

			$header_name = $matches[1];
			$header_value = trim( $matches[2] );

			if (
				in_array(
					strtolower( $header_name ), array( 'reply-to', 'cc', 'bcc' )
				) and
				'' !== $header_value and
				$this->detect_invalid_mailbox_syntax( $section, $header_value )
			) {
				$invalid_mailbox_fields[] = $header_name;
				continue;
			}

			if (
				in_array( strtolower( $header_name ), array( 'cc', 'bcc' ) ) and
				$this->detect_unsafe_email_without_protection( $section, $header_value )
			) {
				$unsafe_email_fields[] = $header_name;
			}
		}

		if ( $this->supports( 'invalid_mail_header' ) ) {
			if ( ! empty( $invalid_mail_headers ) ) {
				$this->add_error( $section, 'invalid_mail_header',
					array(
						'message' => __( "There are invalid mail header fields.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'invalid_mail_header' );
			}
		}

		if ( $this->supports( 'invalid_mailbox_syntax' ) ) {
			if ( ! empty( $invalid_mailbox_fields ) ) {
				foreach ( $invalid_mailbox_fields as $header_name ) {
					$this->add_error( $section, 'invalid_mailbox_syntax',
						array(
							'message' => __( "Invalid mailbox syntax is used in the %name% field.", 'contact-form-7' ),
							'params' => array( 'name' => $header_name ),
						)
					);
				}
			} else {
				$this->remove_error( $section, 'invalid_mailbox_syntax' );
			}
		}

		if ( $this->supports( 'unsafe_email_without_protection' ) ) {
			if ( ! empty( $unsafe_email_fields ) ) {
				$this->add_error( $section, 'unsafe_email_without_protection',
					array(
						'message' => __( "Unsafe email config is used without sufficient protection.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'unsafe_email_without_protection' );
			}
		}
	}


	/**
	 * Runs error detection for the mail body section.
	 */
	public function validate_mail_body( $template, $content ) {
		$section = sprintf( '%s.body', $template );

		if ( $this->supports( 'maybe_empty' ) ) {
			if ( $this->detect_maybe_empty( $section, $content ) ) {
				$this->add_error( $section, 'maybe_empty',
					array(
						'message' => __( "There is a possible empty field.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'maybe_empty' );
			}
		}
	}


	/**
	 * Runs error detection for the mail attachments section.
	 */
	public function validate_mail_attachments( $template, $content ) {
		$section = sprintf( '%s.attachments', $template );

		$total_size = 0;
		$files_not_found = array();
		$files_out_of_content = array();

		if ( '' !== $content ) {
=======
			if ( ! preg_match( '/^([0-9A-Za-z-]+):(.*)$/', $header, $matches ) ) {
				$invalid_mail_header_exists = true;
			} else {
				$header_name = $matches[1];
				$header_value = trim( $matches[2] );

				if ( in_array( strtolower( $header_name ), $mailbox_header_types )
				and '' !== $header_value ) {
					$this->detect_invalid_mailbox_syntax(
						sprintf( '%s.additional_headers', $template ),
						$header_value,
						array(
							'message' => __( "Invalid mailbox syntax is used in the %name% field.", 'contact-form-7' ),
							'params' => array( 'name' => $header_name )
						)
					);
				}
			}
		}

		if ( $invalid_mail_header_exists ) {
			$this->add_error( sprintf( '%s.additional_headers', $template ),
				'invalid_mail_header',
				array(
					'message' => __( "There are invalid mail header fields.", 'contact-form-7' ),
				)
			);
		}

		$body = new WPCF7_MailTaggedText(
			$components['body'],
			array( 'callback' => $callback )
		);

		$body = $body->replace_tags();

		$this->detect_maybe_empty( sprintf( '%s.body', $template ), $body );

		if ( '' !== $components['attachments'] ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			$attachables = array();

			$tags = $this->contact_form->scan_form_tags(
				array( 'type' => array( 'file', 'file*' ) )
			);

			foreach ( $tags as $tag ) {
				$name = $tag->name;

<<<<<<< HEAD
				if ( ! str_contains( $content, "[{$name}]" ) ) {
=======
				if ( ! str_contains( $components['attachments'], "[{$name}]" ) ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
					continue;
				}

				$limit = (int) $tag->get_limit_option();

				if ( empty( $attachables[$name] ) or $attachables[$name] < $limit ) {
					$attachables[$name] = $limit;
				}
			}

			$total_size = array_sum( $attachables );

<<<<<<< HEAD
			foreach ( explode( "\n", $content ) as $line ) {
=======
			$has_file_not_found = false;
			$has_file_not_in_content_dir = false;

			foreach ( explode( "\n", $components['attachments'] ) as $line ) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
				$line = trim( $line );

				if ( '' === $line or str_starts_with( $line, '[' ) ) {
					continue;
				}

<<<<<<< HEAD
				if ( $this->detect_file_not_found( $section, $line ) ) {
					$files_not_found[] = $line;
				} elseif ( $this->detect_file_not_in_content_dir( $section, $line ) ) {
					$files_out_of_content[] = $line;
				} else {
					$total_size += (int) @filesize( $path );
				}
			}
		}

		if ( $this->supports( 'file_not_found' ) ) {
			if ( ! empty( $files_not_found ) ) {
				foreach ( $files_not_found as $line ) {
					$this->add_error( $section, 'file_not_found',
						array(
							'message' => __( "Attachment file does not exist at %path%.", 'contact-form-7' ),
							'params' => array( 'path' => $line ),
						)
					);
				}
			} else {
				$this->remove_error( $section, 'file_not_found' );
			}
		}

		if ( $this->supports( 'file_not_in_content_dir' ) ) {
			if ( ! empty( $files_out_of_content ) ) {
				$this->add_error( $section, 'file_not_in_content_dir',
					array(
						'message' => __( "It is not allowed to use files outside the wp-content directory.", 'contact-form-7' ),
					)
				);
			} else {
				$this->remove_error( $section, 'file_not_in_content_dir' );
			}
		}

		if ( $this->supports( 'attachments_overweight' ) ) {
			$max = 25 * MB_IN_BYTES; // 25 MB

			if ( $max < $total_size ) {
				$this->add_error( $section, 'attachments_overweight',
=======
				$has_file_not_found = $this->detect_file_not_found(
					sprintf( '%s.attachments', $template ), $line
				);

				if ( ! $has_file_not_found and ! $has_file_not_in_content_dir ) {
					$has_file_not_in_content_dir = $this->detect_file_not_in_content_dir(
						sprintf( '%s.attachments', $template ), $line
					);
				}

				if ( ! $has_file_not_found ) {
					$path = path_join( WP_CONTENT_DIR, $line );
					$total_size += (int) @filesize( $path );
				}
			}

			$max = 25 * MB_IN_BYTES; // 25 MB

			if ( $max < $total_size ) {
				$this->add_error( sprintf( '%s.attachments', $template ),
					'attachments_overweight',
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
					array(
						'message' => __( "The total size of attachment files is too large.", 'contact-form-7' ),
					)
				);
<<<<<<< HEAD
			} else {
				$this->remove_error( $section, 'attachments_overweight' );
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
			}
		}
	}


	/**
	 * Detects errors of invalid mailbox syntax.
	 *
	 * @link https://contactform7.com/configuration-errors/invalid-mailbox-syntax/
	 */
<<<<<<< HEAD
	public function detect_invalid_mailbox_syntax( $section, $content ) {
		$content = $this->replace_mail_tags( $content );
		$content = wpcf7_strip_newline( $content );

		if ( ! wpcf7_is_mailbox_list( $content ) ) {
			return true;
=======
	public function detect_invalid_mailbox_syntax( $section, $content, $args = '' ) {
		$args = wp_parse_args( $args, array(
			'message' => __( "Invalid mailbox syntax is used.", 'contact-form-7' ),
			'params' => array(),
		) );

		if ( ! wpcf7_is_mailbox_list( $content ) ) {
			return $this->add_error( $section,
				'invalid_mailbox_syntax',
				$args
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		return false;
	}


	/**
	 * Detects errors of empty message fields.
	 *
	 * @link https://contactform7.com/configuration-errors/maybe-empty/
	 */
	public function detect_maybe_empty( $section, $content ) {
<<<<<<< HEAD
		$content = $this->replace_mail_tags( $content );
		$content = wpcf7_strip_newline( $content );

		if ( '' === $content ) {
			return true;
=======
		if ( '' === $content ) {
			return $this->add_error( $section,
				'maybe_empty',
				array(
					'message' => __( "There is a possible empty field.", 'contact-form-7' ),
				)
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		return false;
	}


	/**
	 * Detects errors of nonexistent attachment files.
	 *
	 * @link https://contactform7.com/configuration-errors/file-not-found/
	 */
	public function detect_file_not_found( $section, $content ) {
		$path = path_join( WP_CONTENT_DIR, $content );

		if ( ! is_readable( $path ) or ! is_file( $path ) ) {
<<<<<<< HEAD
			return true;
=======
			return $this->add_error( $section,
				'file_not_found',
				array(
					'message' => __( "Attachment file does not exist at %path%.", 'contact-form-7' ),
					'params' => array( 'path' => $content ),
				)
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		return false;
	}


	/**
	 * Detects errors of attachment files out of the content directory.
	 *
	 * @link https://contactform7.com/configuration-errors/file-not-in-content-dir/
	 */
	public function detect_file_not_in_content_dir( $section, $content ) {
		$path = path_join( WP_CONTENT_DIR, $content );

		if ( ! wpcf7_is_file_path_in_content_dir( $path ) ) {
<<<<<<< HEAD
			return true;
		}

		return false;
	}


	/**
	 * Detects errors of that unsafe email config is used without
	 * sufficient protection.
	 *
	 * @link https://contactform7.com/configuration-errors/unsafe-email-without-protection/
	 */
	public function detect_unsafe_email_without_protection( $section, $content ) {
		static $is_recaptcha_active = null;

		if ( null === $is_recaptcha_active ) {
			$is_recaptcha_active = call_user_func( function () {
				$service = WPCF7_RECAPTCHA::get_instance();
				return $service->is_active();
			} );
		}

		if ( $is_recaptcha_active ) {
			return false;
		}

		$example_email = 'user-specified@example.com';

		// Replace mail-tags connected to an email type form-tag first.
		$content = $this->replace_mail_tags( $content, array(
			'callback' => function ( $matches ) use ( $example_email ) {
				// allow [[foo]] syntax for escaping a tag
				if ( $matches[1] === '[' and $matches[4] === ']' ) {
					return substr( $matches[0], 1, -1 );
				}

				$tag = $matches[0];
				$tagname = $matches[2];
				$values = $matches[3];

				$mail_tag = new WPCF7_MailTag( $tag, $tagname, $values );
				$field_name = $mail_tag->field_name();

				$form_tags = $this->contact_form->scan_form_tags(
					array( 'name' => $field_name )
				);

				if ( $form_tags ) {
					$form_tag = new WPCF7_FormTag( $form_tags[0] );

					if ( 'email' === $form_tag->basetype ) {
						return $example_email;
					}
				}

				return $tag;
			},
		) );

		// Replace remaining mail-tags.
		$content = $this->replace_mail_tags( $content );

		$content = wpcf7_strip_newline( $content );

		if ( str_contains( $content, $example_email ) ) {
			return true;
=======
			return $this->add_error( $section,
				'file_not_in_content_dir',
				array(
					'message' => __( "It is not allowed to use files outside the wp-content directory.", 'contact-form-7' ),
				)
			);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
		}

		return false;
	}

}
