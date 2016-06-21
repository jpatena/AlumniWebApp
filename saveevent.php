<?php
    // This saves a new event

    session_start();

    // If the user is not logged in or
    // If submitted data is invalid, redirect to home page
    if (!isset($_SESSION['username']) or !isset($_POST['eventname'])) {
        header('Location: ./');
        exit();
    }

    // If user click cancel, redirect to events page
    if (isset($_POST['cancel'])) {
        header('Location: allevents.php');
        exit();
    }

    // Assume that the Save button was clicked
   
    // Extract the submitted form
    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventaddress = $_POST['eventaddress'];
    $eventdetails = $_POST['eventdetails'];
    $eventimage = $_POST['eventimage'];
    $eventregisterurl = $_POST['eventregisterurl'];
    
    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Insert to the table
    $statement = $dbhost->prepare("INSERT INTO events (eventname, eventdate, eventtime, eventaddress, eventdetails, eventimage, eventregisterurl) VALUES (:eventname, :eventdate, :eventtime, :eventaddress, :eventdetails, :eventimage, :eventregisterurl)");
    $statement->bindParam(':eventname', $eventname);
    $statement->bindParam(':eventdate', $eventdate);
    $statement->bindParam(':eventtime', $eventtime);
    $statement->bindParam(':eventaddress', $eventaddress);
    $statement->bindParam(':eventdetails', $eventdetails);
    $statement->bindParam(':eventimage', $eventimage);
    $statement->bindParam(':eventregisterurl', $eventregisterurl);
    $statement->execute() or exit("INSERT failed.");
    
    // Redirect to the view all events to confirm changes
    header('Location: allevents.php' );
?>