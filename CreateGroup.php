<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CreateGroupStyle.css">
        <title>Beaver Colony - Create a Group Page</title>
    </head>
    <body>
        <div id="header">
            <h1><a href="HomePage.php">Beaver Colony</a></h1>
            <h2>Create a Group</h2>
        </div>
        <button id="logoutBtn" type="submit" onclick="window.location.href='Logout.php'">Logout</button>
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
                <label for="Time">Time(24 Hour)</label><br>
                <select id="Time" name="Time"><br>
                    <option value ="0000">00:00</option>
                    <option value ="0100">01:00</option>
                    <option value ="0200">02:00</option>
                    <option value ="0300">03:00</option>
                    <option value ="0400">04:00</option>
                    <option value ="0500">05:00</option>
                    <option value ="0600">06:00</option>
                    <option value ="0700">07:00</option>
                    <option value ="0800">08:00</option>
                    <option value ="0900">09:00</option>
                    <option value ="1000">10:00</option>
                    <option value ="1100">11:00</option>
                    <option value ="1200">12:00</option>
                    <option value ="1300">13:00</option>
                    <option value ="1400">14:00</option>
                    <option value ="1500">15:00</option>
                    <option value ="1600">16:00</option>
                    <option value ="1700">17:00</option>
                    <option value ="1800">18:00</option>
                    <option value ="1900">19:00</option>
                    <option value ="2000">20:00</option>
                    <option value ="2100">21:00</option>
                    <option value ="2200">22:00</option>
                    <option value ="2300">23:00</option>
                    <option value ="2400">24:00</option>
                </select><br>
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
                <div id="buttonDiv">
                    <button type="submit" id="submitButton">Create Group</button>
                </div>
            </form>
        </div>
    </body>
</html>
