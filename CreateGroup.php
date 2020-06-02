<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CreateGroupStyle.css">
        <title>Beaver Colony - Create a Group Page</title>
    </head>
    <body>
        <div id="header">
            <h1><a href="HomePage.html">Beaver Colony</a></h1>
            <h2>Create a Group</h2>
        </div>
        <div id="formDiv">
            <form method="get" action="Confirmation.php">
                <?php
                    session_start();
                    $onid=$_SESSION['onid'];
                    require_once "connect.php";
                    $query = "SELECT Subject, Number FROM has where ONID='$onid'";
                    $result = mysqli_query($con, $query);
                    echo "<label for='classes'>Class</label><br>";
                    
                    echo "<select id='classes' name=Class>";
                    $number = 0;
                    while($row = mysqli_fetch_array($result)){
                        //$class=$row['Subject']; 
                        //$subj = $row['Number'];

                        echo "<option value = '$number'>" .$row['Subject'], $row['Number']. "</option>";
                        $number++; 
                    }
                    echo "</select><br>";
                ?>
                <label for="Day">Day</label><br>
                <select id="Day" name="Day">
                    <option value = "Monday">Monday</option>
                    <option value = "Tuesday">Tuesday</option>
                    <option value = "Wednesday">Wednesday</option>
                    <option value = "Thursday">Thursday</option>
                    <option value = "Friday">Friday</option>
                    <option value = "Saturday">Saturday</option>
                    <option value = "Sunday">Sunday</option>
                </select><br> 
                <label for="Time">Time</label><br>
                <input type="text" id="Time" Time="Time"><br>
                <?php
                    $query = "SELECT Name FROM Building";
                    $result = mysqli_query($con, $query);
                    $counter=0;
                    echo "<label for='Bname'>Building</label><br>";
                    echo "<select id='Bname' name='bname'>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<option value='$counter'>" . $row['Name'] . "</option>";
                        $counter++;
                    }
                    echo "</select><br>";
                ?>
                <!--<label for="BuildingName">Building Name</label><br>
                <input type="text" id="BuildingName" BuildingName="BuildingName"><br> -->
            <button type="submit" id="submitButton">Create Group</button>
            </form>
        </div>

        <form method="get" action="Confirmation.php">
        <button type="submit" id="submitButton">Create Group</button>
        </form>
    </body>
</html>
