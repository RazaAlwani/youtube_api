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
<div class="card" >
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
    settings_fields( 'our_custom_set' );
    do_settings_sections( 'our_custom_set' );
?>
<h1>Youtube API Plugin</h1>
  <div class="form-group">
    <label for="exampleFormControlInput1">API Of Youtube</label>
    <input type="text" name="theAPI" class="form-control" id="exampleFormControlInput1" placeholder="API ">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Channel ID </label>
    <input type="text" name="theChanel" class="form-control" id="exampleFormControlInput1" placeholder="Chanel ID ">
  </div><br>
  <button type="submit" class="btn btn-danger" style="width: 40%;">submit</button>
</form></div>