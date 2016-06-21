<?php
    // This page views all the events
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }
    
    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Retrieve the events
    $statement = $dbhost->prepare("SELECT id, eventname, eventdate, eventimage FROM events ORDER BY eventdate");
    $statement->execute() or exit("SELECT failed.");
?>

<h2> Events Page</h2>

<form action="logout.php" method ="post"><input type="submit" value="Logout" />
</form>
<table>
<form action="addevent.php" method ="post"><input type="submit" value="Add Event" />
</form><form action="allbenefits.php" method ="post"><input type="submit" value="Benefits page" />
</form><form action="getevents.php" method ="post"><input type="submit" value="JSON format" />
</table>
</br>

<?php
    // If there are no entries
    if($statement->rowCount()==0) {
        echo 'No events';
    }

    // Display all events
    foreach($statement as $row) {
        $ev = $row['eventname'];
        $evd = $row['eventdate'];
        $evimg = $row['eventimage'];
        $id = $row['id'];
        
        // Display event title/date and image (if not empty)
        print('<li><a href="viewevent.php?id=' . $id . '">' . $ev . ' - ' . $evd . '</a></br>');
        if ($evimg != "") { print('<img src="' . $evimg . '"' . 'width="200px">'); }
        print('</li>');
    }
?>
</script>
