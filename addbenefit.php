<?php
    // This page adds a new benefit
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
?>
<h2>Add Benefit</h2>

<p><a href="./">Home</a></p>
<form action="savebenefit.php" method="post">
    <b>Benefit Name:</b></br>
    <textarea name="benefitname" rows="2" cols="60" style="font-size: 11pt">CSUSB Benefit</textarea></br>
    <b>Details:</b></br>
    <textarea name="benefitdetails" rows="12" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Contact:</b></br>
    <textarea name="benefitnumber" rows="1" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Image URL:</b></br>
    <textarea name="benefitimage" rows="3" cols="60" style="font-size: 11pt"></textarea></br>
    <b>Benefit URL:</b></br>
    <textarea name="benefiturl" rows="3" cols="60" style="font-size: 11pt"></textarea></br>
    
    <input type="submit" name="cancel" value="Cancel" size"24" />
    <input type="submit"               value="Save" size"24" />
</form>