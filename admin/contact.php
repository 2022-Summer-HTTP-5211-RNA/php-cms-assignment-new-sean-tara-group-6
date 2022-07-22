<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM contact
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Contact info and message has been deleted' );
  
  header( 'Location: contact.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM contact
  ORDER BY date DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Contacts</h2>

<p>When prospective clients submit messages through the Contact Me form their information is stored in the database and can be managed here.</p>

<br>

<table>
  <tr>
    <!--<th></th>-->
    <th align="center">ID</th>
    <th align="left">First Name</th>
    <th align="left">Last Name</th>
    <th align="center">Date of Message</th>
    <th align="center">E-mail</th>
    <th align="left">Message</th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left"><?php echo $record['firstname']; ?></td>
      <td align="left"><?php echo $record['lastname']; ?></td>
      <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['date'] ); ?></td>
      <td align="left"><?php echo $record['email']; ?></td>
      <td align="left"><?php echo $record['message']; ?></td>
      <td align="center"><a href="contact_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="contact.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this contact?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>


<?php

include( 'includes/footer.php' );

?>