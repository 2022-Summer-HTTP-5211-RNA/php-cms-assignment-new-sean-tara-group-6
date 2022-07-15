<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: contact.php' );
  die();
  
}

if( isset( $_POST['firstname'] ) )
{
  
  if( $_POST['firstname'] and $_POST['message'] )
  {
    
    $query = 'UPDATE contact SET
      firstname = "'.mysqli_real_escape_string( $connect, $_POST['firstname'] ).'",
      lastname = "'.mysqli_real_escape_string( $connect, $_POST['lastname'] ).'",
      email = "'.mysqli_real_escape_string( $connect, $_POST['email'] ).'",
      message = "'.mysqli_real_escape_string( $connect, $_POST['message'] ).'",
      date = "'.mysqli_real_escape_string( $connect, $_POST['date'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Contact has been updated' );
    
  }

  header( 'Location: contact.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM contact
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: contact.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Contact</h2>

<form method="post">
  
  <label for="firstname">First Name:</label>
  <input type="text" name="firstname" id="firstname" value="<?php echo htmlentities( $record['firstname'] ); ?>">
    
  <br>

  <label for="lastname">Last Name:</label>
  <input type="text" name="lastname" id="lastname" value="<?php echo htmlentities( $record['lastname'] ); ?>">
    
  <br>

  <label for="email">Email:</label>
  <input type="text" name="email" id="email" value="<?php echo htmlentities( $record['email'] ); ?>">
    
  <br>
  
  <label for="message">Message:</label>
  <textarea type="text" name="message" id="message" rows="5"><?php echo htmlentities( $record['message'] ); ?></textarea>
  
  <script>

  ClassicEditor
    .create( document.querySelector( '#message' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="date">Date:</label>
  <input type="date" name="date" id="date" value="<?php echo htmlentities( $record['date'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit Contact">
  
</form>

<p><a href="contact.php"><i class="fas fa-arrow-circle-left"></i> Return to Contact List</a></p>


<?php

include( 'includes/footer.php' );

?>