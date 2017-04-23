<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pending Off.</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/MP.bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/MP.mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/adminfunc.css" rel="stylesheet">

</head>

<body style="padding: 50px 100px;">


    <!-- /Start your project here -->
    <div class="card">
    <div class="card-block">

    <!--Header-->
    <div class="form-header  purple darken-4">
        <h3>Pending City Official</h3>
    </div>
    <form action="http://localhost/pending_off.php" method="post">
    <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Select</th>
            <th>Username</th>
            <th>Email</th>
            <th>City</th>
            <th>State</th>
            <th>Title</th>
            <!--<th>Actions</th> -->
        </tr>
    </thead>
    <tbody>
            <?php
                //include "css/MP.bootstrap.min.css";
                //include "css/MP.mdb.min.css";
                echo "<link href='css/MP.bootstrap.min.css' rel='stylesheet' type='text/css' />";
                echo "<link href='css/MP.mdb.min.css' rel='stylesheet' type='text/css' />";
                //Enter php here
                $mysqli = new mysqli("localhost", "root", "password", "CS4400");
                if ($mysqli->connect_errno) {
                    echo 'Error: Could not connect to database. Please try again later.';
                    exit; 
                }
                //$testbox = [];
                $result = $mysqli->query("SELECT * FROM `City_Official` WHERE `Approved`=2");
                $result3 = $mysqli->query("SELECT `Email_Address` FROM `User` WHERE `Username` = SOME (SELECT `Username` FROM `City_Official` WHERE `Approved`=2)");
                $send = 5;
                if($result){
                    //$checked[$result->num_rows]={0};
                    for($i=0;$i<$result->num_rows;$i++){ 
                        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                        @$row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                        $email=$row3["Email_Address"];
                        $name = $row["Username"];
                        $title = $row["Title"];
                        $city = $row["City"];
                        $state = $row["State"];
                        $r = $i+1;

                        echo "<tr>";
                            echo "<th scope='row'>$r</th>";
                            echo "<td>";
                                echo "<fieldset class='form-group'>";
                                    echo "<input type='checkbox' id='checkbox1' name='testbox[]' value='$name' >";
                                   echo "<label for='checkbox1'></label>";
                                echo "</fieldset>";
                            echo "</td>";
                        
                        echo "<td>$name</td>";
                        echo "<td>$email</td>";
                        echo "<td>$city</td>";
                        echo "<td>$state</td>";
                        echo "<td>$title</td>";
                        echo "</tr>";
                    }
                   // echo "top $name";
                }
                else{
                    echo "nope";
                }
                //echo "</tr>";
                //$mysqli->close();
            ?>
         
        
        </tbody>
    </table>


    <!--Deep-orange-->
    <button type="button" class="btn btn-deep-orange" onclick="window.location.href='adminchoosefun.html'">Back</button>
    <!--White-space-->
    <block id="white-space"></block>
    <!--Dark-green-->
    <button type="submit" name="reject" value="1" class="btn btn-amber">Reject</button>
    <!--White-space-->
    <block id="white-space"></block>
    <!--Amber-->
    <button type="submit" name="accept" class="btn btn-dark-green" value="1" onclick="showInput()">Accept</button>
    </form>
    </div>
    </div>

    <?php
        @$reject = $_POST['reject'];
        @$accept = $_POST['accept'];
        @$test = $_POST['testbox'];
        //Do two different things depending on reject or accept
        if(($reject)&(!$accept)){ //If rejected
            //echo "Well damn";
            echo "</br>";
            $result = $mysqli->query("SELECT * FROM `City_Official` WHERE `Approved`=2");
            for($i=0;$i<$results->num_rows;$i++) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $newname = $row["Username"];
                //echo $test[$i];
                if($newname == $test[$i]){
                    //echo $test[$i];
                    $result2 = $mysqli->query("UPDATE `City_Official` SET `Approved`=0 WHERE `Username`='$newname'");
                    echo '<meta http-equiv="refresh" content="2">';
                }
            }
            echo "Done. Rejected.";   
        }
        else if(($accept)&(!$reject)){
            echo "</br>";
            $result = $mysqli->query("SELECT * FROM `City_Official` WHERE `Approved`=2");
            for($i=0;$i<$results->num_rows;$i++) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $newname = $row["Username"];
                //echo $test[$i];
                if($newname == $test[$i]){
                    //echo $test[$i];
                    $result2 = $mysqli->query("UPDATE `City_Official` SET `Approved`=1 WHERE `Username`='$newname'");
                    echo '<meta http-equiv="refresh" content="2">';
                }
            
            }
            echo "Done. Accepted";
        }
        else{
            exit;
            //$mysqli->close();
        }
    $mysqli->close();
    ?>


    <!-- SCRIPTS -->
	<style>
	
	</style>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
