<?PHP
    $date = $_GET['date'];
    include('connect.php');
    include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <!-- material-icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{font-family: 'Merriweather', serif;}
    </style>
</head>
<body>
<center>
<div class="pannel">
        <h1>Events:</h1>
        <h2>Date: <?php echo $date; ?></h2>        
        <?php
            $result=getEvent($date); 
            if($result) 
            {
                while($row = $result->fetch_assoc())
                {?>
                    <form action="" method="post">
                    <div class="event-box">
                        
                        <div class="row" style="display:flex;">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-5 col-md-6"><h5>Name:</h5></div>
                                    <div class="col-5 col-md-6"><?php echo $row['name'];?></div>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-6"><h5>Time:</h5></div>
                                    <div class="col-5 col-md-6"><?php echo date('h:i:s a', strtotime($row['time']));?></div>                            
                                </div>
                            </div>
                            <div class="col-2" style="float:right;">
                                <button class="btn" name="delete" value="<?PHP echo $row['id'];?>"><span class="material-icons">delete</span></button>
                            </div>
                        </div>
                        
                        
                    </div>
                    </form>
            <?php }
            } 
            else 
            {
                echo "<div class='bg-warning'>No Events Found! on this Date</div> <br>";
            }
        ?>
    <a href="addEvent.php?date=<?php echo $date; ?>"><button class="btn btn-success"><span class="material-icons">edit_calendar</span></button></a>
    <a href="index.php"> <button class="btn btn-danger"><span class="material-icons">calendar_today</span></button> </a>
</div> 
</center>

</body>
</html>
<?php
    if(isset($_POST['delete']))
    {
        $id = $_POST['delete'];
        
        $sql = "DELETE FROM `events` WHERE id=$id";
        if ($con->query($sql) === TRUE) {
            echo "<script> alert('Event deleted successfully. Refresh the page!');</script>";
          } else {
            echo "Error deleting record: " . $con->error;
          }
          mysqli_close($con);
    }
?>