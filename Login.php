<?php
    //session
    //session_start();
    //$_SESSION["onid"] = $_GET['onid'];
    /*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: HomePage.php");
        exit;*/
    //variables
    /*$onidLogin = "";
    $onidLogin_err = "";
    
    //connecting to DB
    require_once "connect.php";
    
    $onidLogin = $_GET['onid'];
    $sql = "SELECT ONID FROM Student WHERE ONID='$onidLogin'";
    if(mysqli_stmt_num_rows($stmt) == 1){
        //$_SESSION["loggedin"] = true;
        $_SESSION['onid'] = $onidLogin;
        header("location: HomePage.php");
    } else{
        // Display an error message if ONID is not valid
        $onidLogin_err = "Please enter a valid ONID.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    */
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css">
    </head>
    <body>
        <h1 id="webName">Beaver Colony</h1>
        <?php
            //echo "<h1>" . $_SESSION["onid"] . "</h1>"
        //session_start();
        //$name = $_GET['onid'];
        //$_SESSION["onid"] = $name;
        echo "<div id='bigContainer'>";
            echo "<img src='campus_pic.jpg'>";
            echo "<div class='formContainer'>";
                echo "<h2 id='pageName'>Login</h2>";
                echo "<form class='formInner' action='HomePage.php' method='get'>";
                    echo "<label for='onid'><b>ONID</b></label>";
                    echo "<input type='text' placeholder='Enter ONID' name='onid' required>";
                    echo "<button type='submit' class='btn'>Login</button>";
                echo "</form>";
            echo "</div>";
        echo "</div>";
        ?>
    </body>
</html>
