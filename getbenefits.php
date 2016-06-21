<?php
    // This retrieve information from the db and encodes rows to JSON
    // and prints it in JSON

    // Connect to the database
    include './inc/config.php';
    include './inc/opendb.php';
    
    // fetch the events
    $statement = $dbhost->prepare("SELECT * FROM benefits ORDER BY id");
    $statement->execute() or exit("SELECT failed.");
    $results = array();
    
    // add them onto array
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $results[] = array(
            /*
            'name' => $row['eventname'],
            'date' => $row['eventdate'],
            'time' => $row['eventtime'],
            'address' => $row['eventaddress'],
            'details' => $row['eventdetails'],
            'thumbnail' => $row['eventimage'],
            'registerurl' => $row['eventregisterurl']
            */
            
            'name' => $row['benefitname'],
            'details' => $row['benefitdetails'],
            'contact' => $row['benefitnumber'],
            'link' => $row['benefiturl'],
            'thumbnail' => $row['benefitimage']
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
    echo '{' . '"alumnibenefits":'  . $json  . '}' ;
?>