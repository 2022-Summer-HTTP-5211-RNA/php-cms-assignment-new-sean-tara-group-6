<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: about.php' );
  die();
  
}

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'UPDATE about SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
      firstname = "'.mysqli_real_escape_string( $connect, $_POST['firstname'] ).'",
      lastname = "'.mysqli_real_escape_string( $connect, $_POST['lastname'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'About has been updated' );
    
  }

  header( 'Location: about.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM about
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: about.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit About</h2>

<form method="post">
  
  <label for="title">Title:</label>
  <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="5"><?php echo htmlentities( $record['content'] ); ?></textarea>
  
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
  <input type="text" name="firstname" id="firstname" value="<?php echo htmlentities( $record['firstname'] ); ?>">
    
  <br>
  
  <label for="lastname">Last Name:</label>
  <input type="text" name="lastname" id="lastname" value="<?php echo htmlentities( $record['lastname'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit About">
  
</form>

<p><a href="about.php"><i class="fas fa-arrow-circle-left"></i> Return to About List</a></p>


<?php

include( 'includes/footer.php' );

?>