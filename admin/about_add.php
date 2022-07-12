<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'INSERT INTO about (
        title,
        content,
        firstname,
        lastname
      ) VALUES (
        "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['firstname'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['lastname'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'About has been added' );
    
  }
  
  header( 'Location: about.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add About</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>
      
  <script>

  ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="firstname">First Name:</label>
  <input type="text" name="firstname" id="firstname">
  
  <br>
  
  <label for="lastname">Last Name:</label>
  <input type="text" name="lastname" id="lastname">
  
  <br>
  
  <input type="submit" value="Add About">
  
</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About List</a></p>


<?php

include( 'includes/footer.php' );

?>