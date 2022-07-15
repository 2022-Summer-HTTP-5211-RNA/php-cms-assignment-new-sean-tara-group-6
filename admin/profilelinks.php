<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM profile_links
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Profile link has been deleted' );
  
  header( 'Location: profilelinks.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM profile_links
  ORDER BY name DESC';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Profile Links</h2>

<table>
  <tr>
    <th></th>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="left">URL</th>
    <th></th> <!-- Link to photo (refer to php below) -->
    <th></th> <!-- Link to edit  (refer to php below) -->
    <th></th> <!-- Link to delete (refer to php below) -->
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td align="center">
        <img src="image.php?type=profile_links&id=<?php echo $record['id']; ?>&width=100&height=100&format=inside">
      </td>
      <td align="center"><?php echo $record['id']; ?></td>
      <td align="left">
        <?php echo htmlentities( $record['name'] ); ?>
      </td>
      <td align="center"><a href="<?php echo $record['url']; ?>"><?php echo $record['url']; ?></td>
      <td align="center"><a href="profilelinks_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
      <td align="center"><a href="profilelinks_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="profilelinks.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this profile link?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="profilelinks_add.php"><i class="fas fa-plus-square"></i> Add Profile Link</a></p>


<?php

include( 'includes/footer.php' );

?>