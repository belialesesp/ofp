<?php
// CREDIT CARDS INFO FIELDS


// FUNCTION TO FILL SELECT WITH CREDIT CARD INFO
function load_credit_cards_options( $field ) {
	$field['choices'] = array();

	if ( have_rows( 'credit_cards', 'option' ) ) {
		$index = 0;
		while ( have_rows( 'credit_cards', 'option' ) ) {
			the_row();
			$field['choices'][ $index ] = get_sub_field( 'cci_card_name' );
			$index++;
		}
	}

	return $field;
}
add_filter( 'acf/load_field/name=ccb_credit_card', 'load_credit_cards_options' );


function rs_upload_from_url( $url, $title = null, $content = null, $alt = null ) {
	require_once( ABSPATH . '/wp-load.php' );
	require_once( ABSPATH . '/wp-admin/includes/image.php' );
	require_once( ABSPATH . '/wp-admin/includes/file.php' );
	require_once( ABSPATH . '/wp-admin/includes/media.php' );

	// Download url to a temp file
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) return false;

	// Get the filename and extension
	$filename  = pathinfo( $url, PATHINFO_FILENAME );
	$extension = pathinfo( $url, PATHINFO_EXTENSION );

	if ( ! $extension ) {
		$mime = mime_content_type( $tmp );
		$mime = is_string( $mime ) ? sanitize_mime_type( $mime ) : false;

		$mime_extensions = array(
			'text/plain'         => 'txt',
			'text/csv'           => 'csv',
			'application/msword' => 'doc',
			'image/jpg'          => 'jpg',
			'image/jpeg'         => 'jpeg',
			'image/gif'          => 'gif',
			'image/png'          => 'png',
			'image/webp'         => 'webp',
			'video/mp4'          => 'mp4',
		);

		if ( isset( $mime_extensions[ $mime ] ) ) {
			$extension = $mime_extensions[ $mime ];
		} else {
			// Could not identify extension — clear temp file and abort.
			wp_delete_file( $tmp );
			return false;
		}
	}

	$args = array(
		'name'     => "$filename.$extension",
		'tmp_name' => $tmp,
	);

	$post_data = array();
	if ( $title )   $post_data['post_title']   = $title;
	if ( $content ) $post_data['post_content'] = $content;

	$attachment_id = media_handle_sideload( $args, 0, null, $post_data );

	wp_delete_file( $tmp );

	if ( is_wp_error( $attachment_id ) ) return false;

	if ( $alt ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt );
	}

	return $attachment_id;
}


// ── Metabox registration ───────────────────────────────────────────────────

function add_import_cards_metabox() {
	add_meta_box(
		'import_cards_metabox',
		__( 'Import Cards', 'our-family-passport' ),
		'show_import_cards_metabox',
		'acf_options_page',
		'normal'
	);
}
add_action( 'acf/input/admin_head', 'add_import_cards_metabox', 10 );


// ── Metabox HTML ───────────────────────────────────────────────────────────

function show_import_cards_metabox() {
	if ( ! function_exists( 'get_current_screen' ) ) return;

	$current_screen    = get_current_screen();
	$current_screen_id = $current_screen->id;
	?>
	<p>Upload CSV File to import cards</p>
	<div class="d-flex justify-content-between">
		<input type="hidden" name="post_id" value="<?php echo esc_attr( $current_screen_id ); ?>">
		<?php wp_nonce_field( 'import_cards_csv', 'import_cards_nonce' ); ?>
		<input type="file" name="cards_data" value="">
		<button id="importCardsCSV" class="button button-primary button-large" type="button">
			Import Data
		</button>
	</div>
	<?php
}


// ── AJAX handler ───────────────────────────────────────────────────────────

function add_cards_meta_data() {
	// 1. Capability check — logged-in admins only.
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Insufficient permissions.' ), 403 );
	}

	// 2. Nonce verification.
	if (
		! isset( $_POST['import_cards_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['import_cards_nonce'] ) ), 'import_cards_csv' )
	) {
		wp_send_json_error( array( 'message' => 'Security check failed.' ), 403 );
	}

	// 3. File check.
	if ( empty( $_FILES['cards_data']['name'] ) ) {
		wp_send_json_error( array( 'message' => 'No file uploaded.' ), 400 );
	}

	try {
		$upload = wp_upload_bits(
			$_FILES['cards_data']['name'],
			null,
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			file_get_contents( $_FILES['cards_data']['tmp_name'] )
		);

		$file  = fopen( $upload['url'], 'r' ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$count = 0;
		$rows  = get_field( 'credit_cards', 'option' ) ?: 0;
		$lines = array();

		while ( ( $line = fgetcsv( $file, 1000, ';' ) ) !== false ) {
			$numero = count( $line );
			$count++;

			$lines[] = array(
				'details'          => "$numero fields in line $count",
				'cci_card_name'    => $line[0],
				'cci_card_image'   => rs_upload_from_url( $line[1], $line[0], null, $line[0] ),
				'cci_learn_more_link' => $line[2],
				'cci_card_type'    => $line[4],
				'cci_old_offer'    => $line[5],
				'cci_new_offer'    => $line[6],
				'cci_current_offer' => $line[7],
				'cci_annual_fee'   => $line[8],
				'cci_offer_ends'   => $line[9],
				'cci_terms_apply'  => $line[10],
				'cci_rates_and_fees' => $line[11],
				'cci_little_blurb' => $line[13],
			);

			if ( $rows == 0 || $count > count( $rows ) ) {
				add_row( 'credit_cards', array(
					'cci_card_name'       => $line[0],
					'cci_card_image'      => rs_upload_from_url( $line[1], $line[0], null, $line[0] ),
					'cci_learn_more_link' => $line[2],
					'cci_card_type'       => $line[4],
					'cci_old_offer'       => $line[5],
					'cci_new_offer'       => $line[6],
					'cci_current_offer'   => $line[7],
					'cci_annual_fee'      => $line[8],
					'cci_offer_ends'      => $line[9],
					'cci_terms_apply'     => $line[10],
					'cci_rates_and_fees'  => $line[11],
					'cci_little_blurb'    => $line[13],
				), 'option' );
			} else {
				update_sub_field( array( 'credit_cards', $count, 'cci_card_name' ),        $line[0],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_card_image' ),       rs_upload_from_url( $line[1], $line[0], null, $line[0] ), 'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_learn_more_link' ),  $line[17], 'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_card_type' ),        $line[4],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_old_offer' ),        $line[5],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_new_offer' ),        $line[6],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_current_offer' ),    $line[7],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_annual_fee' ),       $line[8],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_offer_ends' ),       $line[9],  'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_terms_apply' ),      $line[10], 'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_rates_and_fees' ),   $line[11], 'option' );
				update_sub_field( array( 'credit_cards', $count, 'cci_little_blurb' ),     $line[13], 'option' );
			}
		}

		fclose( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions

		wp_send_json_success( $lines );

	} catch ( \Throwable $th ) {
		wp_send_json_error( array( 'message' => $th->getMessage() ), 500 );
	}
}

// Logged-in admin only — nopriv hook intentionally removed.
add_action( 'wp_ajax_add_cards_meta_data', 'add_cards_meta_data' );