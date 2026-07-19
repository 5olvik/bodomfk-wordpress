<?php
/**
 * Git-managed content pages and the small Markdown renderer they use.
 *
 * The files in content/pages are the public source of truth for selected
 * information pages. WordPress' stored page content remains an automatic
 * fallback if a file is missing or unreadable.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the public pages whose body text is maintained in Git.
 *
 * @return array
 */
function bmfk_git_content_pages() {
	return array(
		'medlemsfordeler' => 'medlemsfordeler.md',
		'klubbhytta'      => 'klubbhytta.md',
		'kontaktoss'      => 'kontaktoss.md',
		'flyplassregler'  => 'flyplassregler.md',
	);
}

/**
 * Replace a few stable site values before Markdown is rendered.
 *
 * @param string $markdown Markdown source.
 * @return string
 */
function bmfk_git_content_replace_tokens( $markdown ) {
	$tokens = array(
		'{{membership_url}}'     => bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' ),
		'{{incident_url}}'       => bmfk_setting( 'bmfk_incident_url', BMFK_INCIDENT_REPORT_URL ),
		'{{handbook_url}}'       => BMFK_HANDBOOK_URL,
		'{{avinor_pdf_url}}'     => bmfk_asset_url( 'documents/avinor-bestemorenga-avtale-2026.pdf' ),
		'{{rules_2018_pdf_url}}' => bmfk_asset_url( 'documents/flyplass-og-sikkerhetsregler-2018.pdf' ),
	);

	return strtr( $markdown, $tokens );
}

/**
 * Render safe inline Markdown used by the club's content files.
 *
 * @param string $text Inline Markdown.
 * @return string
 */
function bmfk_markdown_inline( $text ) {
	$text = esc_html( trim( $text ) );
	$text = preg_replace( '/\*\*(.+?)\*\*/u', '<strong>$1</strong>', $text );

	$text = preg_replace_callback(
		'/\[([^\]]+)\]\(([^)]+)\)/u',
		function ( $matches ) {
			$url = html_entity_decode( $matches[2], ENT_QUOTES, 'UTF-8' );
			$url = esc_url( $url, array( 'http', 'https', 'mailto' ) );

			if ( ! $url ) {
				return $matches[1];
			}

			$attributes = preg_match( '/\.pdf(?:$|[?#])/i', $url ) ? ' target="_blank" rel="noopener noreferrer"' : '';

			return '<a href="' . $url . '"' . $attributes . '>' . $matches[1] . '</a>';
		},
		$text
	);

	if ( false !== strpos( $text, '{{contact_email_link}}' ) ) {
		$text = str_replace(
			'{{contact_email_link}}',
			bmfk_protected_email_link( bmfk_setting( 'bmfk_contact_email', 'post@bodomfk.no' ) ),
			$text
		);
	}

	if ( false !== strpos( $text, '{{invoice_email_link}}' ) ) {
		$text = str_replace(
			'{{invoice_email_link}}',
			bmfk_protected_email_link( bmfk_setting( 'bmfk_invoice_email', 'faktura@bodomfk.no' ) ),
			$text
		);
	}

	return $text;
}

/**
 * Join Markdown paragraph lines while preserving two-space hard line breaks.
 *
 * @param string[] $lines Paragraph lines.
 * @return string
 */
function bmfk_markdown_paragraph_text( $lines ) {
	$html       = '';
	$hard_break = false;

	foreach ( $lines as $line ) {
		if ( '' !== $html ) {
			$html .= $hard_break ? '<br>' : ' ';
		}

		$backslash_break = '\\' === substr( $line, -1 );
		$hard_break      = $backslash_break || '  ' === substr( $line, -2 );
		$line_text       = $backslash_break ? substr( $line, 0, -1 ) : rtrim( $line );
		$html           .= bmfk_markdown_inline( $line_text );
	}

	return $html;
}

/**
 * Flush accumulated Markdown blocks into an HTML array.
 *
 * @param string[] $html            Output HTML blocks.
 * @param string[] $paragraph       Accumulated paragraph lines.
 * @param string[] $list            Accumulated list entries.
 * @param string[] $quote           Accumulated quote lines.
 * @param int      $paragraph_count Rendered paragraph count.
 */
function bmfk_markdown_flush_blocks( &$html, &$paragraph, &$list, &$quote, &$paragraph_count ) {
	if ( $paragraph ) {
		$class  = 0 === $paragraph_count ? ' class="has-large-font-size"' : '';
		$html[] = '<p' . $class . '>' . bmfk_markdown_paragraph_text( $paragraph ) . '</p>';
		$paragraph_count++;
		$paragraph = array();
	}

	if ( $list ) {
		$items = array();
		foreach ( $list as $item ) {
			$items[] = '<li>' . bmfk_markdown_inline( $item ) . '</li>';
		}
		$html[] = '<ul>' . implode( '', $items ) . '</ul>';
		$list   = array();
	}

	if ( $quote ) {
		$html[] = '<blockquote class="wp-block-quote"><p>' . bmfk_markdown_paragraph_text( $quote ) . '</p></blockquote>';
		$quote  = array();
	}
}

/**
 * Convert the deliberately small Markdown subset used by BMFK into HTML.
 *
 * Supported extensions are :::columns / :::column / :::endcolumns and the
 * one-line button form [Button: Label](URL). All ordinary text is escaped.
 *
 * @param string $markdown Markdown source.
 * @return string
 */
