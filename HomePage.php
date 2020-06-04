<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="HomePageStyle.css">
    </head>
    <body>
        <h1>Beaver Colony</h1>
        <h2>Home</h2>
        <div id="BeaverDescription">
            <h3>A resource to collaborate, help, and connect with others to further the success of your academic carreer</h3>
        </div>
        
        <div class="GroupDiv">
            <h4>Your Groups</h4>
            <?php
                require_once "connect.php";
                if($_SESSION['onid']){
                    $name=$_SESSION['onid'];
                }
                $query = "SELECT * FROM participates_in where ONID='$name'";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    echo"<div class='box'>";
                    echo"<p>". $row['GroupID']."<p>";
                    echo"<form method='get' action='#'>";
                    echo"<button title='Remove group' id='removeBtn' type='submit'>-</button>";
                    echo"</form>";
                    echo"</div>";
                }
                mysqli_close($con);
            ?>
        </div>
        <div id="outerBtnDiv">
            <div id="innerBtnDiv">
                <button id="ListBtn" type="submit" onclick="window.location.href='GroupListing.php'">Search Groups</button>
                <button id="CreateBtn" type="submit" onclick="window.location.href='CreateGroup.php'">Create Group</button>
            </div>
        </div>
    </body>
</html>

