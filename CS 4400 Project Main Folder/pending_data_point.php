<?php //rejected is 0, accepted is 1, pending is 2 for tinyint ?>
<?php

    DEFINE("DB_USER", "root");
    DEFINE("DB_PSWD", "password");
    DEFINE("DB_HOST", "localhost");
    DEFINE("DB_NAME", "CS4400");

$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

if(!$dbcon)
{
    die("Error connecting to database.");
}
//echo "success";
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pending Data Point</title>
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
    <link href="css/sort_style_pending.css" rel="stylesheet">
</head>

<body style="padding: 50px 100px;">
    <div class="card">
        <div class="card-block">
            <div class="form-header purple darken-4">
                <h3>Pending Data Points</h3>
            </div>
            <?php
                echo "<form id='fm1' method='post' action='pending_data_point.php'>
                 <input type='hidden' name='submitted' value=true/>";

                    //"SELECT * FROM 'data_point' WHERE 'Approved'=2"
                    $query="SELECT * FROM data_point WHERE Accepted=2";
                    $result= mysqli_query($dbcon, $query) or die("Error getting data.");
                    echo "<table class='table table-striped sortable' id='data-point-table'>";
            ?>
                        <thead>
                            <!--<tr>
                                <td></td>
                                <td><div class='arrow-up prefix' onclick='sortTable(1, "data-point-table", 3, 11)'></div><div class='arrow-down prefix' onclick='sortTable(1, "data-point-table", 3, 11)'></div></td>
                                <td><div class='arrow-up prefix' onclick='sortTable(2, "data-point-table", 3, 11)'></div><div class='arrow-down prefix' onclick='sortTable(2, "data-point-table", 3, 11)'></div></td>
                                <td><div class='arrow-up prefix' onclick='sortTable(3, "data-point-table", 3, 11)'></div><div class='arrow-down prefix' onclick='sortTable(3, "data-point-table", 3, 11)'></div></td>
                                <td class='is-num-col'><div class='arrow-up prefix ' onclick='sortTable(4, "data-point-table", 3, 11)'></div><div class='arrow-down prefix' onclick='sortTable(4, "data-point-table", 3, 11)'></div></td>
                            </tr>-->
                            <tr>
                                <th>Select</th>
                                <th>POI Location</th>
                                <th>Data Type</th>
                                <th>Data Value</th>
                                <th>Time and Date of Data Reading</th>
                            </tr>
                        </thead>
            <?php
                        echo "<tbody>";
                            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                $poi_location=$row['Name'];
                                $data_type=$row['Data_Type'];
                                $data_value=$row['Data_Value'];
                                $date_recorded=$row['Date_Recorded'];

                                echo "<tr>
                                          <td><input type='checkbox'
                                          name='checkbox[]'
                                          id='checkbox'
                                          value='" . $poi_location . "!!!!!" . $date_recorded."' /></td>
                                          <td>$poi_location</td>
                                          <td>$data_type</td>
                                          <td>$data_value</td>
                                          <td>$date_recorded</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--Deep-orange-->
                    <button type="button" class="btn btn-deep-orange" onclick="window.location.href='adminchoosefun.html'">Back</button>
                    <!--White-space-->
                    <block id="white-space"></block>
                    <!--Dark-green-->
                    <button type="submit" name="action" value="reject" onclick="submitForm(0)" class="btn btn-amber">Reject</button>
                    <!--White-space-->
                    <block id="white-space"></block>
                    <!--Amber-->
                    <button type="submit" name="action" value="accept" onclick="submitForm(1)" class="btn btn-dark-green">Accept</button>
                </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function submitForm(value)
        {
            document.getElementsByName('submitted').value = value;
            document.getElementById('fm1').submit();
        }
    </script>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>
</body>

<?php
    if(isset($_POST['submitted']))
    {
        if ($_POST['action']=='accept') {
            //echo "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.";

            @$checkbox=$_POST['checkbox'];
            for($i=0;$i<count($checkbox);$i++)
            {
                $ids= explode("!!!!!", $checkbox[$i]);
                $sql1="UPDATE data_point SET Accepted=1 WHERE Name = '".$ids[0]."' AND Date_Recorded = '".$ids[1]."' ";
                mysqli_query($dbcon, $sql1);
                echo '<meta http-equiv="refresh" content="0">';
            }

        }
        else
        {
            //echo "dsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaadsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
            @$checkbox=$_POST['checkbox'];
            for($i=0;$i<count($checkbox);$i++)
            {
                $ids= explode("!!!!!", $checkbox[$i]);
                $sql1="UPDATE data_point SET Accepted=0 WHERE Name = '".$ids[0]."' AND Date_Recorded = '".$ids[1]."' ";
                mysqli_query($dbcon, $sql1);
                echo '<meta http-equiv="refresh" content="0">';
            }
        }
    }
    else
    {
        //echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    }
?>
</html>

