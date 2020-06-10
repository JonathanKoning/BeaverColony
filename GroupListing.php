<?php
    session_start();
    //require_once "connect.php";    
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="listingStyle.css">
  </head>

  <h1><a href="HomePage.php">Beaver Colony</h1>
  <button id="logoutBtn" onclick="window.location.href='Logout.php'">Logout</button>
  <h3>Course Name</h3>
  <div class="createDiv">
      <button id="CreateGroupbtn" type="submit" onclick="window.location.href='CreateGroup.php'">Create a Group</a>
  </div>
  <div id="filterDiv">
    <?php
        require_once "connect.php";
        $onid=$_SESSION['onid'];
        $query = "SELECT Subject, Number FROM has where ONID='$onid'";
        $result = mysqli_query($con, $query);
        /*if(mysqli_query($con, $query)){
            echo"<br> success";
        }
        else{
            echo"<br> doesnt work" . mysqli_error($con);
        }*/
        echo "<form method = 'post' action=''>"; 
            echo "<label for='classes'>Filter by Class</label><br>";
            echo "<select name='Class'>";
            $number = 0;
            echo "<option value='$number'>See All</option>";
            $number = 1;
            while($row = mysqli_fetch_array($result)){
                $classAbr = $row['Subject'];
                $classNum = $row['Number'];
                echo "<option value = '$number|$classAbr|$classNum'>" .$row['Subject'], $row['Number']. "</option>";
                $number++;
            }
            echo "</select><br>";
            echo "<input type='submit' name='classChoice' id='submitBtn'/>";
        echo "</form>";
    ?>
  </div>

  <body>
    <div id="listingBox">
        <div class="listing">
            <?php
                //require_once "connect.php";
                function Display($con){
                    $name=$_SESSION['onid'];
                    $option = explode('|', $_POST['Class']);
                    /*echo"<br> '$option[0]'";
                    echo"<br> '$option[1]'";
                    echo"<br> '$option[2]'";*/
                    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['classChoice']))
                    {
                        $_POST = array();
                    }
                    if((int)$option[0] == 0){
                        $query = "SELECT * FROM `Group` WHERE (`ID` NOT IN (SELECT `GroupID` FROM `participates_in` WHERE ONID='$name') 
                        AND `Subject` IN (SELECT `Subject` FROM `has` WHERE ONID='$name') 
                        AND `SECTION` IN (SELECT `Section` FROM `has` WHERE ONID='$name') 
                        AND `Number` IN (SELECT `Number` FROM `has` WHERE ONID='$name'))";
                    }
                    else{
                        $query = "SELECT * FROM `Group` WHERE (`ID` NOT IN (SELECT `GroupID` FROM `participates_in` WHERE ONID='$name') 
                        AND `Subject` IN (SELECT `Subject` FROM `has` WHERE `Subject`='$option[1]') 
                        AND `SECTION` IN (SELECT `Section` FROM `has` WHERE ONID='$name') 
                        AND `Number` IN (SELECT `Number` FROM `has` WHERE `Number`='$option[2]'))";
                    }
                    $result = mysqli_query($con, $query);
                    
                    while($row = mysqli_fetch_array($result)){
                        $groupID = $row['ID'];
                        $subject = $row['Subject'];
                        $number = $row['Number'];
                        $query = "SELECT `Day`, `Time`, `BuildingName` FROM `Meeting` WHERE `GroupID`='$groupID'";
                        $result2 = mysqli_query($con, $query);
                        $row2 = mysqli_fetch_array($result2);
                        $day = $row2['Day'];
                        $time = $row2['Time'];
                        $bName = $row2['BuildingName'];
                        $query = "SELECT `NumStudents` FROM `Group` WHERE `ID`='$groupID'";
                        /*if(mysqli_query($con, $query)){
                        echo"<br> success";
                        }
                            else{
                            echo"<br> doesnt work" . mysqli_error($con);
                        }*/
                        $result3 = mysqli_query($con, $query);
                        $row3 = mysqli_fetch_array($result3);
                        $size = $row3['NumStudents'];
                        //echo "<br> size: $size";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='join' value='$groupID'> Group ID:" .$groupID. " ". $subject, $number . " ".
                        $bName." ".$day. " ". $time."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $size."</input>";
                        echo "<button id='joinButton' value='$group' type='submit'>Join</button>";
                        echo "</form>";
                    }
                }

                function joinGroup($con){
                    $name=$_SESSION['onid'];
                    /*echo"<br> '$name'";
                    print_r('$_POST');*/
                    $val = $_POST['join'];
                    //echo"<br> '$val'";
                    $query = "INSERT INTO `participates_in` (`ONID`, `GroupID`) VALUES ('$name', '$val')";
                    /*if(mysqli_query($con, $query)){
                        echo"<br> success";
                    }
                    else{
                        echo"<br> doesnt work" . mysqli_error($con);
                    }*/
                    $result = mysqli_query($con,$query);
                    
                    //Get number of students from joined group
                    $query = "SELECT `NumStudents` FROM `Group` WHERE ID=$val";
                    $res = mysqli_query($con, $query);
                    $row = mysqli_fetch_array($res);
                    $num = $row['NumStudents'];
                    
                    //Update number of students in group
                    $newnum = (int)$num + 1;
                    //echo"<br> newnum: '$newnum'";
                    $query = "UPDATE `Group` SET `NumStudents`='$newnum' WHERE `ID`='$val'";
                    /*if(mysqli_query($con, $query)){
                        echo"<br> success";
                    }
                    else{
                        echo"<br> doesnt work" . mysqli_error($con);
                    }*/
                }
                
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['classChoice']))
                {
                    Display($con);
                }
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['join']))
                {
                    joinGroup($con);
                    Display($con);
                    $_POST = array();
                }
            ?>
            </div>
        </div>
    </body>
</html>

