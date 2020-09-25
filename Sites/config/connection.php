<?php
  try {
    # import credentials
    require('data.php'); 
    # Create PDO instance (connection between PHP and DB server)
    $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
  } catch (Exception $e) {
    echo "Could not connect to database: $e";
  }
?>