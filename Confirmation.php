<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="confirmation.css">
        <title>Beaver Colony - Create a Group Page</title>
    </head>

    <div id="header">
        <h1><a href="HomePage.html">Beaver Colony</a></h1>
        <h2>Create a Group</h2>
    </div>
    <div id="formDiv">
        <form>
          
    <body>
        <?php
            $counter=0;
            $number = $_GET['Class'];
           
            $onid=$_SESSION['onid'];
            require_once "connect.php";
            $query = "SELECT Subject, Number, Section FROM has where ONID='$onid'";
            $result = mysqli_query($con, $query);               
            

            while($row = mysqli_fetch_array($result)){
                if($counter == (int)$number){
                    $subj=$row['Subject'];
                    $class=$row['Number'];
                    $section=$row['Section'];
                }
                $counter++;
            }
            echo"<div class='box'>";
            echo "<h3>" . "$class" . "</h3>";

            $Day=$_GET['Day'];
            echo "<h3>" . $_GET['Day'] . "</h3>";
            //$Day=$_GET['Day'];

            $number=$_GET['bname'];
            $query = "SELECT Name FROM Building";
            $result = mysqli_query($con, $query);
            $counter=0;
            while($row = mysqli_fetch_array($result)){
                if($counter == (int)$number){
                    $Building=$row['Name'];
                }
                $counter++;
            }
            echo "<h1>" . $Building . "</h1>"; 
            
            $Time=$_GET['Time'];
            echo "<h1>" . $_GET['Time'] . "</h1>";

            //Create new group
            $query= "INSERT INTO `Group` (`ID`, `NumStudents`, `ModeratorONID`,`Subject`, `Number`, `Section`) 
            VALUES (NULL,0,'$onid','$subj','$class', '$section')";
            if(mysqli_query($con, $query)){
                echo "<br> Succes inserting group";
            } else{
                echo "<br> Problem inserting" . mysqli_error($con);
            }
    
            //Get group ID of new group
            $query = "SELECT ID FROM `Group` WHERE NumStudents = 0";
            $GID = mysqli_query($con, $query);
            $row = mysqli_fetch_array($GID);
            $group = $row['ID'];
            echo "<h1>" .$group . "</h1>";
            $query = "INSERT INTO `Meeting` (`MeetingID`, `Day`, `Time`, `BuildingName`, `GroupID`)
            VALUES (NULL, '$Day', '$Time', '$Building', '$group')";
            if(mysqli_query($con, $query)){
                echo "<br> Succes inserting group";
            } else{
                echo "<br> Problem inserting into Meeting" . mysqli_error($con);
            }

            //Update number of students in Group
            $query = "UPDATE `Group` SET NumStudents=1 WHERE NumStudents=0";
            //$query = mysqli_query($con, $query);
            if(mysqli_query($con, $query)){
                echo "<br> Succes inserting group";
            } else{
                echo "<br> Problem updating numstudents" . mysqli_error($con);
            }

            //Put user into participates in
            $query = "INSERT INTO `participates_in` (`ONID`, `GroupID`) VALUES ('$onid', '$group')";
            if(mysqli_query($con, $query)){
                echo "<br> Succes inserting into participates";
            } else{
                echo "<br> Problem inserting into participates in" . mysqli_error();
            }

            //$query = "SELECT `ID` FROM `Group` INNER JOIN `MEETING` WHERE `Group`.`ID` = `MEETING`.`GroupID`";

            //$groupID = mysqli_query($con, $query);

            //while($row = mysqli_fetch_array($groupID))
            //{
              //  echo"<h1>". $row['ID'] ."</h1>";
            //}
            

        ?>

                <?php
                    /*session_start();
                    $onid=$_SESSION['onid'];
                    require_once "connect.php";
                    $query = "SELECT Subject, Number FROM has where ONID='$onid'";
                    $result = mysqli_query($con, $query);
                    echo "<label for='classes'>Class</label><br>";
                    echo "<select id='classes' classes='Class'>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<option value = 'Class'>" .$row['Subject'], $row['Number']. "</option>";
                    }
                    echo "</select><br>";*/
                ?>
                <!--<label for="Day">Day</label><br>
                <select id="Day" Day="Day">
                    <option value = "Monday">Monday</option>
                    <option value = "Tuesday">Tuesday</option>
                    <option value = "Wednesday">Wednesday</option>
                    <option value = "Thursday">Thursday</option>
                    <option value = "Friday">Friday</option>
                    <option value = "Saturday">Saturday</option>
                    <option value = "Sunday">Sunday</option>
                </select><br>
                <label for="Time">Time</label><br>
                <input type="text" id="Time" Time="Time"><br> -->
                <?php
                   /* $query = "SELECT Name FROM Building";
                    $result = mysqli_query($con, $query);
                    echo "<label for='Bname'>Building</label><br>";
                    echo "<select id='Bname' Bname='bname'>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<option value='bname'>" . $row['Name'] . "</option>";
                    }
                    echo "</select><br>";
                    */
                ?>
                <!--<label for="BuildingName">Building Name</label><br>
                <input type="text" id="BuildingName" BuildingName="BuildingName"><br> -->
            </form>
        </div>

        <form method="get" action="HomePage.php">
        <button type="submit" id="submitButton">Back to Home</button>
        </form>
    </body>
</html>
