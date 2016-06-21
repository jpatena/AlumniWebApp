<?php
    // This views a single event

    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Retrieve the event name
    $statement = $dbhost->prepare("SELECT * FROM events WHERE id = :id");
    // Get name from the URL bar/allevents.php 
    $statement->bindParam(':id', $_GET['id']);
    $statement->execute() or exit("SELECT failed.");

    // If no matching entry, redirect to home page
    if($statement->rowCount()==0) {
        header('Location: ./');
        exit();
    }

    // Extract the event name from the table
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

<h2>View Event</h2>

<form action="allevents.php" method ="post">
    <input type="submit" value="Return" />
</form>

<table style="width:40%">
<tr><td><b>Event Name:</b></td><tr>
    <tr><td><?php print($eventname) ?></td><tr>
<tr><td><b>Date (YYYY-MM-DD):</b></td><tr>
    <tr><td><?php print($eventdate) ?></td><tr>
<tr><td><b>Time:</b></td><tr>
    <tr><td><?php print($eventtime) ?></td><tr>
<tr><td><b>Address:</b></td><tr>
    <tr><td><?php print($eventaddress) ?></td><tr>
<tr><td><b>Details:</b></td><tr>
    <tr><td><?php print($eventdetails) ?></td><tr>
<tr><td><b>Image URL:</b></td><tr>
    <tr><td><a href="<?php print($eventimage) ?>"><?php print($eventimage) ?></a></td><tr>
    <tr><td>
    <!-- Display image if present -->
    <?php
        if ($eventimage != "") {
            print('<img src="' . $eventimage . '"' . 'width="200px">');
        }
        else {
            print("No image");
        } 
    ?>
    </td><tr>
<tr><td><b>Event URL:</b></td><tr>
    <tr><td><a href="<?php print($eventregisterurl) ?>"><?php print($eventregisterurl) ?></a></td><tr>
</table>

<button onclick="window.location='deleteevent.php<?php echo '?id=' . $id  ?>'">Delete</button>
<button onclick="window.location='editevent.php<?php echo '?id=' . $id  ?>'">Edit</button>