function bmfk_markdown_to_html( $markdown ) {
	$lines           = preg_split( '/\R/u', trim( $markdown ) );
	$html            = array();
	$paragraph       = array();
	$list            = array();
	$quote           = array();
	$paragraph_count = 0;
	$in_columns      = false;
	$in_column       = false;

	foreach ( $lines as $line ) {
		$trimmed = trim( $line );

		if ( ':::columns' === $trimmed ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			if ( $in_column ) {
				$html[]    = '</div>';
				$in_column = false;
			}
			if ( $in_columns ) {
				$html[] = '</div>';
			}
			$html[]      = '<div class="wp-block-columns">';
			$in_columns = true;
			continue;
		}

		if ( ':::column' === $trimmed && $in_columns ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			if ( $in_column ) {
				$html[] = '</div>';
			}
			$html[]    = '<div class="wp-block-column wp-dark-mode-ignore">';
			$in_column = true;
			continue;
		}

		if ( ':::endcolumns' === $trimmed && $in_columns ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			if ( $in_column ) {
				$html[] = '</div>';
			}
			$html[]      = '</div>';
			$in_column  = false;
			$in_columns = false;
			continue;
		}

		if ( preg_match( '/^\[Button:\s*([^\]]+)\]\(([^)]+)\)$/u', $trimmed, $button ) ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			$url = esc_url( $button[2], array( 'http', 'https', 'mailto' ) );
			if ( $url ) {
				$attributes = preg_match( '/\.pdf(?:$|[?#])/i', $url ) ? ' target="_blank" rel="noopener noreferrer"' : '';
				$html[]     = '<div class="wp-block-buttons"><div class="wp-block-button wp-dark-mode-ignore"><a class="wp-block-button__link wp-element-button" href="' . $url . '"' . $attributes . '>' . esc_html( $button[1] ) . '</a></div></div>';
			}
			continue;
		}

		if ( preg_match( '/^(#{2,4})\s+(.+)$/u', $trimmed, $heading ) ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			$level  = strlen( $heading[1] );
			$html[] = '<h' . $level . '>' . bmfk_markdown_inline( $heading[2] ) . '</h' . $level . '>';
			continue;
		}

		if ( preg_match( '/^-\s+(.+)$/u', $trimmed, $list_item ) ) {
			if ( $paragraph || $quote ) {
				bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			}
			$list[] = $list_item[1];
			continue;
		}

		if ( preg_match( '/^>\s?(.*)$/u', $trimmed, $quote_line ) ) {
			if ( $paragraph || $list ) {
				bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			}
			$quote[] = $quote_line[1];
			continue;
		}

		if ( '' === $trimmed ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
			continue;
		}

		if ( $list || $quote ) {
			bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );
		}
		$paragraph[] = $line;
	}

	bmfk_markdown_flush_blocks( $html, $paragraph, $list, $quote, $paragraph_count );

	if ( $in_column ) {
		$html[] = '</div>';
	}
	if ( $in_columns ) {
		$html[] = '</div>';
	}

	return implode( "\n", $html );
}

/**
 * Return rendered Git content for a page, or null to use WordPress content.
 *
 * @param string $slug WordPress page slug.
 * @return string|null
 */
function bmfk_git_page_content( $slug ) {
	static $cache = array();

	if ( array_key_exists( $slug, $cache ) ) {
		return $cache[ $slug ];
	}

	$pages = bmfk_git_content_pages();
	if ( ! isset( $pages[ $slug ] ) ) {
		$cache[ $slug ] = null;
		return null;
	}

	$path = get_template_directory() . '/content/pages/' . $pages[ $slug ];
	if ( ! is_readable( $path ) ) {
		$cache[ $slug ] = null;
		return null;
	}

	$markdown = file_get_contents( $path );
	if ( false === $markdown || '' === trim( $markdown ) ) {
		$cache[ $slug ] = null;
		return null;
	}

	$cache[ $slug ] = bmfk_markdown_to_html( bmfk_git_content_replace_tokens( $markdown ) );
	return $cache[ $slug ];
}

/**
 * Mark Git-managed pages in the WordPress page list.
 *
 * @param string[] $post_states Existing post states.
 * @param WP_Post  $post        Current post.
 * @return string[]
 */
function bmfk_git_content_post_state( $post_states, $post ) {
	if ( 'page' === $post->post_type && isset( bmfk_git_content_pages()[ $post->post_name ] ) ) {
		$post_states['bmfk_git_content'] = __( 'Innhold fra GitHub', 'bmfk' );
	}

	return $post_states;
}
add_filter( 'display_post_states', 'bmfk_git_content_post_state', 10, 2 );

/**
 * Warn editors when WordPress' stored body is only the emergency fallback.
 */
function bmfk_git_content_admin_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'post' !== $screen->base || 'page' !== $screen->post_type || empty( $_GET['post'] ) ) {
		return;
	}

	$post_id = absint( wp_unslash( $_GET['post'] ) );
	$slug    = get_post_field( 'post_name', $post_id );
	$pages   = bmfk_git_content_pages();

	if ( ! isset( $pages[ $slug ] ) ) {
		return;
	}

	$github_url = 'https://github.com/5olvik/bodomfk-wordpress/blob/main/themes/bodomfk-modern-theme/content/pages/' . rawurlencode( $pages[ $slug ] );
	?>
	<div class="notice notice-info">
		<p><strong><?php esc_html_e( 'Denne sideteksten styres fra GitHub.', 'bmfk' ); ?></strong> <?php esc_html_e( 'Innholdet i WordPress brukes bare som reserve dersom innholdsfilen mangler.', 'bmfk' ); ?> <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Åpne innholdsfilen', 'bmfk' ); ?></a></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'bmfk_git_content_admin_notice' );
