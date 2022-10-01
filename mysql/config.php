<?php 

  // Connection configuration
  define( 'HOST', 'localhost' );
  define( 'USER', 'root' );
  define( 'PASSWORD', '' );
  define( 'DATABASE', 'mydb' );
  define( '__TABLE__', 'users' );

  // Create connection
  $connection = mysqli_connect( HOST, USER, PASSWORD, DATABASE );

  // Check connection
  if ( ! $connection ) { ?>
   <h1 style="color:red"><?php die( "Connection failed: " . mysqli_connect_error() ); ?></h1> 
  <?php }

  function db_connect() {
    echo "Database connected";
  }

?>