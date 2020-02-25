<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
	

		<div class="row">
				<p>
					<h3>Assignments</h3> <br>


					<a href="customers.php" class="btn btn-info">Customers</a>
					<a href="events.php" class="btn btn-info">Events</a>
					<a href="assignmentsCreate.php" class="btn btn-dark">Add Assignment</a>

                </p>
		</div>
		
		<div class="row">
			<p>Each shift is 4 hours.</p>
			
			
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Date</th>
						<th>Location</th>
						<th>Event</th>
						<th>Volunteer</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					include 'database.php';
					//include 'functions.php';
					$pdo = Database::connect();
					
					$sql = "SELECT * FROM assignments 
						LEFT JOIN customers ON customers.id = assignments.assign_per_id 
						LEFT JOIN events ON events.id = assignments.assign_event_id
						ORDER BY event_date ASC, cust_name ASC;";


					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['event_date'] . '</td>';
						echo '<td>'. $row['location'] . '</td>';
						echo '<td>'. $row['activity'] . '</td>';
						echo '<td>'. $row['cust_name'] . '</td>';
						echo '<td width=250>';
						# use $row[0] because there are 3 fields called "id"
						echo '<a class="btn" href="assignmentsRead.php?id='.$row[0].'">Details</a>';
						echo '<a class="btn btn-success" href="assignmentsUpdate.php?id='.$row[0].'">Update</a>';
						echo '<a class="btn btn-danger" href="assignmentsDelete.php?id='.$row[0].'">Delete</a>';
						echo '</td>';
						echo '</tr>';
					}
					Database::disconnect();
				?>
				</tbody>
			</table>
			
    	</div>

    </div> <!-- end div: class="container" -->
	
</body>
</html>