<?php
    session_start();
    require_once "connect.php";    
?>
<!DOCTYPE html>

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
                
                $name=$_SESSION['onid'];
                $query = "SELECT * FROM has where ONID='$name'";
                $Class = mysqli_query($con, $query);
                $query = "SELECT GroupID FROM participates_in were ONID='$name'";
                $isin = mysqli_query($con, $query);
                //$query = "SELECT * FROM Group where (GroupID!=$isin[])";

                $query = "SELECT * FROM `Group` WHERE (`ID` NOT IN (SELECT `GroupID` FROM `participates_in` WHERE ONID='$name') AND `Subject` IN (SELECT `Subject` FROM `has` WHERE ONID='$name') AND `SECTION` IN (SELECT `Section` FROM `has` WHERE ONID='$name') AND `Number` IN (SELECT `Number` FROM `has` WHERE ONID='$name'))";
                
                if(mysqli_query($con, $query))
                {
                    echo"<br>";
                }
                else
                {
                    echo "<br>";
                }
               
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    //echo "<p>". $row['ID']."<p>";
                    $group = $row['ID'];
                    $subj = $row['Subject'];
                    $class = $row['Number'];
                    echo "<form method='get' action='#'>";
                    echo "<input type='hidden' name='join' value='$group'>". $group. " ". $subj, $class ."</input>";
                    echo "<button id='joinButton' value='$group' type='submit'> Join</button>";
                    echo "</form>";
                }
                //Get new group ID
                $val = $_GET['join'];
                $query = "INSERT INTO `participates_in` (`ONID`, `GroupID`) VALUES ('$name', '$val')";
                $result = mysqli_query($con,$query);
                
                //Get number of students from joined group
                $query = "SELECT `NumStudents` FROM `Group` WHERE ID=$val";
                $res = mysqli_query($con, $query);
                $row = mysqli_fetch_array($res);
                $num = $row['NumStudents'];
                
                //Update number of students in group
                $newnum = (int)$num + 1;
                $query = "UPDATE `Group` SET NumStudents='$newnum' WHERE ID='$val'";
                if(mysqli_query($con, $query)){
                    echo "<br>";
                } else{
                    echo "<br>";
                }

            ?>
        </div>
   </div>
  </body>
</html>
