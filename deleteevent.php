<?php
    // This page deletes an event
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';

    // Delete from table
    $statement = $dbhost->prepare("DELETE FROM events WHERE id= :id");
    $statement->bindParam(':id', $_GET['id']);
    $statement->execute() or exit("DELETE failed.");

        // Redirect to the view all events page
    header('Location: allevents.php');
?>