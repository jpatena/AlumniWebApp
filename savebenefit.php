<?php
    // This saves a new benefit

    session_start();

    // If the user is not logged in or
    // If submitted data is invalid, redirect to home page
    if (!isset($_SESSION['username']) or !isset($_POST['benefitname'])) {
        header('Location: ./');
        exit();
    }

    // If user click cancel, redirect to events page
    if (isset($_POST['cancel'])) {
        header('Location: allbenefits.php');
        exit();
    }

    // Assume that the Save button was clicked
   
    // Extract the submitted form
    $benefitname = $_POST['benefitname'];
    $benefitdetails = $_POST['benefitdetails'];
    $benefitnumber = $_POST['benefitnumber'];
    $benefiturl = $_POST['benefiturl'];
    $benefitimage = $_POST['benefitimage'];

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php'; 

    $statement = $dbhost->prepare("INSERT INTO benefits
    (benefitname, benefitdetails, benefitnumber, benefiturl, benefitimage)
    VALUES (:benefitname, :benefitdetails, :benefitnumber, :benefiturl, :benefitimage)");
    
    $statement->bindParam(':benefitname', $benefitname);
    $statement->bindParam(':benefitdetails', $benefitdetails);
    $statement->bindParam(':benefitnumber', $benefitnumber);
    $statement->bindParam(':benefiturl', $benefiturl);
    $statement->bindParam(':benefitimage', $benefitimage);
    $statement->execute() or exit("INSERT failed.");
    
    // Redirect to the view all benefits to confirm changes
    header('Location: allbenefits.php' );
?>