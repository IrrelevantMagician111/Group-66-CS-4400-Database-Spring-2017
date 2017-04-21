<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Insert Page Name</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<form action = "newPOIloc.php" method = "post">

    <!-- /Start your project here-->
    <!--Form with header-->
<div class="card center-container">
    <div class="card-block">

        <!--Header-->
        <div class="form-header light-blue-gradient">
            <h3> Add a New Location</h3>
        </div>

        <!--Body-->
        <div class="md-form">
            <i class="fa fa-map-marker prefix"></i>
            <input name = "name" type="text" id="form3" class="form-control">
            <label for="form3">POI Location Name</label>
        </div>

            <div class="dropdown">
                <select class = "btn btn-secondary" name = "city">
                    <option selected disabled> City </option>
                    <?php
                        @   $db = new mysqli('localhost','root','password','cs4400');
                        $connected = !mysqli_connect_errno();
                        if(!$connected)
                        {
                            echo "<p>You are not connected.</p>";
                        }
                        $result = $db->query("SELECT `City` FROM `city_state`");

                        while($row = $result -> fetch_assoc())
                        {
                             echo "<option value=\"city\">" .$row['City'] ."</option>";
                        }
                
                    ?>
                </select>
            </div>

            <div class="dropdown">
                <select class = "btn btn-secondary" name = "state">
                    <option selected disabled> State </option>
                    <?php
                        @   $db = new mysqli('localhost','root','password','cs4400');
                        $connected = !mysqli_connect_errno();
                        if(!$connected)
                        {
                            echo "<p>You are bot connected.</p>";
                        }
                        $result = $db->query("SELECT `State` FROM `city_state`");

                        while($row = $result -> fetch_assoc())
                        {
                             echo "<option value=\"state\">" .$row['State'] ."</option>";
                        }
                
                    ?>
                </select>
            </div>

        
        <div class="md-form">
            <input type="text" id="form4" class="form-control">
            <label name = "zip" for="form4">Zip Code</label>
        </div>

        <div class="text-left">
            <button class="btn btn-indigo">Back</button>
            <button class="btn btn-indigo">Submit</button>
        </div>

    </div>
</div>
<!--/Form with header-->

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
</form>
</body>

</html>