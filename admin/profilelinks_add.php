<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] )
  {
    
    $query = 'INSERT INTO profile_links (
        name,
        url,
        photo
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['url'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['photo'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Profile link has been added' );
    
  }
  
  header( 'Location: profilelinks.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Profile Link</h2>

<form method="post" enctype="multipart/form-data">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
  
  <br>
  
  <label for="photo">Photo:</label>
  <input type="file" name="photo" id="photo">
  
  <br>
  
  <input type="submit" value="Add Profile Link">
  
</form>

<p><a href="profilelinks.php"><i class="fas fa-arrow-circle-left"></i> Return to Profile Links List</a></p>


<?php

include( 'includes/footer.php' );

?>