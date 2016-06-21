<?php
    // This saves the edited benefit

    session_start();

    // If the user is not logged in or
    // If submitted data is invalid, redirect to home page
    if (!isset($_SESSION['username']) or !isset($_POST['newbenefitname'])) {
        header('Location: ./');
        exit();
    }

    // If user click cancel, redirect to events page
    if (isset($_POST['cancel'])) {
        header('Location: viewbenefit.php?id=' . $_GET['id']);
        exit();
    }

    // Assume that the Save button was clicked

    // Extract the submitted form
    $newbenefitname = $_POST['newbenefitname'];
    $benefitdetails = $_POST['benefitdetails'];
    $benefitnumber = $_POST['benefitnumber'];
    $benefiturl = $_POST['benefiturl'];
    $benefitimage = $_POST['benefitimage'];

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php'; 

    // Update the table
    $statement = $dbhost->prepare("UPDATE benefits SET
    benefitname = :newbenefitname,
    benefitdetails = :benefitdetails,
    benefitnumber = :benefitnumber,
    benefiturl = :benefiturl,
    benefitimage = :benefitimage
    WHERE id= :id");
    
    $statement->bindParam(':id', $_GET['id']);
    $statement->bindParam(':newbenefitname', $newbenefitname);
    $statement->bindParam(':benefitdetails', $benefitdetails);
    $statement->bindParam(':benefitnumber', $benefitnumber);
    $statement->bindParam(':benefiturl', $benefiturl);
    $statement->bindParam(':benefitimage', $benefitimage);
    $statement->execute() or exit("UPDATE failed.");

    // Redirect to the benefit that was edited to confirm changes
    header('Location: viewbenefit.php?id=' . $_GET['id']);
?>