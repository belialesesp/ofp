<?php
// CREDIT CARDS INFO FIELDS



// FUNCTION TO FILL SELECT WITH CREDIT CARD INFO
function load_credit_cards_options($field)
{
  // Reset choices
  $field['choices'] = array();
  // Check to see if Repeater has rows of data to loop over
  if (have_rows('credit_cards', 'option')) {
    // Execute repeatedly as long as the below statement is true
    $index = 0;
    while (have_rows('credit_cards', 'option')) {
      // Return an array with all values after the loop is complete
      the_row();
      // Variables
      $value = $index;
      $label = get_sub_field('cci_card_name');
      // Append to choices
      $field['choices'][$value] = $label;
      $index++;
    }
  }
  // Return the field
  return $field;
}
add_filter('acf/load_field/name=ccb_credit_card', 'load_credit_cards_options');

function rs_upload_from_url( $url, $title = null, $content = null, $alt = null ) {
	require_once( ABSPATH . "/wp-load.php");
	require_once( ABSPATH . "/wp-admin/includes/image.php");
	require_once( ABSPATH . "/wp-admin/includes/file.php");
	require_once( ABSPATH . "/wp-admin/includes/media.php");
	
	// Download url to a temp file
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) return false;
	
	// Get the filename and extension ("photo.png" => "photo", "png")
	$filename = pathinfo($url, PATHINFO_FILENAME);
	$extension = pathinfo($url, PATHINFO_EXTENSION);
	
	// An extension is required or else WordPress will reject the upload
	if ( ! $extension ) {
		// Look up mime type, example: "/photo.png" -> "image/png"
		$mime = mime_content_type( $tmp );
		$mime = is_string($mime) ? sanitize_mime_type( $mime ) : false;
		
		// Only allow certain mime types because mime types do not always end in a valid extension (see the .doc example below)
		$mime_extensions = array(
			// mime_type         => extension (no period)
			'text/plain'         => 'txt',
			'text/csv'           => 'csv',
			'application/msword' => 'doc',
			'image/jpg'          => 'jpg',
			'image/jpeg'         => 'jpeg',
			'image/gif'          => 'gif',
			'image/png'          => 'png',
			'image/webp'          => 'webp',
			'video/mp4'          => 'mp4',
		);
		
		if ( isset( $mime_extensions[$mime] ) ) {
			// Use the mapped extension
			$extension = $mime_extensions[$mime];
		}else{
			// Could not identify extension. Clear temp file and abort.
			wp_delete_file($tmp);
			return false;
		}
	}
	
	// Upload by "sideloading": "the same way as an uploaded file is handled by media_handle_upload"
	$args = array(
		'name' => "$filename.$extension",
		'tmp_name' => $tmp,
	);
	
	// Post data to override the post title, content, and alt text
	$post_data = array();
	if ( $title )   $post_data['post_title'] = $title;
	if ( $content ) $post_data['post_content'] = $content;
	
	// Do the upload
	$attachment_id = media_handle_sideload( $args, 0, null, $post_data );
	
	// Clear temp file
	wp_delete_file($tmp);
	
	// Error uploading
	if ( is_wp_error($attachment_id) ) return false;
	
	// Save alt text as post meta if provided
	if ( $alt ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt );
	}
	
	// Success, return attachment ID
   return $attachment_id;
}

// ADD IMPORT CSV TO CARDS
function add_import_cards_metabox()
{
  // if (!acf_is_screen('toplevel_page_credit-cards-settings')) return;
  // if (!acf_is_screen('options_page_credit-cards-settings')) return;
  add_meta_box('import_cards_metabox', __('Import Cards', 'textdomain'), 'show_import_cards_metabox', 'acf_options_page', 'normal');
}
add_action('acf/input/admin_head', 'add_import_cards_metabox', 10);

