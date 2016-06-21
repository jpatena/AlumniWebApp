<?php
    // This page edits a benefit
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }
    
    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Retrieve the benefit from table
    $statement = $dbhost->prepare("SELECT * FROM benefits WHERE id = :id");

    // Get name from the URL bar/viewevent.php 
    $statement->bindParam(':id', $_GET['id']);
    $statement->execute() or exit("SELECT failed.");

    // If empty redirect to home page
    if($statement->rowCount()==0) {
        header('Location: ./');
        exit();
    }

    // Extract the event from the table
    $row = $statement->fetch() or exit("FETCH failed.");
    $benefitname = $row['benefitname'];
    $benefitdetails = $row['benefitdetails'];
    $benefitnumber = $row['benefitnumber'];
    $benefiturl = $row['benefiturl'];
    $benefitimage = $row['benefitimage'];
    $id = $_GET['id'];
?>

<h2>Edit Benefit</h2>

</br>
<form action="saveeditbenefit.php<?php echo '?id=' . $id  ?>" method="post">
    <b>Benefit name:</b></br>
    <textarea name="newbenefitname" rows="2" cols="60" style="font-size: 11pt"><?php print($benefitname) ?></textarea></br>
    <b>Details:</b></br>
    <textarea name="benefitdetails" rows="12" cols="60" style="font-size: 11pt"><?php print($benefitdetails) ?></textarea></br>
    <b>Contact:</b></br>
    <textarea name="benefitnumber" rows="1" cols="60" style="font-size: 11pt"><?php print($benefitnumber) ?></textarea></br>
    <b>Image URL:</b></br>
    <textarea name="benefitimage" rows="3" cols="60" style="font-size: 11pt"><?php print($benefitimage) ?></textarea></br>
    <b>Benefit URL:</b></br>
    <textarea name="benefiturl" rows="3" cols="60" style="font-size: 11pt"><?php print($benefiturl) ?></textarea></br>

    <input type="submit" name="cancel" value="Cancel" size"24" />
    <input type="submit"               value="Save" size"24" />
</form>

