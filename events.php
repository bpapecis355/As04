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
					<h3>Events</h3> <br>

                    <a href="eventsCreate.php" class="btn btn-success">Create</a>
					<a href="customers.php" class="btn btn-info">Customers</a>
					<a href="assignments.php" class="btn btn-dark">Assignments</a>
                </p>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Event Name</th>
                      <th>Activity</th>
                      <th>Location</th>
					  <th> Date & Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM events ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['activity'] . '</td>';
                            echo '<td>'. $row['location'] . '</td>';
							echo '<td>'. $row['event_date'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="eventsRead.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="eventsUpdate.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="eventsDelete.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>