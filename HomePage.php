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
        <button id="logoutBtn" type="submit" onclick="window.location.href='Logout.php'">Logout</button>
        <h2>Home</h2>
        <div id="BeaverDescription">
            <h3>A resource to collaborate, help, and connect with others to further the success of your academic carreer</h3>
        </div>

        <div class="GroupDiv">
            <h4>Your Groups</h4>
            <?php
                require_once "connect.php";
                function Draw($con){

                    if($_SESSION['onid'])
                    {
                        $name=$_SESSION['onid'];
                    }
                    //echo"<br> $name";
                    $query = "SELECT * FROM participates_in where ONID='$name'";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<div class='box'>";
                        //echo"<p>". $row['GroupID']."<p>";
                        $group = $row['GroupID'];
                        $query = "SELECT * FROM `Group` WHERE ID='$group'";
                        $res = mysqli_query($con, $query);
                        $grp = mysqli_fetch_array($res);
                        $subj = $grp['Subject'];
                        $class = $grp['Number'];
                        $peeps = $grp['NumStudents'];
                        $query = "SELECT `Day`, `Time`, `BuildingName` FROM `Meeting` WHERE `GroupID`='$group'";
                        $result2 = mysqli_query($con, $query);
                        $row2 = mysqli_fetch_array($result2);
                        $day = $row2['Day'];
                        $time = $row2['Time'];
                        $bName = $row2['BuildingName'];
                        echo "Group ID: $group <br>Class: $subj $class <br>Size: $peeps <br>Building: $bName <br>Day: $day <br>Time: $time";

                        //echo "Group ID: $group <br>Class: $subj $class <br>Size: $peeps <br> Building: $day";
                        echo"<form id='editForm' method='post' action='EditGroup.php'>";
                            echo "<input type='hidden' name='edit' value='$group'></input>";
                            echo"<button title='Edit group' id='editBtn' value='$group' type='submit'>Edit</button>";
                        echo"</form>";
                        echo"<form id='removeForm' method='post' action='#'>";
                            echo "<input type='hidden' name='leave' value='$group'></input>";
                            echo"<button title='Remove group' id='removeBtn' value='$group' type='submit'>Leave</button>";
                        echo"</form>";
                        echo"</div>";
                    }
                }
                //if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['leave']))
                //{
                  //  Remove();
                //}
                function Edit($con){
                    $val = $_POST['edit'];
                }
                
                function Remove($con) 
                { 
                    //echo"<br> Remove function called";
                    $val = $_POST['leave'];
                    $name = $_SESSION['onid'];
                    //print_r($val);
                    $query = "DELETE FROM `participates_in` WHERE `ONID`='$name' AND `GroupID`='$val'";
                    if(mysqli_query($con, $query)){
                        //echo"<br>";
                    }
                    else
                    {
                        //echo"<br> participates in ". mysqli_error($con);
                    }


                    $query = "SELECT `NumStudents` FROM `Group` WHERE `ID`='$val'";
                    if(mysqli_query($con, $query))
                    {
                        //echo"<br>NumStudents success"; 
                    }
                    else
                    {
                        //echo"<br> NumStudents ". mysqli_error($con);
                    }
                    $res = mysqli_query($con, $query);
                    $row = mysqli_fetch_array($res);
                    $num = $row['NumStudents'];
                
                    //Update number of students in group
                    
                    //echo"<br> $num";
                    $newnum = (int)$num-1;
                   // echo"<br> $num";
                    //echo"<br> $newnum";
                    if($newnum <= 0)
                    {
                        $query = "DELETE FROM `Meeting` WHERE GroupID='$val'";
                        if(mysqli_query($con, $query))
                        {
                            //echo"<br> Meeting Removed";
                        }
                        else
                        {
                            echo"<br> Delete meeting". mysqli_error($con);
                        }
                        $query = "DELETE FROM `Group` WHERE ID='$val'";
                        if(mysqli_query($con, $query))
                        {
                            //echo"<br>Group Removed";
                        }
                        else
                        {
                            //echo"<br> Remove group ". mysqli_error($con);
                        }
                    }
                    else
                    {
                        $query = "UPDATE `Group` SET NumStudents='$newnum' WHERE ID='$val'";
                        if(mysqli_query($con, $query))
                        {
                            //echo "<br> num students success";
                        }
                        else
                        {
                            //echo "<br>";

                           // echo"<br> update num students " . mysqli_error($con);
                        }
                    }
                    //echo "<meta http-equiv='refresh' content='0'>";
                }
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['leave']))
                {
                    Remove($con);
                    $_POST = array();
                }
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['edit']))
                {
                    print_r($_POST);
                    $_SESSION["edit"]=$_POST['edit'];
                    Edit($con);
                    //$_POST = array();
                }
                Draw($con);
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

