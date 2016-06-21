<?php
    // This saves the edited event

    session_start();

    // If the user is not logged in or
    // If submitted data is invalid, redirect to home page
    if (!isset($_SESSION['username']) or !isset($_POST['neweventname'])) {
        header('Location: ./');
        exit();
    }

    // If user click cancel, redirect to events page
    if (isset($_POST['cancel'])) {
        header('Location: viewevent.php?id=' . $_GET['id']);
        exit();
    }

    // Assume that the Save button was clicked

    // Extract the submitted form
    $neweventname = $_POST['neweventname'];
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventaddress = $_POST['eventaddress'];
    $eventdetails = $_POST['eventdetails'];
    $eventimage = $_POST['eventimage'];
    $eventregisterurl = $_POST['eventregisterurl'];

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';   

    // Update the table
    $statement = $dbhost->prepare("UPDATE events SET
    eventname= :neweventname,
    eventdate= :eventdate,
    eventtime= :eventtime,
    eventaddress= :eventaddress,
    eventdetails= :eventdetails,
    eventimage= :eventimage,
    eventregisterurl= :eventregisterurl
    WHERE id= :id");
    
    $statement->bindParam(':id', $_GET['id']);
    $statement->bindParam(':neweventname', $neweventname);
    $statement->bindParam(':eventdate', $eventdate);
    $statement->bindParam(':eventtime', $eventtime);
    $statement->bindParam(':eventaddress', $eventaddress);
    $statement->bindParam(':eventdetails', $eventdetails);
    $statement->bindParam(':eventimage', $eventimage);
    $statement->bindParam(':eventregisterurl', $eventregisterurl);
    $statement->execute() or exit("UPDATE failed.");

    // Redirect to the event that was just added to confirm changes
    header('Location: viewevent.php?id=' . $_GET['id']);
?>