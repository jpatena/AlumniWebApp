<?php
    // This retrieve information from the db and encodes rows to JSON
    // and prints it in JSON

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php'; 
    
    // fetch the events
    // and convert date YYYY-MM-DD to formatted date MMM DD, YYYY
    $statement = $dbhost->prepare("SELECT *, DATE_FORMAT(eventdate,'%b %d, %Y') AS formatteddate FROM events ORDER BY eventdate;");
    $statement->execute() or exit("SELECT failed.");
    $results = array();
    
    // add them onto array
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $results[] = array(
            'name' => $row['eventname'],
            'date' => $row['formatteddate'],
            'time' => $row['eventtime'],
            'address' => $row['eventaddress'],
            'details' => $row['eventdetails'],
            'thumbnail' => $row['eventimage'],
            'registerurl' => $row['eventregisterurl']
        );
    }
    
    // convert strings to UTF-8
    // otherwise the $json would return empty
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    } 

    // array to JSON
    $json = json_encode(utf8ize($results));
    echo '{' . '"alumnievents":'  . $json  . '}' ;
?>