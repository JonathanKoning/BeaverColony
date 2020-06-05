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
                if($_SESSION['onid']){
                    $name=$_SESSION['onid'];
                }
                $query = "SELECT * FROM participates_in where ONID='$name'";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    echo"<div class='box'>";
                    //echo"<p>". $row['GroupID']."<p>";
                    $group = $row['GroupID'];
                    $query = "SELECT * FROM `Group` WHERE ID='$group'";
                    $res = mysqli_query($con, $query);
                    $grp = mysqli_fetch_array($res);
                    $subj = $grp['Subject'];
                    $class = $grp['Number'];
                    $peeps = $grp['NumStudents'];
                    echo"<form method='get' action='#'>";
                    
                    echo "<input type='hidden' name='leave' value='$group'>". $group. "<br>". $subj, $class . "<br> Size: ". $peeps ."</input>";

                    echo"<button title='Remove group' id='removeBtn' value='$group' type='submit'>-</button>";
                    echo"</form>";
                    echo"</div>";
                }
                $val = $_GET['leave'];

                $query = "DELETE FROM `participates_in` WHERE ONID='$name' AND GroupID='$val'";
                if(mysqli_query($con, $query)){
                    echo"<br> Success removing group";
                }
                else{
                    echo"<br> Problem removing group". mysqli_error($con);
                }


                $query = "SELECT `NumStudents` FROM `Group` WHERE ID=$val";
                $res = mysqli_query($con, $query);
                $row = mysqli_fetch_array($res);
                $num = $row['NumStudents'];
                
                //Update number of students in group
                $newnum = (int)$num-1;
                $query = "UPDATE `Group` SET NumStudents='$newnum' WHERE ID='$val'";
                if(mysqli_query($con, $query)){
                    echo "<br> Succes inserting group";
                } else{
                    echo "<br> Problem updating numstudents" . mysqli_error($con);
                }
                //echo "<meta http-equiv='refresh' content='0'>"; 
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
