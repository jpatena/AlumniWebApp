<?php
    // This page adds a new event
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
?>
<h2>Add Event</h2>

<p><a href="./">Home</a></p>
<form action="saveevent.php" method="post">
    <b>Event name:</b></br>
    <textarea name="eventname" rows="2" cols="60" style="font-size: 11pt">CSUSB Event</textarea></br>
    <b>Date (YYYY-MM-DD):</b></br>
    <textarea name="eventdate" rows="1" cols="60" style="font-size: 11pt">2016-01-01</textarea></br>
    <b>Time:</b></br>
    <textarea name="eventtime" rows="1" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Address:</b></br>
    <textarea name="eventaddress" rows="3" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Details:</b></br>
    <textarea name="eventdetails" rows="12" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Image URL:</b></br>
    <textarea name="eventimage" rows="3" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Event URL:</b></br>
    <textarea name="eventregisterurl" rows="3" cols="60" style="font-size: 11pt"></textarea></br>
    <input type="submit" name="cancel" value="Cancel" size"24" />
    <input type="submit"               value="Save" size"24" />
</form>