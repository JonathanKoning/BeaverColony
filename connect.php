<?php
    define('DB_SERVER', 'classmysql.engr.oregonstate.edu');
    define('DB_USERNAME', 'cs340_vellanka');
    define('DB_PASSWORD', 'Database123!');
    define('DB_NAME', 'cs340_vellanka');
    
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
    if($con === false){
            die("ERROR: Could not connect. " . mysqli_connect_error($con));
}
?>
