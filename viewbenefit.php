<?php
    // This views a single benefit

    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }
        
    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Retrieve the benefit name
    $statement = $dbhost->prepare("SELECT * FROM benefits WHERE id = :id");
    // Get name from the URL bar/allevents.php 
    $statement->bindParam(':id', $_GET['id']);
    $statement->execute() or exit("SELECT failed.");

    // If no matching entry, redirect to home page
    if($statement->rowCount()==0) {
        header('Location: ./');
        exit();
    }

    // Extract the benefit name from the table
    $row = $statement->fetch() or exit("FETCH failed.");
    $benefitname = $row['benefitname'];
    $benefitdetails = $row['benefitdetails'];
    $benefitnumber = $row['benefitnumber'];
    $benefiturl = $row['benefiturl'];
    $benefitimage = $row['benefitimage'];
    $id = $_GET['id'];
?>

<h2>View Benefit</h2>

<form action="allbenefits.php" method ="post">
    <input type="submit" value="Return" />
</form>

<table style="width:40%">
<tr><td><b>Benefit Name:</b></td><tr>
    <tr><td><?php print($benefitname) ?></td><tr>
<tr><td><b>Details:</b></td><tr>
    <tr><td><?php print($benefitdetails) ?></td><tr>
<tr><td><b>Contact:</b></td><tr>
    <tr><td><?php print($benefitnumber) ?></td><tr>
<tr><td><b>Image URL:</b></td><tr>
    <tr><td><a href="<?php print($benefitimage) ?>"><?php print($benefitimage) ?></a></td><tr>
    <tr><td>
    <!-- Display image if present -->
    <?php
        if ($benefitimage != "") {
            print('<img src="' . $benefitimage . '"' . 'width="100px">');
        }
        else {
            print("No image");
        } 
    ?>
    </td><tr>
<tr><td><b>Benefit URL:</b></td><tr>
    <tr><td><a href="<?php print($benefiturl) ?>"><?php print($benefiturl) ?></a></td><tr>
</table>

<button onclick="window.location='deletebenefit.php<?php echo '?id=' . $id  ?>'">Delete</button>
<button onclick="window.location='editbenefit.php<?php echo '?id=' . $id  ?>'">Edit</button>
