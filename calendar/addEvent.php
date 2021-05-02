<?PHP
    $date = $_GET['date'];
    include('connect.php');
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $time = $_POST['time'];
        $sql = "INSERT INTO `events` (name,date,time) values('$name','$date','$time')";
        if (mysqli_query($con, $sql)) 
        {
            echo "<div class='bg-success text-white'>New Event created</div>";
        } 
        else
        {
            echo "<div class='bg-danger'>Error: " . $sql . "<br>" . mysqli_error($con)."</div>";
        }
        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&display=swap" rel="stylesheet"> 
    <!-- material-icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{font-family: 'Merriweather', serif; }
        
    </style>
</head>
<body>
    <div class="container" style="display:flex; justify-content:center;">
    
        <div class="banner">
            <h1>Event:</h1>
            <form action="" method="post">
                <div class="form-group">
                    <h2>Date: <?php echo $date; ?></h2>
                </div>
                <div class="form-group">
                    <label for="name">Title:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="time" >Time:</label>
                    <input type="time" name="time" id="time" class="form-control">
                </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="float:right;"><br>
                    
            </form>
            <br>
            <a href="events.php?date=<?php echo $date?>"> <button class="btn btn-success"><span class="material-icons">event_available</span></button> </a>
            <a href="index.php"> <button class="btn btn-danger"><span class="material-icons">calendar_today</span></button> </a><br><br>
        </div>
    
    </div> 
    </div>
</body>
</html>