//showing custom form fields
function show_import_cards_metabox()
{
  global $post;

  // Use nonce for verification to secure data sending
  // wp_nonce_field(basename(__FILE__), 'wpse_our_once');
  if (!function_exists('get_current_screen')) return false;


  // vars
  $current_screen = get_current_screen();
  $current_screen_id = $current_screen->id;
?>

  <!-- my custom value input -->
  <p>Upload CSV File to import cards</p>
  <div class="d-flex justify-content-between">
    <input type="hidden" name="post_id" value="<?= $current_screen_id  ?>">
    <input type="file" name="cards_data" value="">
    <button id="importCardsCSV" class="button button-primary button-large" type="button">Import Data</button>
  </div>
<?php
}


//now we are saving the data
function add_cards_meta_data()
{
  try {
    //so our basic checking is done, now we can grab what we've passed from our newly created form
    if (!empty($_FILES['cards_data']['name'])) {
      $upload = wp_upload_bits($_FILES['cards_data']['name'], null, file_get_contents($_FILES['cards_data']['tmp_name']));

      $file = fopen($upload['url'], 'r');
      $count = 0;

      $rows = get_field('credit_cards', 'option') ? get_field('credit_cards', 'option') : 0;
      $lines = array();

      while (($line = fgetcsv($file, 1000, ';')) !== FALSE) {
        $numero = count($line);
        $count++;

        array_push($lines, array(
          'details' => "$numero de campos en la línea $count",
          'cci_card_name' => $line[0],
          'cci_card_image' => rs_upload_from_url($line[1], $line[0], null, $line[0] ),
          'cci_learn_more_link' => $line[2],
          'cci_card_type' => $line[4],
          'cci_old_offer' => $line[5],
          'cci_new_offer' => $line[6],
          'cci_current_offer' => $line[7],
          'cci_annual_fee' => $line[8],
          'cci_offer_ends' => $line[9],
          'cci_terms_apply' => $line[10],
          'cci_rates_and_fees' => $line[11],
          'cci_little_blurb' => $line[13],
        ));

        //$line is an array of the csv elements 
        if ($rows == 0 || $count > count($rows) ) {
          add_row('credit_cards', array(
            'cci_card_name' => $line[0],
            'cci_card_image' => rs_upload_from_url($line[1], $line[0], null, $line[0] ),
            'cci_learn_more_link' => $line[2],
            'cci_card_type' => $line[4],
            'cci_old_offer' => $line[5],
            'cci_new_offer' => $line[6],
            'cci_current_offer' => $line[7],
            'cci_annual_fee' => $line[8],
            'cci_offer_ends' => $line[9],
            'cci_terms_apply' => $line[10],
            'cci_rates_and_fees' => $line[11],
            'cci_little_blurb' => $line[13],
          ), 'option');
        } else {
          update_sub_field(array('credit_cards', $count, 'cci_card_name'), $line[0], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_card_image'),  rs_upload_from_url($line[1], $line[0], null, $line[0]), 'option');
          update_sub_field(array('credit_cards', $count, 'cci_learn_more_link'), $line[17], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_card_type'), $line[4], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_old_offer'), $line[5], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_new_offer'), $line[6], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_current_offer'), $line[7], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_annual_fee'), $line[8], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_offer_ends'), $line[9], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_terms_apply'), $line[10], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_rates_and_fees'), $line[11], 'option');
          update_sub_field(array('credit_cards', $count, 'cci_little_blurb'), $line[13], 'option');
        }
        $count++;
      }
      fclose($file);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($lines, true, JSON_UNESCAPED_UNICODE);
      wp_die();
    } else {
      echo 'empty file';
      wp_die();
    }
  } catch (\Throwable $th) {
    echo $th;
  }
}

// add_action( 'acf/save_post', 'add_cards_meta_data', 20 );
add_action('wp_ajax_nopriv_add_cards_meta_data', 'add_cards_meta_data');
add_action('wp_ajax_add_cards_meta_data', 'add_cards_meta_data');
