 <?php
$servername = "10.8.30.49";
$username = "jmusarra355wi20";
$password = "jmusarradbwi20v1l";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=jmusarra355wi20", $username, $password );
    // set the PDO error mode to exception
	
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
	
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?> 