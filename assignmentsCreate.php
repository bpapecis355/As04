<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_assign_create.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program adds/inserts a new assignment (table: fr_assignments)
 * ---------------------------------------------------------------------------
 */
 

//$personid = $_SESSION["customers.id"];
//$eventid = $_GET['events.id'];

require 'database.php';


if ( !empty($_POST)) {

	// initialize user input validation variables
	$customererror = null;
	$eventError = null;
	
	// initialize $_POST variables
	$customer = $_POST['customer'];    // same as HTML name= attribute in put box
	$event = $_POST['event'];
	
	// validate user input
	$valid = true;
	if (empty($customer)) {
		$customersError = 'Please choose a volunteer';
		$valid = false;
	}
	if (empty($event)) {
		$eventsError = 'Please choose an event';
		$valid = false;
	} 
		
	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO assignments 
			(assign_per_id,assign_event_id) 
			values(?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($customer,$event));
		Database::disconnect();
		header("Location: assignments.php");
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
				<h3>Assign a Customer to an Event</h3>
			</div>
	
			<form class="form-horizontal" action="assignmentsCreate.php" method="post">
		
				<div class="control-group">
					<label class="control-label">Customer</label>
					<div class="controls">
						<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM customers ORDER BY cust_name ASC';
							echo "<select class='form-control' name='customer' id='id'>";
							foreach ($pdo->query($sql) as $row) {
								echo "<option value='" . $row['id'] . " '> " . $row['cust_name']  . "</option>";
							}
							echo "</select>";
							Database::disconnect();
						?>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->
			  
				<div class="control-group">
					<label class="control-label">Event</label>
					<div class="controls">
						<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM events ORDER BY event_date ASC';
							echo "<select class='form-control' name='event' id='id'>";


							foreach ($pdo->query($sql) as $row) {
								echo "<option value='" . $row['id'] . " '> " . $row['event_date'] . " (" . $row['event_time'] . ") - " .
								trim($row['events.activity']) . " (" . 
								trim($row['location']) . ") " .
								"</option>";
							}
								
							echo "</select>";
							Database::disconnect();
						?>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Confirm</button>
						<a class="btn" href="assignments.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- end div: class="span10 offset1" -->

    </div> <!-- end div: class="container" -->

  </body>
</html>