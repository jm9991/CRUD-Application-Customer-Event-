<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         
        // validate input Name
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        // validate input Email Address
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
        // validate input Mobile Number
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // update data
        if ($valid) {
          try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customer  set name = ?, email = ?, mobile =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile,$id));
          } catch (PDOException $e) {
            //echo 'Connection failed: ' . $e->getMessage();
          }
            header("Location: index.php");
        }
    } else {
  try{  
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customer where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
      } catch (PDOException $e) {
        //echo 'Connection failed: ' . $e->getMessage();
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
				<h3>Update a Customer</h3>
			</div>
	 
			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
			  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
				<label class="control-label">Name</label>
				<div class="controls">
					<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					<?php if (!empty($nameError)): ?>
						<span class="help-inline"><?php echo $nameError;?></span>
					<?php endif; ?>
				</div>
			  </div>
			  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
				<label class="control-label">Email Address</label>
				<div class="controls">
					<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					<?php if (!empty($emailError)): ?>
						<span class="help-inline"><?php echo $emailError;?></span>
					<?php endif;?>
				</div>
			  </div>
			  <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
				<label class="control-label">Mobile Number</label>
				<div class="controls">
					<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
					<?php if (!empty($mobileError)): ?>
						<span class="help-inline"><?php echo $mobileError;?></span>
					<?php endif;?>
				</div>
			  </div>
			  <div class="form-actions">
			  <br>
				  <button type="submit" class="w3-button w3-pale-green w3-round-xlarge">Update</button>
				  <a class="w3-button w3-light-grey w3-round-xlarge" href="index.php">Back</a>
				</div>
			</form>
		</div>
                 
    </div> <!-- /container -->
  </body>
</html>