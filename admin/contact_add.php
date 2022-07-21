<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['firstname'] ) )
{
  
  if( $_POST['firstname'] )
  {
    
    $query = 'INSERT INTO contact (
        firstname,
        lastname,
        email,
        message,
        date
      ) VALUES (
        "'.mysqli_real_escape_string( $connect, $_POST['firstname'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['lastname'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['email'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['message'] ).'",
        "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Contact has been added' );
    
  }
  
  header( 'Location: contact.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Contact</h2>

<form method="post">
  
  <label for="firstname">First Name:</label>
  <input type="text" name="firstname" id="firstname">
    
  <br>
  
  <label for="lastname">Last Name:</label>
  <input type="text" name="lastname" id="lastname">

  <br>

  <label for="email">Email:</label>
  <input type="email" name="email" id="email">
  
  <br>

  <label for="message">Message:</label>
  <textarea type="text" name="message" id="message" rows="10"></textarea>
      
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

  <label for="date">Date:</label>
  <input type="date" name="date" id="date">
  
  <br>
  
  <input type="submit" value="Add Contact">
  
</form>

<p><a href="contact.php"><i class="fas fa-arrow-circle-left"></i> Return to Contact List</a></p>


<?php

include( 'includes/footer.php' );

?>