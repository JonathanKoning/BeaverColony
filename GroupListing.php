<!DOCTYPE html>
<?php
    session_start();
    require_once "connect.php";
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="listingStyle.css">
  </head>

  <h1><a href="HomePage.php">Beaver Colony</h1>
  <h3>Course Name</h3> 
  <div class="createDiv">
      <button id="CreateGroupbtn" type="submit" action="CreateGroup.php">Create a Group</a>
  </div>

  <body>
    <div id="listingBox">
        <div class="listing">
            <?php
                print_r($_SESSION);
                $name=$_SESSION['onid'];
                $query = "SELECT * FROM has where ONID='$name'";
                $Class = mysqli_query($con, $query);
                $query = "SELECT GroupID FROM participates_in were ONID='$name'";
                $isin = mysqli_query($con, $query);
                //$query = "SELECT * FROM Group where (GroupID!=$isin[])";

                $query = "SELECT * FROM Group where ID NOT IN(SELECT GroupID FROM participates_in where ONID = $name) AND Subject IN(SELECT Subject FROM has WHERE ONID=$name) AND SECTION IN(SELECT Section FROM has WHERE ONID=$name) AND Number IN(SELECT Number FROM has WHERE ONID=$name)";
                $result = mysqli_query($con, $query);
                print_r($result);
                while($row = mysqli_fetch_array($result)){
                    echo"<div class='box'>";
                    echo"<p>". $row['ID']."<p>";
                    echo"<form method='get' action='#'>";
                    echo"<button title='Remove group' id='removeBtn' type='submit'>-</button>";
                    echo"</form>";
                    echo"</div>";
                }

            ?>
            <form method="get" action="HomePage.php">
              <button id="joinButton" type="submit"> Join</button>
            </form>
        </div>
   </div>
  </body>
</html>
