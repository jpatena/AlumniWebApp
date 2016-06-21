<?php
    // This is an example opendb.php
    
    /*
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    mysql_select_db($dbname);
    */
    
     // Connect to the database
    try {
        $dbhost = new PDO("mysql:host=$dbhosturl;dbname=$dbname", $dbuser, $dbpass);
    } catch (PDOException $e) {
        exit('Database connection failed: ' . $e->getMessage());
    }   
?>