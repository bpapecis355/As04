<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $activityError = null;
        $locationError = null;
        $dateError = null;
	
        // keep track post values
        $name = $_POST['name'];
        $activity = $_POST['activity'];
        $location = $_POST['location'];
		$event_date = $_POST['event_date'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name of event';
            $valid = false;
        }
         
        if (empty($activity)) {
            $activityError = 'Please enter Activity';
            $valid = false;
        }
        
         
        if (empty($location)) {
            $locationError = 'Please enter Location';
            $valid = false;
        }
		
		if (empty($event_date)) {
            $dateError = 'Please enter Location';
            $valid = false;
        }
		

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO events (name,activity,location,event_date) values(?, ?, ?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$activity,$location,$event_date));
            Database::disconnect();
            header("Location: events.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create an Event</h3>
                    </div>
             
                    <form class="form-horizontal" action="eventsCreate.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($activityError)?'error':'';?>">
                        <label class="control-label">Activity </label>
                        <div class="controls">
                            <input name="activity" type="text" placeholder="Activty" value="<?php echo !empty($activity)?$activity:'';?>">
                            <?php if (!empty($activityError)): ?>
                                <span class="help-inline"><?php echo $activityError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
                        <label class="control-label">Location</label>
                        <div class="controls">
                            <input name="location" type="text"  placeholder="Location" value="<?php echo !empty($location)?$location:'';?>">
                            <?php if (!empty($locationError)): ?>
                                <span class="help-inline"><?php echo $locationError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Date & Time</label>
                        <div class="controls">
                            <input name="event_date" type="datetime-local"  placeholder="Date" value="<?php echo !empty($event_date)?$event_date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="events.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>