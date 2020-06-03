<?php
    define('DB_SERVER', 'classmysql.engr.oregonstate.edu');
    define('DB_USERNAME', 'cs340_koningj');
    define('DB_PASSWORD', 'BibbphpMyAdmin0916');
    define('DB_NAME', 'cs340_koningj');
    
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
    if($con === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
