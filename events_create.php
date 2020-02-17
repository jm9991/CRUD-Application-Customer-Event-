<?php
    require 'database.php';
	
	
	
    if (!empty($_POST)) {
        // keep track validation errors
        $dateError = null;
        $timeError = null;
        $locationError = null;
		$descriptionError = null;
         
        // keep track post values
        $date = $_POST['event_date'];
        $time = $_POST['event_time'];
        $location = $_POST['event_location'];
		$description = $_POST['event_description'];
         
        // validate input
        $valid = true;
		
        if (empty($date)) {
            $dateError = 'Please enter Date';
            $valid = false;
        }
         
        if (empty($time)) {
            $timeError = 'Please enter Time';
            $valid = false;
			
        } 
         
        if (empty($location)) {
            $locationError = 'Please enter Location';
            $valid = false;
        }
		
		if (empty($description)) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
			try {
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO events (event_date, event_time, event_location, event_description) VALUES('$date', '$time', '$location', '$description')"; // We added this code instead of the above
				$q = $pdo->prepare($sql);
				$q->execute(array($date, $time, $location, $description));
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
            header("Location: events.php");
        }
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
 
<body>
    <div class="container">
     
		<div class="span10 offset1">
			<div class="row">
				<h3>Create an Event</h3>
			</div>
	 
			<form class="form-horizontal" action="events_create.php" method="post" >
			  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
				<label class="control-label">Date</label>
				<div class="controls">
					<input name="event_date" type="date"  placeholder="date" value="<?php echo !empty($date)?$date:'';?>">
					<?php if (!empty($dateError)): ?>
						<span class="help-inline"><?php echo $dateError;?></span>
					<?php endif;?>
				</div>
			  </div>
			  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
				<label class="control-label">Time</label>
				<div class="controls">
					<input name="event_time" type="time" placeholder="time" value="<?php echo !empty($time)?$time:'';?>">
					<?php if (!empty($timeError)): ?>
						<span class="help-inline"><?php echo $timeError;?></span>
						
					<?php endif;?>
				</div>
			  </div>
			  <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
				<label class="control-label">Location</label>
				<div class="controls">
					<input name="event_location" type="text"  placeholder="location" value="<?php echo !empty($location)?$location:'';?>">
					<?php if (!empty($locationError)): ?>
						<span class="help-inline"><?php echo $locationError;?></span>
					<?php endif;?>
				</div>
			  </div>
			  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
				<label class="control-label">Description</label>
				<div class="controls">
					<input name="event_description" type="text" placeholder="description" value="<?php echo !empty($description)?$description:'';?>">
					<?php if (!empty($descriptionError)): ?>
						<span class="help-inline"><?php echo $descriptionError;?></span>
					<?php endif;?>
				</div>
			  </div>
			 
			 <div class="form-actions">
			  <br>
				  <button type="submit" class="w3-button w3-pale-green w3-round-xlarge">Create</button>
				  <a class="w3-button w3-sand w3-round-xlarge" href="events.php">Back</a>
				</div>
			</form>
		</div>
                 
    </div> <!-- /container -->
  </body>
</html>
