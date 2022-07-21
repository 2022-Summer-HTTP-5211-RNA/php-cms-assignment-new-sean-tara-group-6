<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>

<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Website Admin</title>
  
  <!--<link href="styles.css" type="text/css" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="/admin/styles/w3css-master/w3.css">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>

  <h1>Hi, my name is Sean Trudel. I am a Front-end Web Developer.</h1>
  <p>I am a Front-end Web Developer with a passion for accessible design.</p>

  <?php

  $query = 'SELECT *
    FROM projects
    ORDER BY date DESC';
  $result = mysqli_query( $connect, $query );

  ?>

  <p>There are <?php echo mysqli_num_rows($result); ?> projects in the database!</p>

  <hr>

  <!-- Projects output on home page. -->
  <?php while($record = mysqli_fetch_assoc($result)): ?>

    <div>

      <h2><?php echo $record['title']; ?></h2>
      <?php echo $record['content']; ?>

      <?php if($record['photo']): ?>
      <!--
        <p>The image can be inserted using a base64 image:</p>
        
        <img src="<?php echo $record['photo']; ?>">

        <p>Or by streaming the image through the image.php file:</p>
      -->
        <img src="admin/image.php?type=project&id=<?php echo $record['id']; ?>&width=100&height=100">

      <?php else: ?>

        <p>This record does not have an image!</p>

      <?php endif; ?>

    </div>

    <hr>

  <?php endwhile; ?> <!-- End of Projects output on home page. -->


  <!-- CONTACT FORM -->
  <!-- Contact form PHP: -->
  <?php

  secure();

  if( isset( $_POST['firstname'] ) )
  {
    
    if( $_POST['firstname'] and $_POST['email'] and $_POST['message'] )
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
      
      set_message( 'Thank you for your message! I will get back to you as soon as possible. Have a nice day!' );
      
    }
    
    header( 'Location: index.php' );
    die();
    
  }

  ?> <!-- End of Contact form PHP. -->

  <!-- Contact form HTML: -->
  <h2>Contact Me</h2>

  <form method="post">
    
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" id="firstname">
      
    <br>

    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" id="lastname">
      
    <br>

    <label for="email">E-mail:</label>
    <input type="text" name="email" id="email">
    
    <br>
    
    <label for="message">Message:</label>
    <textarea type="text" name="message" id="message" rows="10"></textarea>
        
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
    <!--
    <label for="date">Date:</label>
    <input type="date" name="date" id="date">
    
    <br>
    -->
    
    <input type="submit" value="Send Message">
    
  </form>


</body>
</html>
