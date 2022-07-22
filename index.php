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
  <title>Sean Trudel Web Dev Portfolio</title>
  
  <!--<link href="styles.css" type="text/css" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="admin/styles/w3css-master/w3.css">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  <!--<script src="admin/javascript/contact_form_validation.js"></script>-->
  
  <!-- Hidden Thank You message that becomes visible upon Contact form submission. -->
  <style>#thanks_msg{display: none;}</style>
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

  //secure();

  if( isset( $_POST['f_firstname'] ) )  //Note: POST variables must be the same as form name= attributes.
  {
    
    if( $_POST['f_firstname'] and $_POST['f_email'] and $_POST['f_message'] )
    {
      
      $query = 'INSERT INTO contact (
          firstname,
          lastname,
          email,
          message,
          date
        ) VALUES (
           "'.mysqli_real_escape_string( $connect, $_POST['f_firstname'] ).'",
           "'.mysqli_real_escape_string( $connect, $_POST['f_lastname'] ).'",
           "'.mysqli_real_escape_string( $connect, $_POST['f_email'] ).'",
           "'.mysqli_real_escape_string( $connect, $_POST['f_message'] ).'",
           CURRENT_TIMESTAMP
        )';
      mysqli_query( $connect, $query );
           
    }
    
    header( 'Location: index.php' );
    die();
    
  }

  ?> <!-- End of Contact form PHP. -->
<!-- "'.mysqli_real_escape_string( $connect, $_POST['f_date'] ).'" -->


  <!-- Contact form HTML: -->
  <h2>Contact Me</h2>

  <form action="#" method="post" id="contactForm" name=form_contact">
    
    <label for="firstname">First Name:</label>
    <input type="text" name="f_firstname" id="firstname">
    <span id="firstnameError"></span>
      
    <br>

    <label for="lastname">Last Name:</label>
    <input type="text" name="f_lastname" id="lastname">
    <span id="lastnameError"></span>
      
    <br>

    <label for="email">E-mail:</label>
    <input type="text" name="f_email" id="email">
    <span id="emailError"></span>
    
    <br>
    
    <label for="message">Message:</label>
    <textarea type="text" name="f_message" id="message" rows="10"></textarea>
    <span id="messageError"></span>
        
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
    
    <input type="submit" value="Send Message" name="submit">
    
  </form> <!-- End of Contact form -->


  <!--#### OUTPUT MESSAGE (HIDDEN UNTIL FORM VALIDATES) #### -->
  <div id="thanks_msg">
    <h2>Thank you <span id="firstnameThanks"></span> <span id="lastnameThanks"></span> for your message! I will get back to you as soon as possible. Have a nice day!</h2>
    <!-- UPDATE: Insert code that prints User's firstname & lastname (info from Contact form submission;
    the latest info stored in the Contact table in the database) into above Thank You message. -->
    <!-- <span id="firstnameThanks"></span> <span id="lastnameThanks"></span> -->
  </div>
  

</body>
</html>
