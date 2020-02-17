<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PHP EVENT Grid</h3>
            </div>
            <div class="row">
			    <p>
                    <a href="events_create.php" class="w3-button w3-pale-green w3-round-xlarge">Event Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Location</th>
					  <th>Description</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php				  
                   include 'database.php';
              
                   $sql = 'SELECT * FROM events ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['event_date'] . '</td>';
                            echo '<td>'. $row['event_time'] . '</td>';
                            echo '<td>'. $row['event_location'] . '</td>';
							echo '<td>'. $row['event_description'] . '</td>';
							echo '<td><a class="w3-button w3-pale-blue w3-round-xlarge" href="events_read.php?id='.$row['id'].'">Read</a>';
							echo '&nbsp;&nbsp;&nbsp;';
							echo '<a class="w3-button w3-pale-green w3-round-xlarge" href="events_update.php?id='.$row['id'].'">Update</a>';
                            echo '&nbsp;&nbsp;&nbsp;';
                            echo '<a class="w3-button w3-pale-red w3-round-xlarge" href="events_delete.php?id='.$row['id'].'">Delete</a>';
							
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