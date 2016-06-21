<?php
    // This page edits an event
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';  
    
    // Retrieve the event from the table
    $statement = $dbhost->prepare("SELECT * FROM events WHERE id = :id");
    
    // Get name from the URL bar/viewevent.php 
    $statement->bindParam(':id', $_GET['id']);
    $statement->execute() or exit("SELECT failed.");

    // If empty, redirect to home page
    if($statement->rowCount()==0) {
        header('Location: ./');
        exit();
    }

    // Extract the event from the table
    $row = $statement->fetch() or exit("FETCH failed.");
    $eventname = $row["eventname"];
    $eventdate = $row["eventdate"];
    $eventtime = $row["eventtime"];
    $eventaddress = $row["eventaddress"];
    $eventdetails = $row["eventdetails"];
    $eventimage = $row["eventimage"];
    $eventregisterurl = $row["eventregisterurl"];
    $id = $_GET['id'];
?>
<h2>Edit Event</h2>


</br>
<form action="saveeditevent.php<?php echo '?id=' . $id  ?>" method="post" >
    <b>Event name:</b></br>
    <textarea name="neweventname" rows="2" cols="60" style="font-size: 11pt"><?php print($eventname) ?></textarea></br>
    <b>Date (YYYY-MM-DD):</b></br>
    <textarea name="eventdate" rows="1" cols="60" style="font-size: 11pt"><?php print($eventdate) ?></textarea></br>
    <b>Time:</b></br>
    <textarea name="eventtime" rows="1" cols="60" style="font-size: 11pt"><?php print($eventtime) ?></textarea></br>
    <b>Address:</b></br>
    <textarea name="eventaddress" rows="3" cols="60" style="font-size: 11pt"><?php print($eventaddress) ?></textarea></br>
    <b>Details:</b></br>
    <textarea name="eventdetails" rows="12" cols="60" style="font-size: 11pt"><?php print($eventdetails) ?></textarea></br>
    <b>Image URL:</b></br>
    <textarea name="eventimage" rows="3" cols="60" style="font-size: 11pt"><?php print($eventimage) ?></textarea></br>
    <b>Event URL:</b></br>
    <textarea name="eventregisterurl" rows="3" cols="60"  style="font-size: 11pt"><?php print($eventregisterurl) ?></textarea></br>
    
    <input type="submit" name="cancel" value="Cancel" size"24" />
    <input type="submit"               value="Save" size"24" />
</form>

