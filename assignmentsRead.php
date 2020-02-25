<?php 
/* ---------------------------------------------------------------------------
 * filename    : fr_assign_read.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays one assignment's details (table: fr_assignments)
 * ---------------------------------------------------------------------------
 */

require 'database.php';

$id = $_GET['id'];

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# get assignment details
$sql = "SELECT * FROM assignments where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);

# get volunteer details
$sql = "SELECT * FROM customers where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['assign_per_id']));
$perdata = $q->fetch(PDO::FETCH_ASSOC);

# get event details
$sql = "SELECT * FROM events where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['assign_event_id']));
$eventdata = $q->fetch(PDO::FETCH_ASSOC);

Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

		<div class="span10 offset1">
		
			<div class="row">
				<h3>Assignment Details</h3>
			</div>
			
			<div class="form-horizontal" >
			
				<div class="control-group">
					<label class="control-label">Customer</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $perdata['cust_name'] ;?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Event</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo trim($eventdata['activity']) . " (" . trim($eventdata['location']) . ") ";?>
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Date, Time</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $eventdata['event_date'];?>
						</label>
					</div>
				</div>
				
				<div class="form-actions">
					<a class="btn" href="assignments.php">Back</a>
				</div>
			
			</div> <!-- end div: class="form-horizontal" -->
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->
	
</body>
</html>