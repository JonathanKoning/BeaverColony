<?php
    //session
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: HomePage.php");
        exit;
    }

    //variables
    $onidLogin = "";
    $onidLogin_err = "";

    //connecting to DB
    require_once "connect.php";

    $onidLogin = $_POST["onid"];
    $sql = "SELECT ONID FROM Student WHERE ONID = '$onidLogin'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) == 1){
        $_SESSION["loggedin"] = true;
        $_SESSION["onid"] = $onidLogin;
        header("location: HomePage.php");
        exit;
    } else{
        // Display an error message if ONID is not valid
        $onidLogin_err = "Please enter a valid ONID.";
    }
    mysqli_stmt_close($result);
    mysqli_close($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css">
    </head>
    <body>
        <h1 id="webName">Beaver Colony</h1>
        <div id="bigContainer">
            <img src="campus_pic.jpg">
            <div class="formContainer">
                <h2 id="pageName">Login</h2>
                <form class="formInner" action="" method="post">
                    <label for="onid"><b>ONID</b></label>
                    <input type="text" placeholder="Enter ONID" name="onid" required>
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
