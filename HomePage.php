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
        <div id="Buttons" class="outer">
            <form class="options" method="get" action="GroupListing.php">
                <button id="List" type="submit">Search Groups</button>
            </form>
            <form class="options" method="get" action="CreateGroup.php">
                <button id="Create" type="submit">Create Group</button>
            </form>

        </div>

        
        <div class="outer">
            <h4>Your Groups</h4>
            <?php
                session_start();
                require_once "connect.php";
                $_SESSION['onid']=$_GET['onid'];
                $name=$_GET['onid'];
                //echo "<h1>" . $_SESSION["onid"] . "</h1>";
                $query = "SELECT * FROM participates_in where ONID='$name'";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    echo"<div class='box' style='background-color: #ff8243;'>";
                    echo"<p>". $row['GroupID']."<p>";
                    echo"<form method='get' action='#'>";
                    echo"<button type='submit'>-</button>";
                    echo"</form>";
                    echo"</div>";
                    
                }
                mysqli_close($con);
            ?>
            <!-- <div class="box" style="background-color: #ff8243;">
                <p>Group Name</p>
                <form method="get" action="#">
                    <button type="submit">-</button>
                </form>
            </div>
            <div class="box" style="background-color: #ff8243;">
                <p>Group Name</p>
                <form method="get" action="#">
                    <button type="submit">-</button>
                </form>
            </div>
            <div class="box" style="background-color: #ff8243;">
                <p>Group Name</p>
                <form method="get" action="#">
                    <button type="submit">-</button>
                </form>
            </div>
            <div class="box" style="background-color: #ff8243;">
                <p>Group Name</p>
                <form method="get" action="#">
                    <button type="submit">-</button>
                </form>
            </div> -->
        </div>
    </body>
</html>

