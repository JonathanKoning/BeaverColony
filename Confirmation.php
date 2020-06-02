<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CreateGroupStyle.css">
        <title>Beaver Colony - Create a Group Page</title>
    </head>
    <body>
        <?php
            $counter=0;
            $number = $_GET['Class'];
            
            session_start();
            $onid=$_SESSION['onid'];
            require_once "connect.php";
            $query = "SELECT Subject, Number FROM has where ONID='$onid'";
            $result = mysqli_query($con, $query);               
            
            while($row = mysqli_fetch_array($result)){
                if($counter == (int)$number){
                    $subj=$row['Subject']; 
                    $class=$row['Number'];
                }
                $counter++;
            }
            echo "<h1>" . "$class" . "</h1>"; 
            
            $Day=$_GET['Day'];
            echo "<h1>" . $_GET['Day'] . "</h1>"; 
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


        ?>
        <div id="header">
            <h1><a href="HomePage.html">Beaver Colony</a></h1>
            <h2>Create a Group</h2>
        </div>
        <div id="formDiv">
            <form>
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
