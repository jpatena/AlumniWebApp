<?php
    // This page views all the benefits
    // If user is not logged in, then redirect to the login page
    session_start();
    if(!isset($_SESSION['username'])) {
        header('Location: ./');
    }
        
    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // Retrieve the benefits from the table
    $statement = $dbhost->prepare("SELECT id, benefitname, benefitimage FROM benefits ORDER BY id");
    $statement->execute() or exit("SELECT failed.");
?>

<h2>Benefits Page</h2>

<form action="logout.php" method ="post"><input type="submit" value="Logout" />
</form>
<table>
<form action="addbenefit.php" method ="post"><input type="submit" value="Add Benefit" />
</form><form action="allevents.php" method ="post"><input type="submit" value="View Events" />
</form><form action="getbenefits.php" method ="post"><input type="submit" value="JSON format" />
</form>
</table>
</br>

<?php
    // If there are no entries
    if($statement->rowCount()==0) {
        echo 'No benefits';
    }

    // Display all benefits
    foreach($statement as $row) {
        $ben = $row['benefitname'];
        $benimg = $row['benefitimage'];
        $id = $row['id'];
        
        // Display event title/date and image (if not empty)
        print('<li>');
        if ($benimg != "") { print('<img src="' . $benimg . '"' . 'width="50px">'); }        
        print('<a href="viewbenefit.php?id=' . $id . '">' . ' ' . $ben . '</a></li>');
    }
?>
</script>
