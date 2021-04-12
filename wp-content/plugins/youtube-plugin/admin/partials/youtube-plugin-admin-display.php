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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="card" style="width: 85%; background-color:lightblue; height:auto; margin-top:55px;">
  <!--   
  <div class="card-body">
    <h5 class="card-title">Youtube Plugin</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
<hr>
<br><br> -->
  <form method="post" action="options.php">
    <?php
    settings_fields('our_custom_set');
    do_settings_sections('our_custom_set');
    ?>
    <h1>Youtube API Plugin</h1>
    <div class="form-group">
      <label for="YoutubeAPIKey">API Of Youtube</label>
      <input type="text" name="YoutubeAPIKey" value="<?php echo get_option('YoutubeAPIKey'); ?>" class="form-control" id="exampleFormControlInput1" placeholder="API ">
    </div>
    <div class="form-group">
      <label for="YoutubeChannelID">Channel ID </label>
      <input type="text" name="YoutubeChannelID" value="<?php echo get_option('YoutubeChannelID'); ?>" class="form-control" id="exampleFormControlInput1" placeholder="Youtube Channel ID ">
    </div><br>
    <button type="submit" class="btn btn-danger" style="width: 40%;">submit</button>
  </form>
</div>
</div>

<?php

$theyoutubekey = get_option('YoutubeAPIKey');

$theyoutubeid = get_option('YoutubeChannelID');

$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=' . $theyoutubeid . '&maxResults=' . '1' . '&key=' . $theyoutubekey . ''));

foreach ($videoList->items as $item) {
  //looping videos through custom post type
  //insert the video 
  $data = array(
    'post_title' => $item->snippet->title,
    'post_content' => $item->snippet->description,
    'post_category' => ( isset( $_POST['uncategorized'] ) ? array( $_POST['uncategorized'] ) : false ),
    'tags_input' => ( isset ($tags) ? array($tags)  : false ),
    'post_status' => 'publish',
    'post_type' => 'youtube_cpt'
  );
  $data = sanitize_post($data, 'db');
  $result = wp_insert_post($data);
if($result==1)
{
  

//var_dump($result);   die;
  if (!is_null($result) && !is_wp_error($result)) {
    
    $thepostID = $result;
    add_post_meta($thepostID, 'videoID', $item->snippet->videoID);

    add_post_meta($thepostID, 'publishedAt', $item->snippet->publishedAt);

    add_post_meta($thepostID, 'channelID', $item->snippet->channelID);

    add_post_meta($thepostID, 'ytitle', $item->snippet->title);

    add_post_meta($thepostID, 'ydescription', $item->snippet->description);

    add_post_meta($thepostID, 'imageresmed', $item->snippet->thumbnails->medium->url);

    add_post_meta($thepostID, 'imagereshigh', $item->snippet->thumbnails->high->url);

    echo ('<img src="' . get_post_meta($thepostID, 'imageresmed', true) . '"/>');
  }
}
}
?>