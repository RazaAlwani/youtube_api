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
<br>
<h1>General setting of plugin:</h1><br>
<div class="container" style="width: 100%; ">
  <div class="row ">
	<div class="col ">
	  <div class="alert alert-warning">

		<!-- This file should primarily consist of HTML with a little bit of PHP. -->
		<div class="container" style=" width:100%; height:auto; margin-top:55px;">
		  <form method="post" action="options.php">
			<?php
			settings_fields( 'our_custom_set' );
			do_settings_sections( 'our_custom_set' );
			?>
			<h1>Youtube API Plugin</h1>
			<div class="form-group">
			  <label for="YoutubeAPIKey">API Of Youtube</label>
			  <input type="text" name="YoutubeAPIKey" value="<?php echo get_option( 'YoutubeAPIKey' ); ?>" class="form-control" id="exampleFormControlInput1" placeholder="API ">
			</div>
			<div class="form-group">
			  <label for="YoutubeChannelID">Channel ID </label>
			  <input type="text" name="YoutubeChannelID" value="<?php echo get_option( 'YoutubeChannelID' ); ?>" class="form-control" id="exampleFormControlInput1" placeholder="Youtube Channel ID ">
			</div><br>
			<button type="submit" class="btn btn-danger" style="width: 40%;">submit</button>
		  </form>
		</div>
	  </div>
	</div>



	<div class="col">
	  <div class="alert alert-success">
		<h1>ShortCode settings</h1>
		<form>
		  <div class="form-group">
			<label for="post_count">Number of post </label>
			<input class="form-control" type="number" value="1" id="post_count" name="post_count">
			<br>
			<div class="col-sm-10">
			  <h5>Display type</h5>
			  <select class="form-select" aria-label="Disabled select example">

				<option selected>Open this select menu</option>
				<option value="1">Image Left</option>
				<option value="2">Image Center</option>
				<option value="3">Image Right</option>
			</div>

			  </select>
			  <br>
			<button type="submit" class="btn btn-primary" style="width: 35%;">Submit</button>
		  </div>

		</form>
	  </div>
	</div>

  </div>
</div>
