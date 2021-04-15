<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       razaalwani.ga
 * @since      1.0.0
 *
 * @package    Youtube_Plugin
 * @subpackage Youtube_Plugin/admin/partials
 */

?>
<?php
// Get the current page.
	$ypp_thecurrentpage = $_GET['page'];


?>
<div class="container " style=" width:100%; height:auto; ">
  <div class="row"  style="text-align:center; width:100%; margin:5px;">
	<div class="col-sm alert-primary" style="border: 3px solid black; ">
	<form method="get" action="">
	<input type="hidden" value="<?php echo( $ypp_thecurrentpage ); ?>" name="page"/>

	<input type="hidden" value="import" name="action"/>
	  <h4 class="import-data">Import the API data</h4><br>
		<button type="Submit" class="btn btn-danger">Import</button>
	</form>
	</div>
	<div class="col-sm alert-success"style="border: 3px solid black;">

	  <h4 class="renew-data">Renew/Update the API data</h4><br>
	<form method="get" action="">
	<input type="hidden" value="<?php echo( $ypp_thecurrentpage ); ?>" name="page"/>
	<input type="hidden" value="renew" name="action"/>

		<button type="Submit" class="btn btn-warning">Renew</button>
	</form>
	</div>
	<div class="col-sm alert-danger" style="border: 3px solid black;">
	  <h4 class="Delete-data">Delete the API data</h4><br>
	   <form method="get" action="">
	<input type="hidden" value="<?php echo( $ypp_thecurrentpage ); ?>" name="page"/>
	<input type="hidden" value="delete" name="action"/>

	   <button type="Submit" class="btn btn-success">Delete</button>
	   </form>
	</div>
  </div>
</div>

<?php

//get the action
$theaction  = ''; // initialize variable.
$bln_Import = false; // determine if the user imported.
$blnDelete  = false; // determine if the user deleted.

if ( isset( $_GET['action'] ) ) {
	//set the action
	$theaction = $_GET['action'];



	//this code runs on IMPORT ACTION
	if ( $theaction == 'import' ) {
		$theyoutubekey = get_option( 'youtubeAPIKey' );
		$thechannelid  = get_option( 'youtubeChannelID' );
		$videoList     = json_decode( file_get_contents( 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=' . $thechannelid . '&maxResults=1&key=' . $theyoutubekey ) );
		foreach ( $videoList->items as $item ) {
			// looping videos through custom post type.
			// insert the video.


			$data   = array(
				'post_title'    => $item->snippet->title,
				'post_content'  => $item->snippet->description,
				'post_category' => ( isset( $_POST['uncategorized'] ) ? array( $_POST['uncategorized'] ) : false ),
				'tags_input'    => ( isset( $tags ) ? array( $tags ) : false ),
				'post_status'   => 'publish',
				'post_type'     => 'youtube_cpt',
			);
			$data   = sanitize_post( $data, 'db' );
			$result = wp_insert_post( $data );
			// if ( $result == 1 ) {


				// var_dump($result);   die;.
				if ( ! is_null( $result ) && ! is_wp_error( $result ) ) {

					$thepostID = $result;
					add_post_meta( $thepostID, 'videoID', $item->videoId );

					add_post_meta( $thepostID, 'publishedAt', $item->snippet->publishedAt );

					add_post_meta( $thepostID, 'channelID', $item->snippet->channelId );

					add_post_meta( $thepostID, 'ytitle', $item->snippet->title );

					add_post_meta( $thepostID, 'ydescription', $item->snippet->description );

					add_post_meta( $thepostID, 'imageresmed', $item->snippet->thumbnails->medium->url );

					add_post_meta( $thepostID, 'imagereshigh', $item->snippet->thumbnails->high->url );

					//echo ( '<img src="' . get_post_meta( $thepostID, 'imageresmed', true ) . '"/>' );

					$bln_Import = true;

				// }
			}
		}
	}
}
